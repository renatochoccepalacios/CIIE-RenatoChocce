<?php 

require_once("../../../../app/models/DAL/UsuarioDAL.php");
require_once("../../../../app/models/Usuario.php");


if (isset($_GET["dni"])) {
    $dni = $_GET["dni"];
    $usuarioDAL = new UsuarioDAL();
    $usuario = $usuarioDAL->getPerId($dni);

   if($usuario){

        echo "<br>Su nombre y apellido es: " . $usuario->getNombre() . " " . $usuario->getApellido();
        echo "<br>DNI: " . $usuario->getDni();
        echo "<br>Telefono: " . $usuario->getTelefono();
        echo "<br>Estado: " . $usuario->getEstado();
        echo "<br>Correo: " . $usuario->getCorreo();
        echo "<br>Tipo de cuenta: " . $usuario->getTipoCuenta();

        echo "<br><a href='editarUser.php?dni=$dni'>Editar Usuario</a>";
    
   }else{
     echo "error";
   }






}


?>