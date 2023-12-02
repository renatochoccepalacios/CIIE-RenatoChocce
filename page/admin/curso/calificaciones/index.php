<?php

include '../../templates/header.php';
include_once __DIR__ . '/../verifyCurso.php';

require_once MODELS_PATH . '/DAL/UsuarioDAL.php';

// si el curso aún no termina no se pueden poner notas
if ($cursoDAL->checkEnd($idCurso) == 1) {
    getError('Cod42');
    header("Location: ../../curso/?id=$idCurso");
}

$usuarioDAL = new UsuarioDAL();
$tipoCuenta = $usuarioDAL->getPerId($_SESSION['user'])->getTipoCuenta();

// si las notas ya estan cerradas y quiere entrar el etr, tiene que hacerlo volver
if ($tipoCuenta != 'Admin' && $cursoDAL->checkGrades($idCurso)) {
    getError('Cod41');
    header("Location: ../../curso/?id=$idCurso");
}

$curso = $cursoDAL->getCursoPorId($idCurso);
$alumnos = $cursoDAL->getStudents($idCurso);
?>

<main id="calificaciones" class="curso-admin">
    <section class="row-1">
        <a href="../?id=<?= $idCurso ?>">
            <span class="material-symbols-outlined">
                arrow_back_ios_new
            </span>
            Volver</a>
        <h1>
            <?= 'Curso de ' . $curso->getNombreCurso() ?>
        </h1>
        <p>Calificaciones</p>
    </section>

    <section class="row-2">
        <!-- realizar la correspondiente paginacion -->
        <form action="validarCalificacion.php?id=<?= $idCurso ?>" method="post">
            <input name="idCurso" value="<?= $idCurso ?>" type="hidden">

            <div id="list">

                <?php
                if (count($alumnos) > 0) {
                    foreach ($alumnos as $alumno) {
                        $calificacion = $cursoDAL->getGrades($alumno->getDni(), $idCurso); ?>

                        <div class="student">
                            <div class="col-1">
                                <?= $alumno->getNombre() . ", " . $alumno->getApellido() . " - " . $alumno->getDni() ?>
                            </div>

                            <div class="col-2">
                                <label>
                                    <input type="radio" name="<?= $alumno->getDni() ?>" value="Aprobado" <?= isset($calificacion) && $calificacion == 'Aprobado' ? 'checked' : null ?>>
                                    Aprobado
                                </label>

                                <label>
                                    <input type="radio" name="<?= $alumno->getDni() ?>" value="Desaprobado"
                                        <?= isset($calificacion) && $calificacion == 'Desaprobado' ? 'checked' : null ?>>
                                    Desaprobado
                                </label>

                                <label>
                                    <input type="radio" name="<?= $alumno->getDni() ?>" value="Ausente" <?= isset($calificacion) && $calificacion == 'Ausente' ? 'checked' : null ?>>
                                    Ausente
                                </label>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    getError('Cod49'); ?>
                    <h2 class="warning">No se encontraron alumnos registrados en este curso.</h2>
                <?php } ?>
            </div>

            <button class="button button-submit" type="submit" name="accion" value="enviar">Enviar</button>
        </form>
    </section>
</main>

<?php include '../../templates/footer.php';