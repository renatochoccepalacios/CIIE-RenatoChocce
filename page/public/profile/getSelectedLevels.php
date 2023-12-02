<?php

include_once(__DIR__ . "\..\..\dirs.php");
require_once(MODELS_PATH . "\DAL\UsuarioDAL.php");

$receivedData = json_decode(file_get_contents('php://input'), true);

$usuarioDAL = new UsuarioDAL();
$dataNiveles = $usuarioDAL->getPerId($receivedData['dni']);

$niveles = [];

foreach ($dataNiveles->getNiveles() as $nivel) {
    $niveles[] = $nivel->getId();
}

echo json_encode($niveles);
