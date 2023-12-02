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

if (!isset($_SESSION['user'])) {
    getError('Cod4');
    $message['source'] = ROOT_URL . '/admin/cursos';
    echo json_encode($message);
    exit();

}

include_once __DIR__ . '/../verifyCurso.php';
require_once MODELS_PATH . "\DAL\UsuarioDAL.php";

// si el curso aun no empieza o si ya terminó
if ($cursoDAL->checkStart($idCurso) == 1) {
    getError('Cod52');
    $message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
    echo json_encode($message);
    exit();
} else {

    if ($cursoDAL->checkEnd($idCurso) == 0) {
        getError('Cod54');
        $message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
        echo json_encode($message);
        exit();
    }
}

// si ya se paso lista
if ($cursoDAL->checkAttendance($idCurso) == 1) {
    getError('Cod43');
    $message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
    echo json_encode($message);
    exit();
}

// $action = isset($_POST['action']) ? $_POST['action'] : "";

// if ($action == 'register') {
foreach ($receivedData as $alumno) {
    $cursoDAL->setAttendance($alumno['dni'], $idCurso, $alumno['estado']);
}

// } else {
setInfo('Cod15');
$message['done'] = true;
$message['source'] = ROOT_URL . '/admin/curso/?id=' . $idCurso;
echo json_encode($message);
exit();
// }