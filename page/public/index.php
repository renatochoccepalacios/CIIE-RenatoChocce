<?php

require_once('../app/models/DAL/nivelDAL.php');
require_once('../app/models/DAL/estadoDAL.php');
require_once('../app/models/DAL/sedeDAL.php');
require_once('../app/models/DAL/cursoDAL.php');

require_once('../app/models/DAL/UsuarioDAL.php');
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
    <title>C.I.I.E. Escobar</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a8aa7b0eff.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
</head>

<body>


    <!-- RENATO -->
     <header class="header">
        <section class="header-arriba">
            <div class="header-arriba-contenedor">
                <div class="header-arriba-contacto">
                    <span class="telefono">
                        <i class="fa-solid fa-phone"></i>
                        <a href="">(11) 2887-3057</a>
                    </span>
                    <span class="email">
                        <i class="fa-solid fa-envelope"></i>
                        <a href="">ciieescobar@gmail.com</a>
                    </span>
                </div>
                <a href="login/index.php" class="header-arriba-iniciar-sesion">Iniciar sesión</a>
            </div>
        </section>
        <section class="header-abajo">
            <div class="header-logo">
                <a href="">
                    <img src="https://ciieescobar.edu.ar/UI/img/main-logo.png" alt="">
                    CIIE Escobar
                </a>
            </div>
            <nav class="nav-menu-header">
                <button class="nav-toggle" aria-label="Abrir menú">
                <i class="fas fa-bars"></i>
                </button>
                <ul class="nav-menu">

                    <li>
                        <a href=""><i class="fa-solid fa-house"></i> Inicio</a>
                    </li>
                    <li>
                        <a href="cursos/index.php"><i class="fa-solid fa-book"></i> Cursos</a>
                    </li>

                    <li>
                        <a href=""><i class="fa-solid fa-graduation-cap"></i> Capacitaciones</a>
                    </li>
                    <li>
                        <a href=""><i class="fa-solid fa-bolt"></i> Eventos</a>
                    </li>

                    <li>
                        <a href=""><i class="fa-solid fa-user"></i> Contacto</a>
                    </li>
                    <li>
                        <a href=""><i class="fa-solid fa-mug-saucer"></i> Acerca de</a>
                    </li>

                </ul>
            </nav>
        </section>
    </header> 

    <div class="container-carousel">
        <!-- <div class="error"> -->
        <div class="carruseles" id="slider">
            <?php
            foreach ($cursos as $curso) { ?>

                <section class="slider-section">
                    <div class="nivel">
                        <p><?php
                            $idCurso = $curso->getIdCurso();

                            $idNivel = $nivelDAL->getIdNivel($idCurso);
                            echo $nivelDAL->MostrarNivelPorId($idNivel);

                            ?></p>
                    </div>
                    <div class="dos-img">
                        <div class="sello">
                            <img src="img/ciiescobar.png" alt="">
                        </div>

                        <div class="profesor">
                            <div class="profesor-img">
                                <?php
                                $DniProf = $curso->getProfesor();
                                $imagenProfesor = $profersorDAL->mostrarImagenEtr($DniProf);
                                if ($imagenProfesor) {
                                    echo '<img src="' . $imagenProfesor . '" alt="Imagen del Profesor">';
                                } else {
                                    // imagen por defecto si no hay imagen del profesor
                                    echo '<img src="img/perfil.jpg" alt="Imagen por defecto">';
                                }
                                ?>
                            </div>
                            <small><?php $DniProf = $curso->getProfesor();
                                    echo $UsuarioDAL->MostrarNombrePorDni($DniProf) . " ";
                                    echo  $UsuarioDAL->MostrarApellidoPorDni($DniProf);
                                    ?>
                            </small>
                        </div>
                    </div>


                    <div class="contenedor-folleto">
                        <div class="titulo-folleto text1">
                            <p><?php echo $curso->getNombreCurso(); ?></p>
                        </div>
                        <div class="text1">
                            <p>✔ Con una carga horaria de <?php
                                                            echo $curso->getCargaHoraria(); ?></p>
                            <p>✔ Vacantes: <?php echo $curso->getVacantes(); ?></p>
                            <p>✔ Modalidad: Presencial</p>
                            <p><?php $idEstado = $curso->getEstado();
                                echo ($idEstado == 1) ? '✔' : (($idEstado == 2) ? '❌' : $estadoDAL->MostrarEstadoPorId($idEstado));
                                ?> Estado: <?php
                                            echo $estadoDAL->MostrarEstadoPorId($idEstado) ?></p>
                        </div>
                        <div class="cronograma">
                            <h4>CRONOGRAMA 📝</h4>
                            <small>Fecha Inicio <?php echo $curso->getFechaInicio() ?></small>
                            <small>Fecha final <?php echo $curso->getFechaFinal() ?></small>
                            <small>todos los Martes</small>
                        </div>
                    </div>
                    <!-- <div class="contenedor-relative">
                        <p>Angela Hahn</p>
                    </div> -->
                    <div class="folleto-destinatarios">
                        <p>Destinatarios: <?php echo $curso->getDestinatarios(); ?></p>
                    </div>
                    <div class="pie-folleto">
                        <p>Sede <?php
                                $idCurso = $curso->getIdCurso(); // obtenemos el id del curso

                                $idSede = $sedeDAL->getSedePorCurso($idCurso);
                                echo $sedeDAL->MostrarSedePorId($idSede);
                                ?></p>
                        <img src="img/logo_ministerio.svg" alt="">
                    </div>

                </section>

            <?php } ?>
        </div>

        <!-- </div> -->

        <div class="btn-left"><i class="fa-solid fa-arrow-left"></i></div>
        <div class="btn-right"><i class="fa-solid fa-arrow-right"></i></div>




    </div>

    <!-- <section class="curso-off">
        <h4>Este curso no esta disponible de momento</h4>
        <small>Curso no esta disponible de momento bla bla bla bla</small>
    </section> -->
    <script src="js/app.js"></script>


    <footer class="footer">
        <div class="footer-container">
            <div class="fila-footer">
                <div class="footer-colum">
                    <div class="footer-contenido">
                        <h2>¿Qué es el CIIE?</h2>
                        <p style="text-align: justify;">El área de coordinación de CIIE es la responsable de los Centros de Capacitación, Información e Investigación Educativa (CIIE). La misma tiene como objetivos
                            Favorecer el funcionamiento de los CIIE como referentes de la formación docente continua a nivel distrital y regional,
                            Profundizar la institucionalización de los agentes involucrados en brindar las acciones de formación continua, a través de la regulación normativa y
                            Asesorar, Capacitar y Supervisar a los responsables de los CIIE.
                        </p>
                        <hr>

                        <div class="footer-links">
                            <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                            <a href=""><i class="fa-brands fa-twitter"></i></a>
                            <a href=""><i class="fa-brands fa-youtube"></i></a>

                        </div>
                    </div>
                </div>
                <div class="footer-colum">
                    <div class="colum-izq">
                        <h3>Enlaces Utiles</h3>
                        <ul>Inicio</ul>
                        <ul>Capacitaciones</ul>
                        <ul>Eventos</ul>
                        <ul>Blog</ul>
                    </div>
                    <div class="colum-derec">
                        <h3>Contacto</h3>
                        <ul>
                            <li><i class="fa-solid fa-location-dot"></i> Independencia 406, Belén de Escobar</li>
                            <li><i class="fa-solid fa-envelope"></i> ciieescobar@gmail.com</li>
                            <li><i class="fa-solid fa-phone"></i> (11) 2887-3057</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-abajo">
            <p>© 2020 - C.I.I.E. Escobar</p>
        </div>
    </footer>



</body>

</html>