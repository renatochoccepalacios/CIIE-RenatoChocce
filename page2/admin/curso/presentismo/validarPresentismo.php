<?php

// session_start();

/* if (!isset($_SESSION['user'])) {
    header('Location: ../');
} */

require_once __DIR__ . "\..\..\..\dirs.php";
require_once MODELS_PATH . '/DAL/CursoDAL.php';
// include_once __DIR__ . '/../modules/verifyCurso.php';

/* if (!isset($_SESSION['user'])) {
    $_SESSION['source'] = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    header('Location: ' . ROOT_URL . '\public\login');
} else if (isset($_SESSION['source'])) {
    unset($_SESSION['source']);
}
 */

require_once MODELS_PATH . "\DAL\UsuarioDAL.php";

// require_once(MODELS_PATH . "\Magia.php");

// $magia = new Magia();

$cursoDAL = new CursoDAL();

$alumnos = $_POST['alumnos'];
$idCurso = $_POST['idCurso'];
$alumnosCurso = $cursoDAL->getStudents($idCurso);

$array = [];

foreach ($alumnosCurso as $alumnoCurso) {

    foreach ($alumnos as $alumno) {
        if ($alumnoCurso->getDni() === $alumno) {
            $array[$alumnoCurso->getDni()] = "Presente";
        }
    }

    if (!isset($array[$alumnoCurso->getDni()])) {
        $array[$alumnoCurso->getDni()] = "Ausente";
    }
}

foreach ($array as $dni => $presentismo) {
    $cursoDAL->setAttendance($dni, $idCurso, $presentismo);
}

header('Location: ../index.php?id=' . $idCurso);