<?php

// include '../../templates/header.php';
// include_once __DIR__ . '/../modules/verifyCurso.php';

// require_once(MODELS_PATH . "\Magia.php");

require_once $_SERVER['DOCUMENT_ROOT'] . '/SuperCIIE/page/dirs.php';
require_once MODELS_PATH . '/DAL/cursoDAL.php'; // curso a mayuscula


$idCurso = $_GET['id'];

$cursoDAL = new CursoDAL();

if ($cursoDAL->checkStart($idCurso) == 1) {
    header('Location: ../index.php?id=' . $idCurso);

    exit();
} else {
    if ($cursoDAL->checkEnd($idCurso) == 0) {
        header('Location: ../index.php?id=' . $idCurso);

        exit();
    }
}



if ($cursoDAL->checkAttendance($idCurso) == 1) {
    header('Location: ../index.php?id=' . $idCurso);
    exit();
}

?>

<a href="../?id=<?= $idCurso ?>">volver</a>

<h1>Lista de alumnos</h1>
<form action="validarPresentismo.php" method="post">

    <div id="planilla">

        <input name="idCurso" value="<?= $idCurso ?>" type="hidden">

        <?php
        $alumnos = $cursoDAL->getStudents($idCurso);

        if (count($alumnos) > 0) {
            foreach ($alumnos as $alumno) {
                ?>
                
                <label>
                    <?= $alumno->getNombre() ?>
                    <input type="checkbox" name="alumnos[]" id="" value="<?= $alumno->getDni() ?>">
                </label>
                
                <?php
            }
        } else {
            ?>
            <h2>NO HAY ALUMNOS EN ESTE CURSO</h2>
            <?php
        }
        ?>

    </div>

    <?php

    if (count($alumnos) > 0) {
        ?>
        <button type="submit" name="accion">Enviar</button>
        <?php
    }
    ?>
</form>

<style>
    #planilla {
        display: flex;
        flex-direction: column;
    }
</style>

</body>

</html>