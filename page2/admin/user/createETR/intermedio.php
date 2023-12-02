<?php 
include_once '../../templates/header.php';


require_once MODELS_PATH . '/DAL/UsuarioDAL.php';
require_once MODELS_PATH . '/DAL/estadoDAL.php';
require_once MODELS_PATH . '/Usuario.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-profesor"])) {

    $dni = $_POST["dni"];
    $nombre = $_POST["nombre_profe"];
    $apellido = $_POST["apellido_profe"];
    $password = $_POST["password"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $tipoCuenta = 2;
    $estado = 1;
    $imagen = $_POST["imagen"];

    $profesor = new ETR (       $dni,
                                $nombre,
                                $apellido,
                                $password,
                                $telefono,
                                $correo,
                                $estado,
                                $tipoCuenta,
                                $imagen 
    );

    $profesorDAL = new UsuarioDAL();

    $profesorDAL->insert($profesor);



          // Mostrar datos del profe
          echo "<br>Nombre del Profesor: " . $nombre . " " . $apellido;
          echo "<br>DNI: " . $dni;
          echo "<br>Telefono: " . $telefono;
          echo "<br>Estado: " . $estado;
          echo "<br>Correo: " . $correo;
          echo "<br>Tipo de cuenta: " . $tipoCuenta;
          echo "<br>Foto: " . $imagen ."<br>";
          echo $profesorDAL->getImagen($imagen);


}else{
    echo "error";
}

?>