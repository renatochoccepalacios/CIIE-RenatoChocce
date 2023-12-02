<?php

// importar archivos necesarios
include_once(__DIR__ . "\..\..\dirs.php");
require_once(MODELS_PATH . "\DAL\UsuarioDAL.php");

$receivedData = json_decode(file_get_contents('php://input'), true);

// obtener usuario y sus areas
$usuarioDAL = new UsuarioDAL();
$dataAreas = $usuarioDAL->getPerId($receivedData['dni']);

// crear array para insertar los id de los areas
$areas = [];

// recorrer las areas del usuario e insertar los id en el array anteriormente mencionado
foreach ($dataAreas->getAreas() as $area) {
    $areas[] = $area->getId();
}

// devolver en formato json el array
echo json_encode($areas);
