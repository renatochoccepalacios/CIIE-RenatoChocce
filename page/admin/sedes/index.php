<?php

include_once '../templates/header.php';

require_once MODELS_PATH . '/DAL/SedeDAL.php';


$sedeDAL = new sedeDAL();
$sedes = $sedeDAL->getSede();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIIE | SEDES</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/a8aa7b0eff.js" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</head>

<body>
    <table class="tabla-resultados">
        <tr>

            <th>ID SEDE</th>
            <th>SEDE</th>
            <th>DIRECCION</th>
            <th>ALTURA</th>
            <th>LOCALIDAD</th>
            <th>MODIFICAR</th>



        </tr>
        <?php foreach ($sedes as $sede) { ?>
            <tr>
                <td>
                    <?php echo $sede->getIdSede(); ?>
                </td>
                <td>
                    <?php echo $sede->getSede(); ?>
                </td>
                <td>
                    <?php echo $sede->getDireccion(); ?>
                </td>
                <td>
                    <?php echo $sede->getAltura(); ?>
                </td>
                <td>
                    <?php echo $sede->getLocalidad(); ?>
                </td>
                <td>
                    <a type="submit" class="editar-buttom" href="<?= ROOT_URL ?>/admin/sede/modify?id=<?php echo $sede->getIdSede(); ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </td>

            </tr>
        <?php } ?>
    </table>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>