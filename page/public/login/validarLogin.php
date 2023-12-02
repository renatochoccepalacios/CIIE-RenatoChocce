<?php

include_once(__DIR__ . "\..\..\dirs.php");

require_once(MODELS_PATH . "/Usuario.php");
require_once(MODELS_PATH . "/DAL/UsuarioDAL.php");
require_once APP_PATH . "/modules/getError.php";
require_once APP_PATH . "/modules/setInfo.php";

$receivedData = json_decode(file_get_contents('php://input'), true);

$dni = isset($receivedData["dni"]) ? $receivedData['dni'] : "";
$password = isset($receivedData['password']) ? $receivedData["password"] : "";

$message = ['login' => false];

if ($dni != "" && $password != "") {
    // verificamos que se hayan enviado los datos
    $dal = new UsuarioDAL();
    $res = $dal->login($dni, $password);

    if ($res == 0) {
        // credenciales invalidas
        getError('Cod1');

    } else {
        // credenciales correctas
        setInfo('Cod1');

        session_start();
        $_SESSION['user'] = $dni;
        $_SESSION['tipoCuenta'] = $res;

        $message['login'] = true;

        if (isset($_SESSION['source'])) {
            // verificamos si existe un enlace de origen
            $message['source'] = $_SESSION['source'];

        } else {
            // si no tiene enlace de origen, derivamos segun tipo de cuenta
            switch ($res) {
                case 1:
                    // cursante
                    $message['source'] = ROOT_URL . '/public/cursos/';
                    break;

                case 2:
                case 3:
                    // etr y admin
                    $message['source'] = ROOT_URL . '/admin';
                    break;
            }
        }
    }
} else {
    // @todo generar error (no se enviaron datos)
    getError('Cod2');
}

echo json_encode($message);

//! MODIFICAR VALIDACIONES Y CASOS DE ERROR