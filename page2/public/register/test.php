<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/SuperCIIE/page/dirs.php");
require_once(MODELS_PATH . "/Usuario.php");
require_once(MODELS_PATH . "/DAL/UsuarioDAL.php");

$areas = isset($_POST['areas']) ? $_POST['areas'] : [];
$niveles = isset($_POST['niveles']) ? $_POST['niveles'] : [];

$areas = json_decode($areas);
$niveles = json_decode($niveles);

$name = isset($_POST['name']) ? $_POST['name'] : "";
$surname = isset($_POST['surname']) ? $_POST['surname'] : "";
$dni = isset($_POST['dni']) ? $_POST['dni'] : "";
$mail = isset($_POST['mail']) ? $_POST['mail'] : "";
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

$accion = isset($_POST['accion']) ? $_POST['accion'] : "";

if ($dni != "" && $password != "" && $name != "" && $surname != "" && $mail != "" && $phone != "" && count($areas) != 0 && count($niveles) != 0) {
    $usuario = new Usuario($dni, $name, $surname, $password, $mail, $phone, 1, 1);

    $dal = new UsuarioDAL();

    if ($dal->validarDni($dni) === 0 && $dal->verifyMail($mail) === 0) {
        echo "PEPE";
        $insert = $dal->insert($usuario);
        echo 1;

        foreach ($areas as $area):
            $dal->addArea($dni, $area);
        endforeach;

        foreach ($niveles as $nivel):
            $dal->addNivel($dni, $nivel);
        endforeach;

    } else {
        if ($dal->validarDni($dni) === 1) {

            echo '<?xml version="1.0" ?><!DOCTYPE svg  PUBLIC "-//W3C//DTD SVG 1.0//EN"  "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd"><svg height="80" style="overflow:visible;enable-background:new 0 0 32 32" viewBox="0 0 32 32" width="80" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g id="Error_1_"><g id="Error"><circle cx="16" cy="16" id="BG" r="16" style="fill:#D72828;"/><path d="M14.5,25h3v-3h-3V25z M14.5,6v13h3V6H14.5z" id="Exclamatory_x5F_Sign" style="fill:#FFFFFF;"/></g></g></g></svg>';
            // ya existe un usuario con el dni ingresado
            //@todo generar el error
            echo "<p class='error'>Ya existe un usuario con el dni ingresado.</p>";
            // setcookie("ERROR", "Cod6", time() + (20), "/");
        } else {
            // ya existe un usuario con el mail ingresado
            //@todo generar el error
            echo '<?xml version="1.0" ?><!DOCTYPE svg  PUBLIC "-//W3C//DTD SVG 1.0//EN"  "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd"><svg height="80" style="overflow:visible;enable-background:new 0 0 32 32" viewBox="0 0 32 32" width="80" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g id="Error_1_"><g id="Error"><circle cx="16" cy="16" id="BG" r="16" style="fill:#D72828;"/><path d="M14.5,25h3v-3h-3V25z M14.5,6v13h3V6H14.5z" id="Exclamatory_x5F_Sign" style="fill:#FFFFFF;"/></g></g></g></svg>';
            echo "error codigo 7";
            // setcookie("ERROR", "Cod7", time() + (20), "/");
        }
    }
} else {
    //@todo generar error formulario incompleto
    echo '<?xml version="1.0" ?><!DOCTYPE svg  PUBLIC "-//W3C//DTD SVG 1.0//EN"  "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd"><svg height="80" style="overflow:visible;enable-background:new 0 0 32 32" viewBox="0 0 32 32" width="80" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g id="Error_1_"><g id="Error"><circle cx="16" cy="16" id="BG" r="16" style="fill:#D72828;"/><path d="M14.5,25h3v-3h-3V25z M14.5,6v13h3V6H14.5z" id="Exclamatory_x5F_Sign" style="fill:#FFFFFF;"/></g></g></g></svg>';
    echo "<p class='error'>Falta información</p>";
}
