<?php

session_start();

require_once __DIR__ . "\..\..\..\dirs.php";

$receivedData = json_decode(file_get_contents('php://input'), true);

$message = ['done' => false];

// validar que el usuario no se meta al enlace de forma directa
if (!isset($_GET['from'])) {
    if (!isset($_SERVER['CONTENT_TYPE'])) {
        getError('Cod46');
        $message['source'] = ROOT_URL . '/admin/cursos';
        echo json_encode($message);
        exit();
    }
}

include_once __DIR__ . '/../verifyCurso.php';

require_once APP_PATH . '/vendor/autoload.php';
require_once APP_PATH . '/modules/generateCertificate.php';
require_once MODELS_PATH . "\DAL\UsuarioDAL.php";

$accion = $receivedData[0]['action'];

$usuarioDAL = new UsuarioDAL();

if ($accion == 'generate') {
    $dni = $receivedData[0]['dni'];

    if ($dni != "" && $idCurso != "") {
        $cursoDAL->issueCertificate($dni, $idCurso);
        $idCertificado = $cursoDAL->verifyCertificateIssuance($dni, $idCurso);

        generateCertificate($idCurso, $dni, $idCertificado[1]);
        setInfo('Cod12');
        $message['done'] = true;
        echo json_encode($message);
        exit();
    } else {
        getError('Cod45');
        if (isset($idCurso))
            $message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
        else
            $message['source'] = ROOT_URL . '/admin/cursos';

        header('Location: index.php?id=' . $idCurso);
        exit();
    }
}

if ($accion == 'retirar') {
    $dni = $receivedData[0]['dni'];

    if ($dni != "" && $idCurso != "") {

        $id = $cursoDAL->verifyCertificateWithdrawal($dni, $idCurso)[1];
        $cursoDAL->withdrawCertificate($id);

        setInfo('Cod13');
        $message['done'] = true;
        echo json_encode($message);
        exit();
    } else {
        getError('Cod50');
        if (isset($idCurso))
            $message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
        else
            $message['source'] = ROOT_URL . '/admin/cursos';
        echo json_encode($message);
        exit();
    }
}

if ($accion == 'generateAll') {

    if ($idCurso != "") {
        $repeated = 0;
        $alumnos = $cursoDAL->getApprovedStudents($idCurso);

        foreach ($alumnos as $alumno):
            $checkWithdrawal = $cursoDAL->verifyCertificateWithdrawal($alumno->getDni(), $idCurso)[0];
            $issuance = $cursoDAL->verifyCertificateIssuance($alumno->getDni(), $idCurso);

            // si ya tiene certificado pero no fue retirado, que siga
            if ($checkWithdrawal == 0 && isset($issuance)) {
                $repeated++;
                continue;
            }

            // generar certificado
            $cursoDAL->issueCertificate($alumno->getDni(), $idCurso);
            $idCertificado = $cursoDAL->verifyCertificateIssuance($alumno->getDni(), $idCurso)[1];
            generateCertificate($idCurso, $alumno->getDni(), $idCertificado);

        endforeach;

        if ($repeated == count($alumnos)) {
            $message['info'] = 'Todos los certificados se encuentran generados.';
            $message['done'] = false;
        } else {
            setInfo('Cod14');
            $message['done'] = true;
        }
        echo json_encode($message);
        exit();
    } else {
        getError('Cod46');
        if (isset($idCurso))
            $message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
        else
            $message['source'] = ROOT_URL . '/admin/cursos';
        echo json_encode($message);
        exit();
    }
}

getError('Cod55');
if (isset($idCurso))
    $message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
else
    $message['source'] = ROOT_URL . '/admin/cursos';
echo json_encode($message);
exit();