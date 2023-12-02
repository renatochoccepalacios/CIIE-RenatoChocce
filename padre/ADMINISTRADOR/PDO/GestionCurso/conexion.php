<?php 
    $db_host = 'localhost';
    $db_nombre = "ciie";
    $db_usuario = "root";
    $db_contra = "";

    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la BBDD";
        exit();
    }
    
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BBDD");
    
    mysqli_set_charset($conexion, "utf8");


    /* try{
        $db = new PDO(
            'mysql:host=localhost;
            dbname='.$db_nombre,
            $db_usuario,
            $db_contra
        );
    } catch (Exeption $e) {
        echo "Fallo en la conexion".$e->getMensaje();
    }
 */
?>