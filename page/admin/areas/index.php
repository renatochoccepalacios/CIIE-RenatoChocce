<?php

include_once '../templates/header.php';

require_once MODELS_PATH . '/DAL/AreaDAL.php';


$areaDAL = new areaDAL();
$areas = $areaDAL->getAreas();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIIE | areaES</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/a8aa7b0eff.js" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</head>

<body>
            <table class="tabla-resultados">
                <tr>

                    <th>ID AREA</th>
                    <th>AREA</th>
                    <th>MODIFICAR</th>



                </tr>
                <?php foreach ($areas as $area) { ?>
                    <tr>
                    <td>
                            <?php echo $area->getIdArea(); ?>
                        </td>
                        <td>
                            <?php echo $area->getArea(); ?>
                        </td>
                        <td>
                            <a type="submit" class="editar-buttom" href="<?= ROOT_URL ?>/admin/area/modify?id=<?php echo $area->getIdArea(); ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>

                    </tr>
                <?php } ?>
            </table>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>