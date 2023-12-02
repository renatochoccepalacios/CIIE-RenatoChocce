<?php

require_once("../../../app/models/DAL/sedeDAL.php");

require_once("../../../app/models/main.php");

 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-sede"])) {

    $nombreSede = $_POST["nombreSede"];
    $direccion = $_POST["direccion"];
    $altura = $_POST["altura"];
    $localidad = $_POST["localidad"];

    $sede = new sede($nombreSede,$direccion,$altura,$localidad);
    
    $sedeDAL = new sedeDAL();

    echo $idSede = $sedeDAL->insertSede($sede);   
    
   header("Location: ../../../admin/sedes/");
    exit; 
 }

    ?>
