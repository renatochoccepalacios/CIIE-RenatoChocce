<?php

require_once("../../../app/models/DAL/NivelDAL.php");

require_once("../../../app/models/main.php");

 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-nivel"])) {

    $nombreNivel = $_POST["nombreNivel"];

    $nivel = new Nivel($nombreNivel);
    
    $nivelDAL = new nivelDAL();

    $idNivel = $nivelDAL->insertNivel($nivel);   
    
    header("Location: ../../../admin/niveles/");
    exit;
 }

    ?>
