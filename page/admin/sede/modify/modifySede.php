<?php

require_once("../../../app/models/DAL/sedeDAL.php");

require_once("../../../app/models/main.php");

   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-sede"])) {

   $nombreSede = $_POST["nombreSede"];
   $direccion = $_POST["direccion"];
   $altura = $_POST["altura"];
   $localidad = $_POST["localidad"];
    
   $sedeDAL = new sedeDAL();
   $idSede = $_POST['id'];
   $sede = new sede($nombreSede,$direccion,$altura,$localidad, $idSede);

   $sedeDAL->updatesede($sede, $idSede);     

    header("Location: ../../sedes");
    exit;
 }
 

 

    ?>
