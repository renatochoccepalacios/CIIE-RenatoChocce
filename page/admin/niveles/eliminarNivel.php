<?php
require_once('NivelDAL.php');

$nivelDAL = new nivelDAL;
$idNivel = $_GET['id'];
$eliminadoCronograma = $nivelDAL->eliminarCronogramaPorCurso($idNivel);
$eliminadoNivel = $nivelDAL->eliminarCurso($idNivel);
header("Location: AbmCurso.php");


 if (isset($_GET['id'])) {
    $idNivel = $_GET['id'];

    // instancia la clase nivel$nivelDAL para acceder a la base de datos
    $nivelDAL = new nivel$nivelDAL();

    // elimina los registros de cronograma
    $eliminadoCronograma = $nivelDAL->eliminarCronogramaPorCurso($idNivel);

    if ($eliminadoCronograma) {
        // elimina el curso de la base de datos.
        $eliminadoNivel = $nivelDAL->eliminarCurso($idNivel);

        if ($eliminadoNivel) {
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
} 
