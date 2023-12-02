<?php

include_once '../templates/header.php';

require_once MODELS_PATH . '/DAL/cursoDAL.php';
require_once MODELS_PATH . '/DAL/estadoDAL.php';
require_once MODELS_PATH . '/DAL/UsuarioDAL.php';
require_once MODELS_PATH . '/curso.php';
require_once MODELS_PATH . '/DAL/nivelDAL.php';
require_once MODELS_PATH . '/DAL/SedeDAL.php';


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

    <div class="container-carousel">
        <!-- <div class="error"> -->
        <div class="carruseles" id="slider">
            <?php foreach ($cursos as $curso) { ?>

                <section class="slider-section">
                    <div class="dos-img">
                        <div class="sello">
                            <img src="img/ciiescobar.png" alt="">
                        </div>

                        <div class="profesor-img">
                            <img src="img/profe.jpg" alt="">
                        </div>
                    </div>
                    <div class="nivel">
                        <p><?php $idNivel = $curso->getNivel();
                            echo $nivelDAL->MostrarNivelPorId($idNivel) ?></p>
                    </div>

                    <div class="contenedor-folleto">
                        <div class="titulo-folleto text1">
                            <p><?php echo $curso->getNombreCurso(); ?></p>
                        </div>
                        <div class="text1">
                            <p>✔ Direccion de formacion Docente Permanente</p>
                        </div>
                        <div class="text1">
                            <p>✔ Formacion Docente, gratuita, de calidad y con puntaje</p>
                        </div>
                        <div class="cronograma">
                            <h4>CRONOGRAMA</h4>
                            <small>Fecha de Inicio <?php echo $curso->getFechaInicio()?></small>
                            <br>
                            <small>Fecha Final <?php echo $curso->getFechaInicio()?></small>
                        </div>
                    </div>
                    <div class="contenedor-relative">
                        <p><?php $idProf = $curso->getProfesor();
                            echo $profesorDAL->MostrarNombrePorId($idProf) ?></p>
                    </div>
                    <div class="folleto-destinatarios">
                        <p>Destinatarios: <?php echo $curso->getDestinatarios(); ?></p>
                    </div>
                    <div class="pie-folleto">
                        <p>SEDE DE CURSADA: <?php echo $curso->getDireccion(); ?></p>
                        <img src="img/logo_ministerio.svg" alt="">
                    </div>

                </section>
            <?php } ?>

            <section class="slider-section">
                <!-- <img src="img/prueba2.jpg"> -->
            </section>
            <section class="slider-section">
                <!-- <img src="img/prueba3.jpg"> -->
            </section>
            <section class="slider-section">
                <!-- <img src="img/prueba4.jpg"> -->
            </section>
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


</body>

</html>