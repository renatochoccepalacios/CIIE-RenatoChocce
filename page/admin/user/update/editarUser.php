<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/f7e3d1bc93.js" crossorigin="anonymous"></script>

    <title>Editar Usuario</title>
</head>
<body>
    <?php 
        include_once '../../templates/header.php';

        require_once("../../../app/models/DAL/UsuarioDAL.php");
        require_once("../../../app/models/Usuario.php");


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
            $dni = $_POST["dni"];
            $usuarioDAL = new UsuarioDAL();
             
            if(is_object($usuarioDAL->getPerId($dni))){
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $password = $_POST["password"];
                $telefono = $_POST["telefono"];
                $correo = $_POST["correo"];
                $estado = $_POST["estado"];
                $tipoCuenta = intval($_POST["tipoCuenta"]);




                //solo para ETR
                if($tipoCuenta == 'ETR'){

                    $imagen = $_POST["imagen"];

                    $usuario = new Usuario($dni, $nombre, $apellido, $password, $telefono, $correo, $estado, $tipoCuenta, $imagen);
    
                    if($tipoCuenta != $usuarioDAL->obtenerTipo($dni)){

                        $usuarioDAL->updateTipoCuenta($tipoCuenta, $dni);
                        
                    }
                    
                    
                    $usuarioDAL->update($usuario);

                    

                }else{

                    //para demas tipo de usuario

                    if($tipoCuenta != $usuarioDAL->obtenerTipo($dni)){
                        
                        $usuarioDAL->updateTipoCuenta($tipoCuenta, $dni);

                    }


            
                    
                    $usuario = new Usuario($dni, $nombre, $apellido, $password, $telefono, $correo, $estado, $tipoCuenta);
                    

                    $usuarioDAL->update($usuario);


                }

        ?>
            <div class="container">

                <div class="msj">
                    
                    <a href='../../users'><i class="fa-solid fa-arrow-left fa-2xl" style="color: #000;"></i></a>

                    <h1 class="title-msj">Datos Actualizados</h1>


                    <p class="datos">DNI: <?= $usuario->getDni()?></p>
                    <p class="datos">nombre: <?= $usuario->getNombre()?></p>
                    <p class="datos">Apellido: <?= $usuario->getApellido()?></p>
                    <p class="datos">Telefono: <?= $usuario->getTelefono()?></p>
                    <p class="datos">Correo: <?= $usuario->getCorreo()?></p>
                    <p class="datos">Estado: <?= $usuario->getEstado()?></p>
                    <p class="datos">Tipo Cuenta: <?php echo $tipoCuenta?></p>
    

                </div>
            </div>


                <?php
            }else{
                echo "<p>Usuario no encontrado</p>";
            }

        }else if (isset($_GET['dni'])) {
            $dni = $_GET['dni'];
            $usuarioDAL = new UsuarioDAL();
            $usuario = $usuarioDAL->getPerId($dni);

            if($usuario){
    ?>


<div class="container">
       
        
        <form class="form-edit"action="editarUser.php" method="post">

                <a href='../../users'><i class="fa-solid fa-arrow-left fa-2xl" style="color: #000;"></i></a>
            
                <h1>Editar Usuario</h1>
                
                <div class="test">
    
                    <div class="left-column">
    
                        <input type="hidden" name="dni" value="<?= $dni ?>"> <!--no s emuestra -->
        
                        <label class="label-inputs" for="">Nombre</label>
                        <input class="inputs-text" type="text" name="nombre" value="<?= $usuario->getNombre()?>">
        
                        <label class="label-inputs" for="">Apellido</label>
                        <input class="inputs-text" type="text" name="apellido" value="<?= $usuario->getApellido()?>">
                        
                        <!--no se muestra la contraseña-->
                        <input type="hidden" name="password" value="<?= $usuario->getPassword()?>">
        
                        <label class="label-inputs" for="">Telefono</label>
                        <input class="inputs-text" type="text" name="telefono" value="<?= $usuario->getTelefono()?>">
        
                    </div>
                    
                    
                    <div class="right-column">
                        <label class="label-inputs" for="">Correo</label>
                        <input class="inputs-text" type="text" class="correo" name="correo" value="<?= $usuario->getCorreo()?>">
    
                        <label class="label-inputs" for="">Estado</label>
                        <select class="select" name="estado" id="estado">
                            <?php 
                                echo "<option value=" . $usuario->getEstado() .">" . $usuario->getEstado() . "</option>";
        
                                if($usuario->getEstado() == "Inhabilitado"){
                                ?>
        
                                <option value="1">Habilitado</option>
                            
                            <?php 
                                }else if($usuario->getEstado() == "Habilitado"){
                            ?>
        
                                <option value="2">Inhabilitado</option>
        
                            <?php 
                                }
                            ?>
        
                        </select>
        
        
                        
                        <label class="label-inputs" for="">Tipo de Cuenta</label>
                        <select class="select" name="tipoCuenta" id="tipoCuenta">
                            <?php 
                                echo "<option value=". $usuario->getTipoCuenta() . ">". $usuario->getTipoCuenta() . "</option>";
        
                                if($usuario->getTipoCuenta() == "Admin"){
                            ?>
                                <option value="2">ETR</option>
                                <option value="1">Cursante</option>
        
                            <?php
                                }else if($usuario->getTipoCuenta() == "ETR"){
                            ?>
                                    <option value="1">Cursante</option>
                                    <option value="3">Admin</option>
                            
                            <?php 
                                }else{
                            ?>
                                    <option value="2">ETR</option>
                                    <option value="3">Admin</option>
                            <?php
                                }
                            ?>
                        </select>
                        
                        <?php 
                            if($usuario->getTipoCuenta() == 'ETR'){
        
                            echo  "<label>Foto</label>";
                                echo "<input type='text' name='imagen' value=" . $usuario->getImagen() . ">";
                            }
                        
                        ?>
                    </div>
    
                </div>    
                
                
                <div class="btns">
    
                    <input class="guardar" type="submit" name="guardar" value="Guardar Cambios">
                </div>
    
    
            </form>
        
    </div>

    <?php 
            }else{
                echo "<p>Usuario no encontrado</p>";
            }
        }
    ?>

</body>
</html>