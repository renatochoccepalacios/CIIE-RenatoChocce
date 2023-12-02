
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php

include_once 'templates/header.php';

//require_once $_SERVER['DOCUMENT_ROOT'] . "/CIIE/page/dirs.php";
require_once MODELS_PATH . "\DAL\UsuarioDAL.php";
require_once MODELS_PATH . "\DAL\CursoDAL.php";

/* if (!isset($_SESSION['user']) || $_SESSION['tipoCuenta'] == 1) {
    header('Location: ' . ROOT_URL . '\public\login');
} else if (isset($_SESSION['source'])) {
    unset($_SESSION['source']);
} */

$cursoDAL = new CursoDAL();
$usuarioDAL = new UsuarioDAL();

//* temporal. hay que hacerlo bien...........

if (isset($_SESSION['user'])) {

    $dni = $_SESSION['user'];
    $usuario = $usuarioDAL->getPerId($dni);
?>
    <h1>Te damos la bienvenida,
        <?= $usuario->getNombre() ?>
    </h1>

    <a href="../public/">sitio principal</a>
    <a href="curso/create/">crear curso</a>
    <a href=" cursos/">lista de cursos</a>
    <!-- <a href="../public/login/logout.php">cerrar sesion</a> -->
    <a href="logout.php">cerrar sesion</a>
<?php
} else {
    header('Location: login.php');
}
?>
</body>
</html>

