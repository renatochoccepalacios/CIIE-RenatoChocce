<?php

require_once '../../dirs.php';
require_once MODELS_PATH . '/DAL/UsuarioDAL.php';

$newPassword = $_POST['password'];
$resetID = $_POST['resetID'];

$usuarioDAL = new UsuarioDAL();

$dniUsuario = $usuarioDAL->getResetInfo($resetID)['dniUsuario'];
$usuarioDAL->changePassword($newPassword, $dniUsuario);

header('Location: ../login/');
