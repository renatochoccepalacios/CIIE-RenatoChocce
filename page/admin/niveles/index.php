<?php

include_once '../templates/header.php';

require_once MODELS_PATH . '/DAL/nivelDAL.php';


$nivelDAL = new NivelDAL();
$niveles = $nivelDAL->getNiveles();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIIE | NIVELES</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/a8aa7b0eff.js" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</head>

<body>
            <table class="tabla-resultados">
                <tr>

                    <th>ID NIVEL</th>
                    <th>NIVEL</th>
                    <th>MODIFICAR</th>



                </tr>
                <?php foreach ($niveles as $nivel) { ?>
                    <tr>
                    <td>
                            <?php echo $nivel->getIdNivel(); ?>
                        </td>
                        <td>
                            <?php echo $nivel->getNivel(); ?>
                        </td>
                        <td>
                            <a type="submit" class="editar-buttom" href="<?= ROOT_URL ?>/admin/nivel/modify?id=<?php echo $nivel->getIdNivel(); ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>

                    </tr>
                <?php } ?>
            </table>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>