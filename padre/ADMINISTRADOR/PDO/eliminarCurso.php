<?php
require_once('CursoDAL.php');

$cursoDAL = new CursoDAL();
$idCurso = $_GET['id'];
$eliminadoCronograma = $cursoDAL->eliminarCronogramaPorCurso($idCurso);
$eliminadoCurso = $cursoDAL->eliminarCurso($idCurso);
header("Location: AbmCurso.php");


/* if (isset($_GET['id'])) {
    $idCurso = $_GET['id'];

    // instancia la clase CursoDAL para acceder a la base de datos
    $cursoDAL = new CursoDAL();

    // elimina los registros de cronograma
    $eliminadoCronograma = $cursoDAL->eliminarCronogramaPorCurso($idCurso);

    if ($eliminadoCronograma) {
        // elimina el curso de la base de datos.
        $eliminadoCurso = $cursoDAL->eliminarCurso($idCurso);

        if ($eliminadoCurso) {
            // Curso eliminado con éxito.
            header("Location: AbmCurso.php"); // mandamos al usuario a la pagina principal
        } else {
            // Error al eliminar el curso.
            echo "Error al eliminar el curso.";
        }
    } else {
        // Error al eliminar registros en la tabla 'cronograma'.
        echo "Error al eliminar registros en la tabla cronograma ";
    }
} */
