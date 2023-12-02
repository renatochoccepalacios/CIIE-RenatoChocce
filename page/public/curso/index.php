<?php


include_once '../../app/templates/header.php';
include_once __DIR__ . '/verifyCurso.php';


require_once MODELS_PATH . '/DAL/cursoDAL.php';

require_once MODELS_PATH . '/DAL/estadoDAL.php';
require_once MODELS_PATH . '/DAL/UsuarioDAL.php';
require_once MODELS_PATH . '/curso.php';
require_once MODELS_PATH . '/DAL/nivelDAL.php';
require_once MODELS_PATH . '/DAL/AreaDAL.php';
require_once MODELS_PATH . '/DAL/SedeDAL.php';
require_once MODELS_PATH . '/estado.php';
require_once MODELS_PATH . '/DAL/cronogramaDAL.php';

$cursoDAL = new CursoDAL();

$curso = $cursoDAL->getCursoPorId($idCurso);


$usuarioDAL = new UsuarioDAL();
$tipoCuenta = $usuarioDAL->getPerId($_SESSION['user'])->getTipoCuenta();

$estado = $cursoDAL->checkStart($idCurso) == 1 ? "Sin comenzar" : ($cursoDAL->checkEnd($idCurso) == 0 ? "Finalizado" : "En progreso");

$sedeDal = new SedeDAL();
$idSede = $sedeDal->getSedePorCurso($idCurso);
$sede = $sedeDal->getSedePorId($idSede);

$nivelDal = new NivelDAL();
$idNivel = $nivelDal->getIdNivel($idCurso);


$areaDal = new AreaDAL();
$idArea = $areaDal->getIdArea($idCurso);

$cronogramaDal = new CronogramaDAL();
$cronograma = $cronogramaDal->getCronogramaPorCurso($idCurso);

$etr = $usuarioDAL->getPerId($curso->getProfesor());

?>
<style>
    /* Estilos generales del cuerpo de la página */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
    }

    /* Contenedor principal del curso */
    .main {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        gap: 40px;
        margin: 0 20px;
    }

    /* Estilos para la primera fila (Volver a la lista de cursos) */
    .row-1 {
        margin-bottom: 20px;
    }

    /* Título del curso */
    .title-curso {
        font-size: 24px;
        margin: 0;
        color: #333;
    }

    /* Contenedor para la información del curso */
    .info {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        /* Cambiar la dirección del flujo a columna */
    }

    /* Estilos para descripción general */
    .row-2 {
        display: flex;
        justify-content: space-between;
    }

    h2 {
        font-size: 28px;
        margin-bottom: 10px;
        /* Añadir margen inferior para separar del elemento siguiente */
    }

    /* Imagen del curso */
    .course-image img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        margin-top: 15px;
        /* Añadir margen superior para separar de la descripción general */
    }

    /* Estado del curso */
    .course-status span {
        font-weight: bold;
    }

    /* Columnas de Profesor y Sede */
    .col {
        width: 48%;
    }

    /* Botón de */
    .acordion {
        cursor: pointer;
        user-select: none;
    }

    /* Botón de flecha en el acordeón */
    .btn-arrow {
        background: none;
        border: none;
        cursor: pointer;
        outline: none;
    }

    /* Contenido colapsado del acordeón */
    .collapse {
        display: none;
        margin-top: 10px;
    }

    /* Estilos para los elementos de fecha y detalles adicionales */
    .date {
        margin-bottom: 10px;
    }

    /* Rotación de la flecha al expandir el acordeón */
    .rotar {
        transform: rotate(180deg);
    }

    /* Estilos para los enlaces deshabilitados y completados */
    a.disabled,
    a.done {
        cursor: not-allowed;
        text-decoration: none;
        color: black;
        background: #fff;
        padding: 0;
        margin: 0 10px;
    }

    /* Estilos adicionales para enlaces deshabilitados cuando están activos */
    a.disabled:active {
        color: blue;
    }
    .imagen-contenedor {
        display: flex;
    }

    /* Estilos para enlaces completados */
    a.done {
        text-decoration: none;
        color: red;
    }
</style>


<input type="hidden" name="idCurso" value="<?= $idCurso; ?>">
<link rel="stylesheet" href="styleGestion.css">


<main id="curso" class="curso-admin">
    <div class="col-1 main">
        <div class="row-1" style="margin-bottom: 0; width: max-content;">
            <a href="../cursos/index.php">
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
                

                
                <div class="about">
                    <h2>Descripción general</h2>
                    <div class="course-status">
                        <span>
                            <?= " <strong>Estado del curso:</strong> $estado. " ?>
                        </span>
                    </div>
                    <div class="col">
                        <h3>Profesor</h3>
                        <span>
                            <?= $etr->getNombre() . ", " . $etr->getApellido() . "<br>" ?>
                        </span>
                    </div>
                    <div class="col">
                        <h3>Sede</h3>
                        <span>
                            <?php
                            echo $sede->getSede() . "<br>" . "Dirección: " . $sede->getDireccion() . " " . $sede->getAltura() . ", " . $sede->getLocalidad();
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
                    <i class="fa-solid fa-chevron-down fa-2xl"></i>
                </button>
            </h2>

            <div id="collapse" class="collapse" style="display: none;">
                <div class="col">
                    <h3>Vacantes disponibles</h3>
                    <span>
                        <?= $curso->getVacantes(); //CORREGIR, estamos mostrando las vacantes en gral NO las disponibles
                        ?>
                    </span>
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


        <style>
            a.disabled,
            a.done {
                cursor: not-allowed;
                text-decoration: none;
                color: black;
                background: #fff;
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