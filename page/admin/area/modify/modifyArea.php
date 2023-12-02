<?php

require_once("../../../app/models/DAL/areaDAL.php");

require_once("../../../app/models/main.php");

   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-area"])) {

    $nombreArea = $_POST["nombreArea"];

    $areaDAL = new AreaDAL();

    $idArea = $_POST['id'];

    $area = new Area($nombreArea, $idArea);
    $areaDAL->updatearea($area, $idArea);     

    header("Location: ../../areas");
    exit;
 }
 

 

    ?>
