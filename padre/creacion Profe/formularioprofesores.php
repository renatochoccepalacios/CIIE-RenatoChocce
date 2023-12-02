<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario registro profesores</title>
<link rel="stylesheet" href="./styles.css">

</head>
<body>
  <form name="form1" method="post" action="./intermedio.php">
    
    <h2>Profesor</h2>
    <div class="test">
      
      <div class="left-column">
        <input type="text" name="nombre_profe" id="nombre_profe" placeholder="Nombre">
    
        <input type="text" name="apellido_profe" id="apellio_profe" placeholder="Apellido">

        <input type="text" name="dni" id="dni" placeholder="Dni">
        
        <input type="text" name="cuil" id="cuil" placeholder="Ciul">
      </div>
      
    
      <div class="right-column">
        <input type="text" name="telefono" id="telefono" placeholder="Telefono">

        <input type="text" name="correo" id="correo" placeholder="Correo">

        <input type="text" name="password" id="password" placeholder="Contraseña">

        <label for="foto" class="sub-title">Foto</label>

        <input type="file" name="foto" id="foto">  
      </div>
    </div>
    
    <div class="btns">
      <button type="submit" name="submit-profesor" id="submit-profesor">Enviar</button>
    </div>

  </form>
</body>
</html>



