<?php

include_once '../templates/header.php';

require_once MODELS_PATH . '/DAL/cursoDAL.php';
require_once MODELS_PATH . '/DAL/estadoDAL.php';
require_once MODELS_PATH . '/DAL/UsuarioDAL.php';
require_once MODELS_PATH . '/curso.php';
require_once MODELS_PATH . '/DAL/nivelDAL.php';
require_once MODELS_PATH . '/DAL/SedeDAL.php';

/* $cursoDAL = new CursoDAL();
$cursos = $cursoDAL->getCursos(); */
$cursoDAL = new CursoDAL();
$cursos = $cursoDAL->getCursos();
$profersorDAL = new UsuarioDAL();
$nivelDAL = new NivelDAL();
$estadoDAL = new EstadoDAL();
$sedeDAL = new SedeDAL();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIIE | CRUD</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/a8aa7b0eff.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="app.js?<?php echo time(); ?>"></script>
</head>

<body>
    <!-- RENATO -->
    <div class="buscador-cursos">

        <form action="busquedaCursos.php" class="buscador-form">
            <div class="buscador-input">
                <input type="search" class="buscador" name="query" placeholder="Ingresa un curso" autocomplete="off" list="lista-cursos">
                <!-- <datalist id="lista-cursos">
                    <?php
                    // $cursoDAL->cargarCurso();
                    ?>
                </datalist> -->
                <input type="submit" value="Buscar" name="BuscarCurso" class="buscar-input">
            </div>
            <!-- <div class="buscador-title">
                <h3>CIIE</h3>
                <h2>
                    <a href="AbmCurso.php" style="text-decoration: none; color:#fff">CRUD</a>
                </h2>
            </div> -->
            <div class="filtrar-busqueda">
                <label for="sede" style="color: #fff;">Sede</label>
                <select class="filtrar-item" class="filtrar" name="sede" id="sede">
                    <option value="">Todos</option>
                    <?php $sedeDAL->cargarSede(); ?>
                </select>
                <label for="profesor" style="color: #fff;">Profesor</label>
                <select class="filtrar-item" name="profesor" id="profesor">
                    <option value="">Todos</option>
                    <?php $profersorDAL->mostrarProfesores(); ?>
                </select>
                <label for="nivel" style="color: #fff;">Nivel</label>
                <select class="filtrar-item" name="nivel" id="nivel">
                    <option value="">Todos</option>
                    <?php $nivelDAL->cargarNivel(); ?>
                </select>
                <label for="estado" style="color: #fff;">Estado</label>
                <select class="filtrar-item" name="estado" id="estado">
                    <option value="">Todos</option>
                    <?php $estadoDAL->cargarEstado(); ?>
                </select>
                <!-- <button class="button-filtrar">Filtrar Curso</button> -->
            </div>

        </form>



        <div class="busqueda-resultados">
            <table class="tabla-resultados" id="tabla-cursos">
                <thead>
                    <tr>

                        <th>Id</th>
                        <th>Nombre Curso</th>
                        <th>Sede</th>
                        <th>Profesor</th>
                        <th>Nivel</th>
                        <th>Estado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Final</th>
                        <th>Carga Horaria</th>
                        <th>Cambiar estado</th>
                        <th>Gestionar</th>

                    </tr>
                </thead>
                <!-- cuerpo de la tabla -->
                <tbody>
                    <?php foreach ($cursos as $curso) { ?>
                        <tr>
                            <td width="40">
                                <?php echo $curso->getIdCurso(); ?>
                            </td>
                            <td>
                                <?php echo $curso->getNombreCurso(); ?>
                            </td>
                            <td>
                                <?php

                                $idCurso = $curso->getIdCurso(); // obtenemos el id del curso

                                $idSede = $sedeDAL->getSedePorCurso($idCurso);
                                echo $sedeDAL->MostrarSedePorId($idSede);
                                ?>
                            </td>

                            <td>
                                <?php $DniProf = $curso->getProfesor();
                                echo $UsuarioDAL->MostrarNombrePorDni($DniProf) ?>
                            </td>

                            <td>
                                <?php
                                /* $idNivel = $curso->getNivel();
                            echo $nivelDAL->getIdNivel($idNivel); */


                                $idCurso = $curso->getIdCurso();

                                $idNivel = $nivelDAL->getIdNivel($idCurso);
                                echo $nivelDAL->MostrarNivelPorId($idNivel);
                                ?>
                            </td>

                            <td width="160">
                                <span id="span-estado-<?php echo $curso->getIdCurso() ?>">

                                    <?php
                                    $idEstado = $curso->getEstado();
                                    $claseEstado = $idEstado == 1
                                        ? 'on'
                                        : 'off';
                                    echo $estadoDAL->MostrarEstadoPorId($idEstado) ?></span>
                            </td>

                            <td>
                                <?php echo $curso->getFechaInicio(); ?>
                            </td>

                            <td>
                                <?php echo $curso->getFechaFinal(); ?>
                            </td>
                            <td>
                                <?php echo
                                $curso->getCargaHoraria(); ?>

                            </td>
                            <td>
                                <button type="submit" class="cambiar-estado" estado="<?php echo $idEstado ?>" onclick="ActualizarEstado(this,<?php echo $curso->getIdCurso() ?>)">
                                    <i class="fa-solid fa-toggle-<?php echo $claseEstado ?>"></i>
                                </button>
                            </td>


                            <td>
                                <a type="submit" class="editar-buttom" href="<?= ROOT_URL ?>/admin/curso/?id=<?php echo $curso->getIdCurso(); ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="busqueda-resultados-mobile">
            <?php foreach ($cursos as $curso) { ?>

                <div class="fila">
                    <div class="columna">
                        <div class="titulo">Nombre Curso</div>
                        <div class="contenido">
                            <?php echo $curso->getNombreCurso(); ?>
                        </div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Direccion</div>
                        <div class="contenido">
                            <?php echo $curso->getDireccion(); ?>
                        </div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Id</div>
                        <div class="contenido">
                            <?php echo $curso->getIdCurso(); ?>
                        </div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Profesor</div>
                        <div class="contenido">
                            <?php $DniProf = $curso->getProfesor();
                            echo $UsuarioDAL->MostrarNombrePorDni($DniProf) ?>
                        </div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Nivel</div>
                        <div class="contenido">
                            <?php $idCurso = $curso->getIdCurso();

                            $idNivel = $nivelDAL->getIdNivel($idCurso);
                            echo $nivelDAL->MostrarNivelPorId($idNivel); ?>
                        </div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Estado</div>
                        <div class="contenido">
                            <span id="span-estado-<?php echo $curso->getIdCurso() ?>">

                                <?php
                                $idEstado = $curso->getEstado();
                                $claseEstado = $idEstado == 1
                                    ? 'on'
                                    : 'off';
                                echo $estadoDAL->MostrarEstadoPorId($idEstado) ?></span>
                        </div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Destinatarios</div>
                        <div class="contenido">
                            <?php echo $curso->getDestinatarios(); ?>
                        </div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Cambiar estado</div>
                        <div class="contenido">
                            <button type="submit" class="cambiar-estado" estado="<?php echo $idEstado ?>" onclick="ActualizarEstado(this,<?php echo $curso->getIdCurso() ?>)">
                                <i class="fa-solid fa-toggle-<?php echo $claseEstado ?>"></i>
                            </button>
                        </div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Gestionar</div>
                        <div class="contenido">
                            <a type="submit" class="editar-buttom" href="<?= ROOT_URL ?>/admin/curso/?id=<?php echo $curso->getIdCurso(); ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>