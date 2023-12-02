<?php
require_once('../../models/DAL/cursoDAL.php');
require_once('../../models/curso.php');





/* $cursoDAL = new CursoDAL();
$cursos = $cursoDAL->getCursos(); */
$cursoDAL = new CursoDAL();
$cursos = $cursoDAL->getCursos();


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

                <div class="filtrar-opciones">
                    <select name="Direccion">
                        <option value="">
                            Direccion
                        </option>
                    </select>
                    <select name="Profesor">
                        <option>Profesor</option>
                        <option value="">

                            <?php
                            require_once('../../models/DAL/profesorDAL.php');

                            $profesorDAL->cargarProfesor();
                            ?>
                        </option>
                    </select>
                    <select name="Nivel">
                        <option>Nivel</option>
                        <option value="">
                            <?php
                            require_once('../../models/DAL/nivelDAL.php');

                            $nivelDAL->cargarNivel();
                            ?>
                        </option>
                    </select>
                    <select name="Estado">
                        <option>Estado</option>
                        <option>
                            <?php
                            require_once('../../models/DAL/estadoDAL.php');

                            $estadoDAL->cargarEstado();
                            ?></option>
                    </select>
                </div>
                <button class="button-filtrar">Filtrar Curso</button>


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
                        <td><?php echo $curso->getNombreCurso(); ?></td>
                        <td><?php echo $curso->getDireccion(); ?></td>
                        <td><?php echo $curso->getIdCurso(); ?></td>
                        <td><?php $idProf = $curso->getProfesor();
                            echo $profesorDAL->MostrarNombrePorId($idProf) ?></td>
                        <td><?php $idNivel = $curso->getNivel();
                            echo $nivelDAL->MostrarNivelPorId($idNivel) ?></td>
                        <td>
                            <span id="span-estado-<?php echo $curso->getIdCurso() ?>">
                                <?php
                                $idEstado = $curso->getEstado();
                                $claseEstado = $idEstado == 1
                                    ? 'on'
                                    : 'off';
                                echo $estadoDAL->MostrarEstadoPorId($idEstado); ?></span>
                        </td>
                        <td><?php echo $curso->getDestinatarios(); ?></td>
                        <td>
                            <!-- <a type="submit" class="borrar-buttom" onclick="confirmarBorrar(<?php /* echo $curso->getIdCurso(); */ ?>)">
                                <i class="fa-solid fa-x"></i>
                            </a> -->

                            <button type="submit" class="cambiar-estado" estado="<?php echo $idEstado ?>" onclick="ActualizarEstado(this,<?php echo $curso->getIdCurso() ?>)">
                                <i class="fa-solid fa-toggle-<?php echo $claseEstado ?>"></i>
                            </button>
                        </td>
                        <td>
                            <a type="submit" class="editar-buttom" href="GestionCurso/GestionarCursos.php?idCurso=<?php echo $curso->getIdCurso(); ?>">
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
                        <div class="contenido"><?php echo $curso->getNombreCurso(); ?></div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Direccion</div>
                        <div class="contenido"><?php echo $curso->getDireccion(); ?></div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Id</div>
                        <div class="contenido"><?php echo $curso->getIdCurso(); ?></div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Profesor</div>
                        <div class="contenido"><?php echo $curso->getProfesor(); ?></div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Nivel</div>
                        <div class="contenido"><?php echo $curso->getNivel(); ?></div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Estado</div>
                        <div class="contenido"><?php echo $curso->getEstado(); ?></div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Destinatarios</div>
                        <div class="contenido"><?php echo $curso->getDestinatarios(); ?></div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Borrar</div>
                        <div class="contenido">
                            <a type="submit" class="borrar-boton" onclick="confirmarBorrar(<?php echo $curso->getIdCurso(); ?>)">
                                <i class="fa-solid fa-x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="columna">
                        <div class="titulo">Editar</div>
                        <div class="contenido">
                            <a type="submit" class="editar-boton" onclick="confirmarBorrar(<?php echo $curso->getIdCurso(); ?>)">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </div>
                    </div>

                </div>
            <?php } ?>

        </div>
    </div>
    <script src="js/app.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>