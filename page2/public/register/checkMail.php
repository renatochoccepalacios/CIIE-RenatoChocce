<?php

include_once(__DIR__ . "\..\..\dirs.php");
require_once(MODELS_PATH . "/DAL/UsuarioDAL.php");

if ($_POST['mail'] == "") {
    //@todo generar el error
    echo "Debe ingresar una dirección de correo electrónico.";
    exit;
}

$dal = new UsuarioDAL();
$resp = $dal->verifyMail($_POST['mail']);
 //@todo generar el error 
echo $resp == 1 ? "El correo ingresado ya se encuentra en uso." : 0;
