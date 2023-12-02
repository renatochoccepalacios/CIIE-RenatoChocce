<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/f7e3d1bc93.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./update/css/style.css">
  <link rel="stylesheet" href="./update/css/listaUsers.css">
  <title>Usuarios</title>
</head>
<body>
<?php 
    include_once '../templates/header.php';

?>
    
  <?php 

      require_once("../../app/models/DAL/UsuarioDAL.php");
      require_once("../../app/models/Usuario.php");


      if (isset($_GET["dni"])) {
          $dni = $_GET["dni"];
          $usuarioDAL = new UsuarioDAL();
          $usuario = $usuarioDAL->getPerId($dni);

        if($usuario){
      ?>

        <div class="cont">
        
          <form class="form" action="./update/editarUser.php" method="get">
            <div class="cont-icon">
              <a class="icono" href="../users"><i class="fa-solid fa-arrow-left fa-2xl" style="color: #000;"></i></a>
            </div>
              
              <h1>Detalles del Usuario</h1>
              <div class="info">

                    <div class="date">
                        <p><b>Nombre y apellido:</b> <?= $usuario->getNombre() . " " . $usuario->getApellido(); ?></p>
                        <p><b>DNI:</b> <?= $usuario->getDni(); ?></p>
                        <p><b>Telefono:</b> <?=  $usuario->getTelefono(); ?></p>
                        <p><b>Correo:</b> <?=  $usuario->getCorreo(); ?></p>
                        <p><b>Estado:</b> <?=  $usuario->getEstado(); ?></p>
                        <p><b>Tipo de Cuenta:</b> <?=  $usuario->getTipoCuenta(); ?></p>
                    </div>
                    
                    <?php
                    if($usuario->getTipoCuenta() == "ETR"){
                      
                      echo "<p><b>Foto:</b><img src=". $usuarioDAL->mostrarImagenEtr($dni) ."></p>";
                      
                    }
                    ?>
                  
                  <input type="hidden" name="password" value="<?=$usuario->getPassword(); ?>">
                  
                  <input type="hidden" name="dni" value="<?=$dni; ?>">

              </div>
              

            <div class="btn">

                  <input type="submit" value="Editar User" class="envio">
            </div>
          </form>

      </div>

        <?php 
        
        }else{
          echo "Usuario no encontrado";
        }

      }


  ?>
</body>
</html>