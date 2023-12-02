<?php

// include '../../templates/header.php';
// include_once __DIR__ . '/../modules/verifyCurso.php';

// require_once(MODELS_PATH . "\Magia.php");

require_once $_SERVER['DOCUMENT_ROOT'] . '/SuperCIIE/page/dirs.php';
require_once MODELS_PATH . '/DAL/cursoDAL.php'; // curso a mayuscula

$idCurso = $_GET['id'];
$cursoDAL = new CursoDAL();

if ($cursoDAL->checkStart($idCurso) == 1)
    header('Location: ../index.php?id=' . $idCurso);
else if ($cursoDAL->checkAttendance($idCurso) == 1)
    header('Location: ../index.php?id=' . $idCurso);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar notas.....</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<style>
    #planilla {
        display: flex;
        flex-direction: column;
    }
</style>

<body>
    <a href="../?id=<?= $idCurso ?>">volver</a>
    <h1>Alumnos...............</h1>
    <form action="validarCalificacion.php?id=<?= $idCurso ?>" method="post">

        <div id="planilla">

            <input name="idCurso" value="<?= $idCurso ?>" type="hidden">

            <?php

            $alumnos = $cursoDAL->getStudents($idCurso);

            if (count($alumnos) > 0) {
                foreach ($alumnos as $alumno) {
                    ?>

                    <div>
                        <?= $alumno->getNombre() . " " . $alumno->getApellido() . " - " . $alumno->getDni() ?>
                        <label>
                            Aprobado
                            <input type="radio" name="<?= $alumno->getDni() ?>" value="Aprobado">
                        </label>
                        <label>
                            Desaprobado
                            <input type="radio" name="<?= $alumno->getDni() ?>" value="Desaprobado">
                        </label>
                        <label>
                            Ausente
                            <input type="radio" name="<?= $alumno->getDni() ?>" value="Ausente">
                        </label>
                    </div>
                    <?php
                }
            } else {
                ?>
                <h2>NO HAY ALUMNOS REGISTRADOS EN EL CURSO</h2>
                <?php
            }
            ?>

        </div>

        <button type="submit" name="accion" value="enviar">Enviar</button>
    </form>


    <!--     <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', e => {
            e.preventDefault();
            const inputs = document.querySelectorAll('input[type="radio"]:checked');
            const idCurso = document.querySelector('input[name="idCurso"]').value;

            let data = [];

            inputs.forEach(input => {
                data = [...data, {
                    dni: input.name,
                    estado: input.value
                }];
            })

            const dataJSON = JSON.stringify(data);

            $.ajax({
                method: "post",
                async: false,
                url: "validarCondicion.php",
                data: {
                    idCurso: idCurso,
                    data: dataJSON
                },

            });
        })
    </script> -->

    <!-- <script src="../../features/validarCondicion.js"></script> -->
</body>

</html>