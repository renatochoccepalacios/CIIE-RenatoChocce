<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario registro profesores</title>
<link rel="stylesheet" href="./css/styles.css">
<script src="https://kit.fontawesome.com/f7e3d1bc93.js" crossorigin="anonymous"></script>


</head>
<body>
<?php 
  include_once __DIR__ . '/../../templates/header.php';


?>

<div class="container">

    <form name="form1" method="post" action="./intermedio.php" enctype="multipart/form-data" autocomplete="off">
      
    <a href='../../admin'><i class="fa-solid fa-arrow-left fa-2xl" style="color: #000;"></i></a>

      <h2>Profesor</h2>
      <div class="test">

        
        <div class="left-column">
          <label for="nombre_profe">Nombre</label>
          <input type="text" name="nombre_profe" id="nombre_profe" >
      
          <label for="apellido_profe">Apellido</label>
          <input type="text" name="apellido_profe" id="apellio_profe">

          <label for="dni">DNI</label>
          <input type="text" name="dni" id="dni" >
          
          <label for="telefono">Telefono</label>
          <input type="text" name="telefono" id="telefono" >

        </div>
        
      
        <div class="right-column">

        <label for="correo">Correo Electrónico</label>
          <input type="text" name="correo" id="correo" eo">

          <label for="password">Contraseña</label>
          <input type="text" name="password" id="password">

          <label for="foto" class="sub-title">Foto</label>

          <input type="file" name="imagen" id="imagen">  
          
        </div>
      </div>
      
      <div class="btns">
        <button type="reset">Reset</button>
        <button type="submit" name="submit-profesor" id="submit-profesor">Enviar</button>
      </div>

    </form>
</div>

</body>
</html>



