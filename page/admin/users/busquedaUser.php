<?php 

include_once '../templates/header.php';

require_once "../../app/models/DAL/UsuarioDAL.php";

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
    <script src="appfilter.js?<?php echo time() ?>"></script>

    
</head>
<body>

        <form class="form-nav" action="" autocomplete="off">
            
            <label for="busqueda" class="label-search">Buscar Usuario </label>
            <input type="search" name="query" id="busqueda">
            
            <button type="submit" name="buscar" class="btn-buscar">Buscar</button>

            <div class="filtrar">
                <label for="estado" class="label-select">Estado: </label>
                <select class="filtrar-item" name="estado" id="estado">
                    <option value="">Todos</option>
                    <option value="1">Habilitado</option>
                    <option value="0">Inhabilitado</option>
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
        <?php 
            if (isset($_GET["query"])) {
                // obtenemos el query
                $query = $_GET["query"];

                // llamamos a la funcion buscar curso para buscar cursos
                $usuarioEncontrado = $usuarioDAL->buscarUser($query);

                if(!empty($usuarioEncontrado)){

            ?>

                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Tipo Cuenta</th>
                        <th>Modificar</th>
                    </tr>


                    <?php foreach ($usuarioEncontrado as $usuarios) { ?>
                    <tr>
                    <td>
                            <?php echo $usuarios->getDni()?>

                        </td>
                        <td>
                            <?php echo $usuarios->getNombre()?>
                        </td>
                        <td>
                            <?php echo $usuarios->getApellido()?>

                        </td>
                        <td>
                            <?php echo $usuarios->getTelefono()?>
                        </td>
                        <td>
                            <?php echo $usuarios->getCorreo()?>
                        </td>
                        <td>
                            <?php echo $usuarios->getEstado()?>
                        </td>
                        <td>
                            <?php echo $usuarios->getTipoCuenta()?>
                        </td>
                        <td>
                            <form action="../user/update/usuarios.php" method="get" class="form-editar">
                                <input type="hidden" name="dni" value="<?= $usuarios->getDni()?>"><button type="submit" class="editar"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php }
                }else{
                    echo "No se encontraron cursos que coincidan con la búsqueda.";

                }
            }else{
                echo "Ingresa un término de búsqueda en el formulario.";

            }?>


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