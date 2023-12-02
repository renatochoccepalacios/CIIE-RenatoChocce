
<link rel="stylesheet" href="./css/datosNewUser.css">

<?php 
include_once '../../templates/header.php';
include_once($_SERVER['DOCUMENT_ROOT'] . "/CIIE/page/dirs.php");


require_once MODELS_PATH . '/DAL/UsuarioDAL.php';
require_once MODELS_PATH . '/DAL/estadoDAL.php';
require_once MODELS_PATH . '/ETR.php';
    


    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-profesor"])) {
        
        $dni = $_POST["dni"];
        $nombre = $_POST["nombre_profe"];
        $apellido = $_POST["apellido_profe"];
        $password = $_POST["password"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $tipoCuenta = 2;
        $estado = 1;


        if (isset($_FILES["imagen"]["tmp_name"]) && !empty($_FILES["imagen"]["tmp_name"])) {

            $revisar = getimagesize($_FILES["imagen"]["tmp_name"]);
            $imagen = $_FILES['imagen']['tmp_name'];
            $imgContenido = addslashes(file_get_contents($imagen));



          $profesor = new ETR (   $dni,
                                  $nombre,
                                  $apellido,
                                  $password,
                                  $correo,
                                  $telefono,
                                  $tipoCuenta,
                                  $estado,
                                  $imgContenido
            );
        
            $profesorDAL = new UsuarioDAL();
        
            $confirmar = $profesorDAL->insert($profesor);

            
            // Mostrar datos del profe
            if(true){
        ?>



                <div class="conteiner">
                    <form action="../../users">
                        <h1>Nuevo Usuario</h1>

                        <div class="info">
                            <div class="imagen">
                                <?php
                                    echo  "<img src='vistaImg.php?dni=".$dni."' alt='Img' />";
                                ?>
                            </div>
                            
                            <div class="date">
                                <p><b>Nombre y apellido:</b> <?= $nombre . " " . $apellido ?></p>
                                <p><b>DNI:</b> <?= $dni ?></p>
                                <p><b>Telefono:</b> <?= $telefono ?></p>
                                <p><b>Estado:</b> <?= $estado ?></p>
                                <p><b>Correo:</b> <?= $correo ?></p>
                                <p><b>Tipo de Cuenta:</b> <?= $tipoCuenta ?></p>
                            </div>
                        </div>

                        <div class="btn">
                            <button type="submit">volver</button>
                        </div>
                    </form>
                </div>



        <?php
            }

            

        }
        
          
          
        }else{
            echo "error";
        }
        
        ?>