<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>Creación de niveles</title>
  <link rel='stylesheet' href='styles/styles.css'>
</head>
<?php include_once '../../templates/header.php';?>

<body>


<script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>  


  <form name='form1' method='post' action='crearNivel.php'>
  <div class="back">
            <a href="../../index.php" class="a-back" >
                <i class="fa fa-arrow-left"></i>
            </a>  
        </div>
    <div id='left-column'>
      <h1>Insertar Niveles</h1>
      <label for='nombreNivel'>Nombre del nivel</label>
      <input type='text' name='nombreNivel' id='nombreNivel' require>
    </div>

    <div id='right-column'>
      
      <input type='submit' name='submit-nivel' id='submit-nivel' value='Enviar'>
    </div>
  </form>

</body>

</html>