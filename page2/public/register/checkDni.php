<?php

include_once(__DIR__ . "\..\..\dirs.php");
require_once(MODELS_PATH . "/DAL/UsuarioDAL.php");

if ($_POST['dni'] == "") {
//@todo generar error
    echo "Debe ingresar un número de documento.";
    exit;
}

$dal = new UsuarioDAL();
$resp = $dal->validarDni($_POST['dni']);
//@todo generar error
echo $resp == 1 ? "El DNI ingresado ya se encuentra en uso." : 0;
