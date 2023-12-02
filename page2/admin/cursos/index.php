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
    <script src="app.js"></script>
</head>

<body>

    <div class="buscador-cursos">

        <form action="busquedaCursos.php" class="buscador-form">

            <div class="buscador-title">
                <h3>CIIE</h3>
                <h2>
                    <a href="AbmCurso.php" style="text-decoration: none; color:#fff">CRUD</a>
                </h2>
            </div>
            <div class="filtrar-busqueda">

                    <select class="filtrar-item" class="filtrar" name="Sede">
                        <option>Sede</option>
                        <option value="">
                            <?php $sedeDAL->cargarSede();?>
                        </option>
                    </select>
                    <select class="filtrar-item" name="Profesor">
                        <option>Profesor</option>
                        <option value="">
                            <?php $profersorDAL->mostrarProfesores();?>
                        </option>
                    </select>
                    <select class="filtrar-item" name="Nivel">
                        <option>Nivel</option>
                        <option value="">
                            <?php $nivelDAL->cargarNivel();?>
                        </option>
                    </select>
                    <select class="filtrar-item" name="Estado">
                        <option>Estado</option>
                        <option>
                            <?php $estadoDAL->cargarEstado();?>
                        </option>
                    </select>
                <!-- <button class="button-filtrar">Filtrar Curso</button> -->
            </div>
            <div class="buscador-input">
                <input type="search" name="query" placeholder="Ingresa un curso" autocomplete="off" list="lista-cursos">
                <input type="submit" value="Buscar" name="BuscarCurso" class="buscar-input">
            </div>
        </form>



        <div class="busqueda-resultados">
            <table class="tabla-resultados">
                <tr>

                    <th>Nombre Curso</th>
                    <th>Direccion</th>
                    <th>Id</th>
                    <th>Profesor</th>
                    <th>Nivel</th>
                    <th>Estado</th>
                    <th>Destinatarios</th>
                    <th>Cambiar estado</th>
                    <th>Gestionar</th>
                </tr>
                <?php foreach ($cursos as $curso) { ?>
                    <tr>
                        <td>
                            <?php echo $curso->getNombreCurso(); ?>
                        </td>
                        <td>
                            <?php 
                            
                            // echo $curso->getDireccion();
                            // echo $curso->getSede();
                             ?>
                        </td>
                        <td width="40">
                            <?php echo $curso->getIdCurso(); ?>
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

                        <td width="200">
                            <span id="span-estado-<?php echo $curso->getIdCurso() ?>">

                                <?php
                                $idEstado = $curso->getEstado();
                                $claseEstado = $idEstado == 1
                                    ? 'on'
                                    : 'off';
                                echo $estadoDAL->MostrarEstadoPorId($idEstado) ?></span>
                        </td>

                        <td>
                            <?php echo $curso->getDestinatarios(); ?>
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>