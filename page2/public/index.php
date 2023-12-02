<?php

include '../app/templates/header.php';

$dal = new UsuarioDAL();
$usuario = $dal->getPerId($_SESSION['user']);

echo "Te damos la bienvenida nuevamente.<br>";

echo $usuario->getNombre();

include '../app/templates/footer.php';