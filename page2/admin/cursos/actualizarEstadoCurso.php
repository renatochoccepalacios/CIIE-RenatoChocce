<?php

// require_once MODELS_PATH . '/DAL/cursoDAL.php';

require_once('../../app/models/DAL/cursoDAL.php');

$idCurso = $_GET["id"];
$idEstado = $_GET["estado"];

// validar el id del estado si es igual a uno actualizo el curso con el estado 2 y viceversa
// Validar el nuevo estado (1 o 2)
$nuevoEstado = $idEstado == 1
    ? 2
    : 1;

// Aquí deberías tener una instancia de CursoDAL
$cursoDAL = new CursoDAL();

// Actualizar el estado del curso
$cursoDAL->actualizarEstadoCurso($idCurso, $nuevoEstado);

// echo json_encode(['status' => 'success', 'message' => 'Estado actualizado']);
echo json_encode(['status' => 'success']);
