<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>Creación de Area</title>
  <link rel='stylesheet' href='styles/styles.css'>
</head>
<?php include_once '../../templates/header.php';?>

<body>

<?php
require_once("../../../app/models/DAL/areaDAL.php");
$idArea = $_GET['id'];
$areaDAL = new areaDAL;
$area = $areaDAL->getAreaPorId($idArea);

?>


<script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>  


  <form name='form1' method='post' action='modifyarea.php'>
  <div class="back">
            <a href="../../index.php" class="a-back" >
                <i class="fa fa-arrow-left"></i>
            </a>  
        </div>
    <div id='left-column'>
      <h1>Modificar Area</h1>
      <input type="hidden" name="id" value="<?= $idArea; ?>">
      <label for='nombrAarea'>Nombre del area</label>
      <input type='text' name='nombreArea' id='nombreArea' value="<?= $area->getArea(); ?>">
    </div>

    <div id='right-column'>
      
      <input type='submit' name='submit-area' id='submit-area' value='Enviar'>
    </div>
  </form>

</body>

</html>