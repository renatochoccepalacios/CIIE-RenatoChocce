<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>Creación de Areas</title>
  <link rel='stylesheet' href='styles/styles.css'>
</head>
<?php include_once '../../templates/header.php';?>

<body>


<script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>  


  <form name='form1' method='post' action='crearArea.php'>
  <div class="back">
            <a href="../../index.php" class="a-back" >
                <i class="fa fa-arrow-left"></i>
            </a>  
        </div>
    <div id='left-column'>
      <h1>Insertar Area</h1>
      <label for='nombreArea'>Nombre del Area</label>
      <input type='text' name='nombreArea' id='nombreArea' require>
    </div>

    <div id='right-column'>
      
      <input type='submit' name='submit-area' id='submit-area' value='Enviar'>
    </div>
  </form>

</body>

</html>