<?php

include '../../app/templates/header.php';

// incluyo directorios
require_once(MODELS_PATH . "\DAL/nivelDAL.php");
require_once(MODELS_PATH . "\DAL\AreaDAL.php");
require_once(MODELS_PATH . "\DAL\cursoDAL.php");

$cursoDAL = new CursoDAL();
$cursos = [];
// $cursos = $cursoDAL->getCursosVigentes();
?>

<h1>cursos</h1>

<style>
    div#cursos {
        display: flex;
        flex-direction: column;
    }

    div#cursos>* {
        margin-bottom: 10px;
    }
</style>

<div id="cursos">

    <?php

    if (count($cursos) == 0) {
        ?>
        <h2>No hay cursos disponibles.</h2>
        <?php
    } else {
        foreach ($cursos as $curso):
            ?>

            <?php

            if ($magia->vacantesCurso($curso->idCurso) > 0) {
                ?>
                <a href="../curso/?id=<?= $curso->idCurso ?>">
                    curso de
                    <?= $curso->nombre ?>
                </a>
                <?php
            } else {
                ?>
                <a href="javascript:void(0)" style="color: black; text-decoration: none;">
                    curso de
                    <?= $curso->nombre ?> - SIN VACANTES
                </a>
                <?php
            }

            ?>

            <!-- validar si el curso tiene o no vacantes disponibles -->
            <!-- <p>SIN VACANTES</p> -->


            <?php
        endforeach;
    }


    ?>
</div>

<?php include APP_PATH . '/templates/footer.php';