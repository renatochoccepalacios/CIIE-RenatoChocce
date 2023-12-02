<?php

session_start();

require_once __DIR__ . "\..\..\..\dirs.php";
// include_once __DIR__ . '/../modules/verifyCurso.php';

require_once(MODELS_PATH . "\DAL\UsuarioDAL.php");
require_once(MODELS_PATH . "\DAL\cursoDAL.php");

require_once ADMIN_PATH . "/curso/modules/removeCertificate.php";
// require_once(MODELS_PATH . "\Magia.php");

// $magia = new Magia();

$idCurso = isset($_POST['idCurso']) ? $_POST['idCurso'] : '';
$cursoDAL = new CursoDAL();

$cursoDAL->removeGrades($_POST['idCurso']);

foreach ($_POST as $dniAlumno => $calificacion):
    if ($dniAlumno !== 'idCurso' && $dniAlumno !== 'accion') {
        $cursoDAL->setGrades($dniAlumno, $idCurso, $calificacion);

        if ($calificacion != 'Aprobado') {
            if ($cursoDAL->verifyCertificateIssuance($dniAlumno, $idCurso)) {
                $cursoDAL->removeCertificate($dniAlumno, $idCurso);
                removeCertificate($dniAlumno, $idCurso);
            }
        }
    }
endforeach;

header('Location: ../?id=' . $_POST['idCurso']);

// foreach (json_decode($_POST['data']) as $data) {
//     $magia->calificaciones($data->dni, $_POST['idCurso'], $data->estado);
// }
