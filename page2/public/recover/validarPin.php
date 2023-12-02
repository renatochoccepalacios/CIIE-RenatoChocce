<?php

require_once '../../dirs.php';
require_once MODELS_PATH . '/DAL/UsuarioDAL.php';

$resetID = $_GET['id'];

// Obtener el ID de restablecimiento y el PIN ingresados por el usuario
$pinIngresado = $_POST['pin'];

$usuarioDAL = new UsuarioDAL();
if ($usuarioDAL->validatePin($resetID, $pinIngresado)) {
    header("Location: generarNuevaPassword.php?id=$resetID");
} else {
    //@todo generar error
    echo "error. intente nuevamente."; ?>
    <a href="ingresarPin.php?id=<?= $resetID ?>">Intentar nuevamente</a>
<?php }
