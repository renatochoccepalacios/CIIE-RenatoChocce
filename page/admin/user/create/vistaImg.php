<?php
if(!empty($_GET['dni'])){
    $dni=$_GET["dni"];
    //Credenciales de conexion
    $Host = 'localhost';
    $Username = 'root';
    $Password = '';
    $dbName = 'superciie';
    
    //Crear conexion mysql
    $conexion = new mysqli($Host, $Username, $Password, $dbName);
    
    //revisar conexion
    if($conexion->connect_error){
       die("Connection failed: " . $conexion->connect_error);
    }
    
    //Extraer imagen de la BD mediante GET
    $result = $conexion->query("SELECT imagen FROM usuarios WHERE dni = '$dni'");
    
    if($result->num_rows > 0){
        $imgDatos = $result->fetch_assoc();
        
        //Mostrar Imagen
        header("Content-type: image/png"); 
        echo $imgDatos['imagen'];   
    }else{
        echo 'Imagen no existe...';
    }
}
?>