<?php  


    require_once("../../app/models/DAL/UsuarioDAL.php");

    $usuarioDAL = new UsuarioDAL();

    try {
        $estado = isset($_GET['estado']) ? htmlspecialchars($_GET['estado']) : null;
        $tipoCuenta = isset($_GET['tipoCuenta']) ? htmlspecialchars($_GET['tipoCuenta']) : null;

        $filtrarUser = $usuarioDAL->filtrarUser($estado, $tipoCuenta);

       
        echo json_encode(['status' => 'success', 'data' => $filtrarUser]);

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }


?>