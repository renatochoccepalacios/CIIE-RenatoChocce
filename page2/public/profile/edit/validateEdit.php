<?php

session_start();

include_once(__DIR__ . "\..\..\..\dirs.php");

if (!isset($_SESSION['user'])) {
    $_SESSION['source'] = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    header('Location: ' . ROOT_URL . '\public\login');
} else if (isset($_SESSION['source'])) {
    unset($_SESSION['source']);
}

require_once(MODELS_PATH . "\Usuario.php");
require_once(MODELS_PATH . "\DAL\UsuarioDAL.php");
require_once(MODELS_PATH . "\DAL\NivelDAL.php");
require_once(MODELS_PATH . "\DAL\AreaDAL.php");

$name = isset($_POST['name']) ? $_POST['name'] : "";
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
$dni = isset($_POST['dni']) ? $_POST['dni'] : "";
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
$mail = isset($_POST['mail']) ? $_POST['mail'] : "";

$niveles = isset($_POST['niveles']) ? $_POST['niveles'] : [];
$areas = isset($_POST['areas']) ? $_POST['areas'] : [];

$usuario = new Usuario($dni, $name, $apellido, "", $mail, $telefono, "", "");
$usuarioDAL = new UsuarioDAL();
$usuarioDAL->update($usuario);

$usuario = $usuarioDAL->getPerId($dni);

$usuarioDAL->deleteNiveles($dni);

foreach ($niveles as $nivel) {
    $usuarioDAL->addNivel($dni, $nivel);
}

$usuarioDAL->deleteAreas($dni);

foreach ($areas as $area) {
    $usuarioDAL->addArea($dni, $area);
}

header('Location: ..\index.php');
