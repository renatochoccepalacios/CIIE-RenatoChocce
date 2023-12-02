<?php

require_once("../../../app/models/DAL/AreaDAL.php");

require_once("../../../app/models/main.php");

 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-area"])) {

    $nombreArea = $_POST["nombreArea"];

    $area = new Area($nombreArea);
    
    $areaDAL = new AreaDAL();

    $idArea = $areaDAL->insertArea($area);   
    
    header("Location: ../../../admin/areas/");
    exit;
 }

    ?>
