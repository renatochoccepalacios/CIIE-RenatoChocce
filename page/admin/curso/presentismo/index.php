<?php

include '../../templates/header.php';
include_once __DIR__ . '/../verifyCurso.php';

// si el curso aun no empieza o si ya terminó
if ($cursoDAL->checkStart($idCurso) == 1) {
    getError('Cod52');
    header('Location: ../index.php?id=' . $idCurso);

} else {

    if ($cursoDAL->checkEnd($idCurso) == 0) {
        getError('Cod54');
        header('Location: ../index.php?id=' . $idCurso);
    }
}

// si ya se tomó lista hoy
if ($cursoDAL->checkAttendance($idCurso) == 1) {
    getError('Cod43');
    header('Location: ../index.php?id=' . $idCurso);
}

$nombreCurso = $cursoDAL->getCursoPorId($idCurso)->getNombreCurso();
$alumnos = $cursoDAL->getStudents($idCurso); ?>

<main id="attendance" class="curso-admin">
    <section class="row-1">
        <a href="../?id=<?= $idCurso ?>">
            <span class="material-symbols-outlined">
                arrow_back_ios_new
            </span>Volver</a>
        <h1>
            <?= "Curso de $nombreCurso" ?>
        </h1>
        <p>Asistencia</p>
    </section>

    <section class="row-2">
        <form action="validarPresentismo.php?id=<?= $idCurso ?>" method="post">
            <input name="idCurso" value="<?= $idCurso ?>" type="hidden">

            <div id="list">

                <?php
                if (count($alumnos) > 0) {
                    foreach ($alumnos as $alumno): ?>

                        <label>
                            <div class="student">
                                <div class="col-1">
                                    <?= $alumno->getNombre() . ", " . $alumno->getApellido() . " - " . $alumno->getDni() ?>
                                </div>

                                <div class="col-2">
                                    <input type="checkbox" name="alumnos[]" id="" value="<?= $alumno->getDni() ?>">
                                </div>
                            </div>
                        </label>

                    <?php endforeach;
                } else {
                    getError('Cod44'); ?>
                    <h2>No se encontraron alumnos para este curso.</h2>
                <?php } ?>
            </div>

            <?php if (count($alumnos) > 0) { ?>
                <button type="submit" name="action" value="register">Enviar</button>
            <?php } ?>
        </  >
    </section>
</main>

<style>
    #planilla {
        display: flex;
        flex-direction: column;
    }
</style>

<?php include_once '../../templates/footer.php';