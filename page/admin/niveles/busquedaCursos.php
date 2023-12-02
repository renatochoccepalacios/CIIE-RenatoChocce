<?php
include_once '../templates/header.php';

require_once MODELS_PATH . '/DAL/cursoDAL.php';
require_once MODELS_PATH . '/DAL/estadoDAL.php';
require_once MODELS_PATH . '/DAL/UsuarioDAL.php';
require_once MODELS_PATH . '/curso.php';
require_once MODELS_PATH . '/main.php';
require_once MODELS_PATH . '/DAL/nivelDAL.php';


$cursoDAL = new CursoDAL();
$cursos = $cursoDAL->getCursos();
$nivelDAL = new NivelDAL();
$estadoDAL = new EstadoDAL();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a8aa7b0eff.js" crossorigin="anonymous"></script>
    <script src="app.js"></script>

</head>

<body>

    <div class="buscador-cursos">

        <form action="busquedaCursos.php" class="buscador-form">

            <div class="buscador-title">
                <h3>CIIE</h3>
                <h2><a href="AbmCurso.php" style="text-decoration: none; color:#fff">CRUD</a></h2>

            </div>
            <div class="buscador-input">
                <input type="search" name="query" placeholder="Ingresa un curso" autocomplete="off" list="lista-cursos">
                <!-- <datalist id="lista-cursos">
                    <?php
                    // require_once('CursoDAL.php');
                    // $cursoDAL->cargarCurso();
                    ?>
                </datalist> -->
                <input type="submit" value="Buscar" name="BuscarCurso" class="buscar-input">

            </div>
        </form>


        <div class="busqueda-resultados">
            <table class="tabla-resultados">

                <?php





                // instanciamos
                // $cursoDAL = new CursoDAL();
                // Verifica si se ha enviado un término de búsqueda desde el formulario
                if (isset($_GET["query"])) {
                    // obtenemos el query
                    $query = $_GET["query"];

                    // llamamos a la funcion buscar curso para buscar cursos
                    $cursosEncontrados = $cursoDAL->BuscarCurso($query);

                    // Verifica si se encontraron cursos
                    if (!empty($cursosEncontrados)) {
                ?>
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
                        <?php

                        // iteramos atravez de los cursos
                        foreach ($cursosEncontrados as $curso) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $curso->getNombreCurso(); ?>
                                </td>
                                <td>
                                    <?php echo $curso->getDireccion(); ?>
                                </td>
                                <td>
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

                                <td>
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
    <?php }
                        }
                    } else {
                        echo "No se encontraron cursos que coincidan con la búsqueda.";
                    }
                } else {
                    echo "Ingresa un término de búsqueda en el formulario.";
                } ?>
                </div>
                <?php  ?>

        </div>





    </div>
    <script>
        function confirmarBorrar(idCurso) {
            swal({
                    title: "¿Estas seguro que quieres borrar este curso?",
                    text: "Una vez eliminado, no podrás recuperar este curso.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Si se confirma la eliminación redirecciona a una página PHP para eliminar de la base de datos.
                        window.location.href = "eliminarCurso.php?id=" + idCurso;
                    } else {
                        swal("No borraste el curso :)", {
                            icon: "info",
                        });
                    }
                });
        }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>