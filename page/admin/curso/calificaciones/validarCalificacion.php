<?php

session_start();

require_once __DIR__ . "\..\..\..\dirs.php";

$receivedData = json_decode(file_get_contents('php://input'), true);
$message = ['done' => false, 'source' => ROOT_URL . '/admin/cursos'];

// validar que el usuario no se meta al enlace de forma directa
if (!isset($_GET['from'])) {
    if (!isset($_SERVER['CONTENT_TYPE'])) {
        getError('Cod46');
        echo json_encode($message);
        exit();
    }
}

include_once __DIR__ . '/../verifyCurso.php';
require_once MODELS_PATH . "\DAL\UsuarioDAL.php";
require_once APP_PATH . "/modules/removeCertificate.php";

// si el curso aún no termina no se pueden poner notas
if ($cursoDAL->checkEnd($idCurso) == 1) {
    getError('Cod42');
    $message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
    echo json_encode($message);
    exit();
}

$usuarioDAL = new UsuarioDAL();
$tipoCuenta = $usuarioDAL->getPerId($_SESSION['user'])->getTipoCuenta();

// si las notas ya estan cerradas y quiere entrar el etr, tiene que hacerlo volver
if ($tipoCuenta != 'Admin' && $cursoDAL->checkGrades($idCurso)) {
    getError('Cod41');
    $message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
    echo json_encode($message);
    exit();
}

$cursoDAL->removeGrades($idCurso);

foreach ($receivedData as $arr):
    // if ($dniAlumno !== 'idCurso' && $dniAlumno !== 'accion') {
    // seteando notas
    $cursoDAL->setGrades($arr['dni'], $idCurso, $arr['calificacion']);

    if ($arr['calificacion'] != 'Aprobado') {
        // si no esta aprobado, verificamos si tenia un certificado
        if ($cursoDAL->verifyCertificateIssuance($arr['dni'], $idCurso)) {
            // si lo tenia, se lo sacamos
            $cursoDAL->removeCertificate($arr['dni'], $idCurso);
            removeCertificate($arr['dni'], $idCurso);
        }
        // }
    }
endforeach;

setInfo('Cod10');
$message['done'] = true;
$message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
echo json_encode($message);