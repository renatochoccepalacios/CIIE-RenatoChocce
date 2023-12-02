<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>Creación de Sedes</title>
  <link rel='stylesheet' href='styles/styles.css'>
</head>
<?php include_once '../../templates/header.php';?>

<body>


<script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>  


  <  <form id='form1' name='form1' method='post' action='crearSede.php'>
  <div class="back">
            <a href="../../index.php" class="a-back" >
                <i class="fa fa-arrow-left"></i>
            </a>  
        </div>
        <h1>Crear Sede</h1>

      <div id='left-column'>
        <input type="hidden" name="id" value="<?= $idSede; ?>">
        <label for='nombreSede'>Nombre de la Sede</label>
        <input type='text' name='nombreSede' id='nombreSede' require>

        <label for='direccion'>Direccion</label>
        <input type='text' name='direccion' id='direccion' require>




      </div>

      <div id='right-column'>
      <label for='altura'>Altura</label>
        <input type='text' name='altura' id='altura' require>

        <label for='localidad'>Localidad</label>
        <input type='text' name='localidad' id='localidad' require>
      </div>
      <input type='submit' name='submit-sede' id='submit-sede' value='Crear'>

  </form>

</body>

</html>