<?php

// incluyo directorios
include_once __DIR__ . '/../templates/header.php';
include_once __DIR__ . '/verifyCurso.php';

require_once MODELS_PATH . '/DAL/UsuarioDAL.php';
require_once MODELS_PATH . '/DAL/SedeDAL.php';
require_once MODELS_PATH . '/DAL/nivelDAL.php';
require_once MODELS_PATH . '/DAL/AreaDAL.php';
require_once MODELS_PATH . '/DAL/cronogramaDAL.php';


$curso = $cursoDAL->getCursoPorId($idCurso);


$usuarioDAL = new UsuarioDAL();
$tipoCuenta = $usuarioDAL->getPerId($_SESSION['user'])->getTipoCuenta();

$estado = $cursoDAL->checkStart($idCurso) == 1 ? "Sin comenzar" :
($cursoDAL->checkEnd($idCurso) == 0 ? "Finalizado" : "En progreso");

$sedeDal = new SedeDAL();
$idSede = $sedeDal->getSedePorCurso($idCurso);
$sede = $sedeDal->getSedePorId($idSede);
$nivelDal = new NivelDAL();
$idNivel = $nivelDal->getIdNivel($idCurso);

$cronogramaDal = new CronogramaDAL();
$cronograma = $cronogramaDal->getCronogramaPorCurso($idCurso);

$areaDal = new AreaDAL();
$idArea = $areaDal->getIdArea($idCurso);

$etr = $usuarioDAL->getPerId($curso->getProfesor());
?>
<link rel="stylesheet" href="styleGestion.css">


<main id="curso" class="curso-admin">
    <div class="col-1 main">
        <div class="row-1" style="margin-bottom: 0; width: max-content;">
            <a href="../cursos/">
                <span class="material-symbols-outlined" style="padding:5px; background: #fff; border-radius: 5px">
                    arrow_back_ios_new
                </span>
                Volver a la lista de cursos
            </a>
        </div>
        <section class="info"> 
            <h1 class="title-curso">
                <?= 'Curso de ' . $curso->getNombreCurso() ?>
            </h1>
        </section>
        <section class="info">    
            <div class="row-2">
                <!-- vista previa del curso -->
                <h2 style="margin-bottom: 15px;">Descripción general</h2>
                
                <!--Estado, profesor, sede-->
                <div class="about">
                    <div class="course-status">
                        <span>
                            <?= " <strong>Estado del curso:</strong> $estado. "?>
                        </span>
                    </div>
                    <div class="col">
                        <h3>Profesor</h3>
                        <span>
                            <?= $etr->getNombre() . ", " . $etr->getApellido() . "<br>"?>
                        </span>
                        <span>
                            <?= "DNI: " . $etr->getDni() ?>
                        </span>
                    </div>
                    <div class="col">
                        <h3>Sede</h3>
                        <span>
                            <?php 
                                echo $sede->getSede() . "<br>" . "Dirección: ". $sede->getDireccion() . " " . $sede->getAltura() . ", " . $sede->getLocalidad();
                            ?> 
                        </span>     
                    </div>
                </div>
            </div>
        </section>
        <section class="info">   
            <!-- Date -->  
            
            <h2 class="acordion">Más info
            <button class="btn-arrow" id="rotar" type="button" onclick="toggleDiv()">
                <i class="fa-solid fa-chevron-down fa-2xl" ></i>
            </button>
            </h2>
            
           <div id="collapse" class="collapse" style="display: none;">
                <div class="col">
                    <h3>Vacantes disponibles</h3>
                    <span>
                        <?= $curso->getVacantes(); //CORREGIR, estamos mostrando las vacantes en gral NO las disponibles?> 
                    </span>
                </div>
                <div class="col">
                    <h3>Alumnos inscritos</h3>
                    <span>Nadie se inscribió</span>
                </div>
                <div class="contenedor">
                    <div class="date">
                        <h4>Carga horaria</h4>
                        <span style="font-size: 18px">
                            <?= $curso->getCargaHoraria(); ?>
                        </span>
                    </div>
                <!-- Fecha inicio y fin -->
                    <div class="date ">
                        <h4>Fecha de inicio</h4>
                        <span>
                            <?= date_format(new DateTime($curso->getFechaInicio()), 'd/m/Y') ?>
                        </span>
                    </div>
                    <div class="date" id="fecha">
                        <h4>Fecha de fin</h4>
                        <span>
                            <?= date_format(new DateTime($curso->getFechaFinal()), 'd/m/Y') ?>
                        </span>
                    </div>
                    <div class="date" style="margin-left: 10px"></div>
                </div>
                <div class="contenedor">
                    <div class="date">
                        <h4>Nivel</h4>
                        <span>
                            <?= $nivelDal->MostrarNivelPorId($idNivel); ?>
                        </span>
                    </div>

                    <div class="date">
                        <h4>Área</h4>
                        <span>
                            <?= $areaDal->MostrarAreaPorId($idArea); ?>
                        </span>
                    </div>
                    <div class="date">
                        <h4>Resolución</h4>
                        <span>
                            <?= $curso->getResolucion(); ?>
                        </span>
                    </div>
        
                    <div class="date">
                        <h4>Dictámen</h4>
                        <span>
                            <?= $curso->getDictamen(); ?>
                        </span>
                    </div>
                </div>

                <div class="col">
                    <h3>Descripcion</h3>
                    <span><?= $curso->getDescripcion(); ?></span>
                </div>
                <div class="col">
                    <h3>Destinatarios</h3>
                    <span><?= $curso->getDestinatarios(); ?></span>
                </div>
            </div>
        </section>
        
        <!-- Cronograma -->
        <h2 class="subtitle">Cronograma</h2>
        <div class="tabla">
            <table style="border-spacing: 0;">
                <tr>
                    <th>Día</th>
                    <th>Horario</th>
                    <th>Modalidad</th>
                    <th>Fecha</th>
                </tr>
                <?php foreach($cronograma as $row) {?>    
                <tbody>
                <tr>
                    <td class="datos"><?php echo $row['dia'];?></td>
                    <td class="datos"><?php echo $row['horario'];?></td>
                    <td class="datos"><?php echo $row['presencialidad'];?></td>
                    <td class="datos"><?php echo $row['fecha'];?></td>
                    <?php } ?>
                </tr> 
                </tbody> 
            </table>
        </div>
    </div>
    
   <div class="div-fijo">
        <div class=" btns">
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

            <input type="hidden" name="idCurso" value="<?php echo $idCurso; ?>">
            <a class="button" href="update/index.php?idCurso=<?= $idCurso ?>" style="margin-top: 190px;">Editar curso</a>

        </div>
   </div>

    
    <style>
        a.disabled,
        a.done {
            cursor: not-allowed;
            text-decoration: none;
            color: black;
            background:#fff;
            padding: 0;
            margin: 0 10px;
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
    <script>
        function toggleDiv() {
            let collapse = document.getElementById('collapse');
            if (collapse.style.display === 'none') {
                collapse.style.display = 'block';
                up();
            } else {
                collapse.style.display = 'none';
                down();
            }

            function up() {
                let rotar = document.getElementById('rotar');
                rotar.classList.add('rotar');
            }
            function down() {
                let rotar = document.getElementById('rotar');
                rotar.classList.remove('rotar');
            }
        }
</script>
    <script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>

</main>
<?php

include_once __DIR__ . '/../templates/footer.php';