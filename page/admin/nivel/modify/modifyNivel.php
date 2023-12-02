<?php

require_once("../../../app/models/DAL/NivelDAL.php");

require_once("../../../app/models/main.php");

   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-nivel"])) {

    $nombreNivel = $_POST["nombreNivel"];

    $nivelDAL = new nivelDAL();

    $idNivel = $_POST['id'];

    $nivel = new Nivel($nombreNivel, $idNivel);
    $nivelDAL->updateNivel($nivel, $idNivel);     

    header("Location: ../../niveles/");
    exit;
 }
 

 

    ?>
