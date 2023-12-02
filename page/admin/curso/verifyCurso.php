<?php

require_once APP_PATH . '/modules/getError.php';
require_once APP_PATH . '/modules/setInfo.php';
require_once MODELS_PATH . '/DAL/cursoDAL.php'; // pasar a mayusculas

$cursoDAL = new CursoDAL();

// verifica si se ingresó un id de curso en la url
if (!isset($_GET['id'])) {
    getError('Cod47');

    if (!isset($_SERVER['CONTENT_TYPE'])) {
        header('Location: ' . ROOT_URL . '/admin/cursos');
    }
    $message['source'] = ROOT_URL . '\admin\cursos';
    echo json_encode($message);
    exit();
}

$idCurso = $_GET['id'];

// verifica si el curso existe
if (!$cursoDAL->verifyCourse($idCurso)) {
    getError('Cod48');
    $message['source'] = ROOT_URL . '\admin\cursos';
    echo json_encode($message);
    exit();
}


// verifica si el usuario es administrador
if ($_SESSION['tipoCuenta'] != 3) {
    // verifica si el usuario es al menos profesor de este curso
    if ($cursoDAL->verifyETR($_SESSION['user'], $_GET['id']) == 0) {
        // si el valor es 0, significa que el usuario que intenta acceder al curso no es profesor del mismo
        getError('Cod46');
        $message['source'] = ROOT_URL . '\admin\cursos';
        echo json_encode($message);
        exit();
    }
}

// en caso de que sea profesor, no hacemos nada mas