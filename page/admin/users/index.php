<?php 

include_once '../templates/header.php';


require_once MODELS_PATH . '/DAL/UsuarioDAL.php';

$usuarioDAL = new UsuarioDAL();

$usuarios = $usuarioDAL->getData();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/f7e3d1bc93.js" crossorigin="anonymous"></script>
    
    
    <title>Lista ETRs</title>
    <script src="appfilter.js?<?php echo time() ?>"></script>
</head>
<body>

        <form class="form-nav" action="busquedaUser.php" method="get" autocomplete="off">
            
            <label for="busqueda" class="label-search">Buscar Usuario </label>
            <input type="search" name="query" id="busqueda">
            
            <button type="submit" name="buscar" class="btn-buscar">Buscar</button>




            <div class="filtrar">
                <label for="estado" class="label-select">Estado: </label>
                <select class="filtrar-item" name="estado" id="estado">
                    <option value="">Todos</option>
                    <option value="1">Habilitado</option>
                    <option value="2">Inhabilitado</option>
                </select>

                <label for="tipoCuenta" class="label-select">Tipo Cuenta: </label>
                <select class="filtrar-item" name="tipoCuenta" id="tipoCuenta">
                    <option value="">Todos</option>
                    <?php echo $usuarioDAL->mostrarUsuariosDos()?>
                </select>
            </div>

        </form>



        <div class="container">
            <table class="tabla" id="tabla-info">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Estado</th>
                        <th>Tipo Cuenta</th>
                        <th>Modificar</th>
                    </tr>
                </thead>

                <!--cuerpo tabla -->

                <tbody>
                    <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td>
                            <?php echo $usuario->getDni()?>

                        </td>
                        <td>
                            <?php echo $usuario->getNombre()?>
                        </td>
                        <td>
                            <?php echo $usuario->getApellido()?>

                        </td>

                        <td>
                            <?php echo $usuario->getEstado()?>
                        </td>
                        <td>
                            <?php echo $usuario->getTipoCuenta()?>
                        </td>
                        <td>
                            <form action="../user" method="get" class="form-editar">
                                <input type="hidden" name="dni" value="<?= $usuario->getDni()?>"><button type="submit" class="editar"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>

            </table>
        </div>






        

    <!-- <?php 
    /* 
        if (isset($_POST["tipoCuenta"])) {
            $tipoCuenta = $_POST["tipoCuenta"];
            $usuarioDAL = new UsuarioDAL();

            
            if($tipoCuenta){
                echo "<table class='table-info'>";
                echo "<tr>";
                echo '<th><b>Nombre</b></th>';
                echo '<th><b>Apellido</b></th>';
                echo '<th><b>DNI</b></th>';
                echo '<th><b>Telefono</b></th>';
                echo '<th><b>Correo</b></th>';
                echo '<th><b>Estado</b></th>';
                echo '<th><b>Tipo Cuenta</b></th>';
                echo '<th><b>Modificar</b></th>';
                echo "</tr>";

                $lista = $usuarioDAL->getListETR($tipoCuenta);

                echo "</table>";
            
            }
            


        } */
        
    ?> -->

</body>
</html>