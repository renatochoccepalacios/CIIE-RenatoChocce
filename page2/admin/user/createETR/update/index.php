<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Modificar Usuario</title>
</head>
<body>


<form action="profes.php" method="get">
    <label for="tipoCuenta" >Usuario </label>
    
    <input type="text" name="dni" id="dni" list="listaUsuarios">

    <datalist id="listaUsuarios">
       <<?php 
         require_once("../../../../app/models/DAL/UsuarioDAL.php");
            $usuarioDAL = new UsuarioDAL();
            $usuarioDAL->mostrarProfesores(); 
        ?> 
    </datalist> 

    <button type="submit" name="enviar">buscar</button>

<h1>hola</h1>
</form>
</body>
</html>