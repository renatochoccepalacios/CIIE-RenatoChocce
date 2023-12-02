<?php

// incluyo directorios
include_once '../admin/templates/header.php';
include_once 'verifyCurso.php';

require_once MODELS_PATH . '/DAL/UsuarioDAL.php';

$curso = $cursoDAL->getCursoPorId($idCurso);

$usuarioDAL = new UsuarioDAL();
$tipoCuenta = $usuarioDAL->getPerId($_SESSION['user'])->getTipoCuenta();

$estado = $cursoDAL->checkStart($idCurso) == 1 ? "Sin comenzar" :
    ($cursoDAL->checkEnd($idCurso) == 0 ? "Finalizado" : "En progreso");

$etr = $usuarioDAL->getPerId($curso->getProfesor());
?>

<main id="curso" class="curso-admin">

    <section class="col-1">

        <div class="row-1">
            <a href="../cursos/">
                <span class="material-symbols-outlined">
                    arrow_back_ios_new
                </span>
                Volver a la lista de cursos</a>
            <h1>
                <?= 'Curso de ' . $curso->getNombreCurso() ?>
            </h1>

            <div class="course-status">
                <span>
                    <?= "Estado del curso: $estado." ?>
                </span>
            </div>
        </div>

        <div class="row-2">
            <!-- vista previa del curso -->
            <h2>Vista previa</h2>

            <!-- profesor, fecha inicio, fecha final -->
            <div class="about">
                <div class="col">
                    <h4>Profesor</h4>
                    <span>
                        <?= $etr->getNombre() . ", " . $etr->getApellido() ?>
                    </span>
                    <span>
                        <?= "DNI: " . $etr->getDni() ?>
                    </span>
                </div>

                <div class="col">
                    <h1>Vacantes disponibles</h1>
                </div>

                <div class="col">
                    <h4>Alumnos inscritos</h4>
                   
                </div>

                <div class="col">
                    <h4>Fecha de inicio</h4>
                    <span>
                        <?= date_format(new DateTime($curso->getFechaInicio()), 'd/m/Y') ?>
                    </span>
                </div>

                <div class="col">
                    <h4>Fecha de fin</h4>
                    <span>
                        <?= date_format(new DateTime($curso->getFechaFinal()), 'd/m/Y') ?>
                    </span>
                </div>
            </div>
        </div>

    </section>

    <section class="col-2">
        <!-- clase DISABLED para las acciones que NO se pueden realizar -->
        <!-- clase DONE para las acciones que ya se realizaron -->
        <!-- clase BUTTON para todos los enlaces que son botones -->

        <!-- presentismo -->
        <!-- validar que sea un dia que se pueda tomar lista -->
        <?php $attendance = $cursoDAL->checkAttendance($idCurso) == 1; ?>
        <a class="button <?= $estado == 'Finalizado' ? 'disabled' : ($attendance ? 'done' : null) ?>"
            href="presentismo/?id=<?= $idCurso ?>">
            <?= $estado == 'Finalizado' ? 'Ya no se puede tomar lista'
                : ($attendance ? 'Ya se registró el presentismo de hoy' : 'Registrar presentismo') ?>
        </a>

        <a id="nomina" class="button" href="nomina/?id=<?= $idCurso ?>">Exportar nómina</a>

        <!-- cierre de notas -->
        <?php
        $class = "button";
        $text = "";

        if ($cursoDAL->checkEnd($idCurso) == 0) {
            // si el curso terminó, hay que ver si no es que ya se cerraron las notas
            if ($cursoDAL->checkGrades($idCurso)) {
                // si se cerraron las notas, a menos que sea admin, no podra editar nada
                if ($tipoCuenta == 'Admin') {
                    $text = 'Cerrar notas';

                } else {
                    $text = 'Las notas ya fueron cerradas';
                    $class .= ' done';
                }
            } else {
                $text = 'Cerrar notas';
            }
        } else {
            $text = 'Aún no se pueden cerrar las notas';
            $class .= ' disabled';
        }
        ?>

        <a class="<?= $class ?>" href="calificaciones/index.php?id=<?= $idCurso ?>">
            <?= $text ?>
        </a>

        <!-- certificados -->
        <a class="button <?= $estado != 'Finalizado' ? 'disabled' : null ?>"
            href="certificados/index.php?id=<?= $idCurso ?>">
            <?= $estado != 'Finalizado' ? 'Aún no se pueden emitir certificados' : 'Emitir certificados' ?>
        </a>

        <a class="button" href="update/index.php?id=<?= $idCurso ?>">Editar curso</a>
    </section>

    <style>
        a.disabled,
        a.done {
            cursor: not-allowed;
            text-decoration: none;
            color: green;
        }

        a.disabled:active {
            color: blue;
        }

        a.done {
            text-decoration: none;
            color: red
        }
    </style>

    <script>
        const disabled = document.querySelectorAll('.disabled');
        const done = document.querySelectorAll('.done');

        disabled.forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();

                alert('detenido')
            })
        })

        done.forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();

                alert('detenido')
            })
        })
    </script>

</main>
<?php

include_once __DIR__ . '/../templates/footer.php';