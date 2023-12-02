<?php

session_start();

require_once __DIR__ . "\..\..\..\dirs.php";
require_once '../../../app/vendor/autoload.php';

require_once MODELS_PATH . "\DAL\UsuarioDAL.php";
require_once MODELS_PATH . "\DAL\cursoDAL.php";

require_once ADMIN_PATH . '\curso\modules\generateCertificate.php';

$dni = isset($_POST["dni"]) ? $_POST['dni'] : "";
$idCurso = isset($_POST["idCurso"]) ? $_POST['idCurso'] : "";

$accion = isset($_POST['action']) ? $_POST['action'] : "";

$cursoDAL = new CursoDAL();
$usuarioDAL = new UsuarioDAL();

if ($accion == 'generate') {
    if ($dni != "" && $idCurso != "") {
        $cursoDAL->issueCertificate($dni, $idCurso);
        $idCertificado = $cursoDAL->verifyCertificateIssuance($dni, $idCurso);

        generateCertificate($idCurso, $dni, $idCertificado[1]);
        header('Location: index.php?id=' . $idCurso);
    }
}

if ($accion == 'retirar') {
    if ($dni != "" && $idCurso != "") {
        if ($id = $cursoDAL->verifyCertificateWithdrawal($dni, $idCurso)[1]) {
            $cursoDAL->withdrawCertificate($id);
        }

        header('Location: index.php?id=' . $idCurso);
    }
}

if ($accion == 'generateAll') {
    if ($idCurso != "") {
        $alumnos = $cursoDAL->getApprovedStudents($idCurso);

        foreach ($alumnos as $alumno):
            // si ya tiene certificado, que siga
            if ($cursoDAL->verifyCertificateWithdrawal($alumno->getDni(), $idCurso)) {
                continue;
            }

            // generar certificado
            $idCertificado = $cursoDAL->verifyCertificateIssuance($dni, $idCurso);
            $cursoDAL->issueCertificate($alumno->getDni(), $idCurso);
            generateCertificate($idCurso, $alumno->getDni(), $idCertificado[1]);

        endforeach;

        header('Location: index.php?id=' . $idCurso);
    }
}