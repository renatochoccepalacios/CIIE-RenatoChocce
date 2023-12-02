<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <?php 
        require_once("../../../../app/models/DAL/UsuarioDAL.php");
        require_once("../../../../app/models/Usuario.php");



        if (isset($_POS['dni'])) {
            $dni = $_POST['dni'];
            $usuarioDAL = new UsuarioDAL();
            $usuario = $usuarioDAL->getPerId($dni);

            if($usuario){
                
            }
        }
        
       

    
    ?>
</body>
</html>