<?php

require_once('../app/models/DAL/nivelDAL.php');
require_once('../app/models/DAL/estadoDAL.php');
require_once('../app/models/DAL/sedeDAL.php');
require_once('../app/models/DAL/cursoDAL.php');
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
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a8aa7b0eff.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
</head>

<body>
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
                <a href="" class="header-arriba-iniciar-sesion">Iniciar sesión</a>
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
                <ul class="nav-menu">
                    <li>
                        <a href="">Inicio</a>
                    </li>
                    <li>
                        <a href="">Acerca de</a>
                    </li>
                    <li>
                        <a href="">Capacitaciones</a>
                    </li>
                    <li>
                        <a href="">Eventos</a>
                    </li>
                    <li>
                        <a href="">Blog</a>
                    </li>
                    <li>
                        <a href="">Contacto</a>
                    </li>
                </ul>
            </nav>
        </section>
    </header>

    <div class="container-carousel">
        <!-- <div class="error"> -->
        <div class="carruseles" id="slider">
            <script type="text/javascript">
                const carrusel = document.querySelector('#slider');
            </script>
            <?php

            foreach ($cursos as $curso) {

            ?>
                <script type="text/javascript">
                    carrusel.width += 100;
                </script>
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
                                <img src="img/profe.jpg" alt="">
                            </div>
                            <small><?php $DniProf = $curso->getProfesor();
                                    echo $UsuarioDAL->MostrarNombrePorDni($DniProf); ?></small>
                        </div>
                    </div>


                    <div class="contenedor-folleto">
                        <div class="titulo-folleto text1">
                            <p><?php echo $curso->getNombreCurso(); ?></p>
                        </div>
                        <div class="text1">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore voluptatibus, maxime quod nesciunt voluptatum soluta, cupiditate nulla non ex suscipit vitae saepe! Velit perferendis illo voluptate, distinctio neque pariatur eaque?</p>

                            <p>✔ Con una carga horaria de <?php
                                                            echo $curso->getCargaHoraria(); ?></p>
                            <p>✔ Vacanates: <?php echo $curso->getVacantes(); ?></p>
                            <p>✔ Modalidad: Presencial</p>
                            <p>✔ Estado: <?php $idEstado = $curso->getEstado();
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
                        <p><?php echo $curso->getDestinatarios(); ?></p>
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