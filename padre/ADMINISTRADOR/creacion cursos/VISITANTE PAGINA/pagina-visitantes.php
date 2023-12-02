<?php
require_once('./FUNCIONANDO/AbstractMapper.php');
require_once('./FUNCIONANDO/cronogramaDAL.php');
require_once('./FUNCIONANDO/cursoDALL.php');
require_once('./FUNCIONANDO/estadoDAL.php');
require_once('./FUNCIONANDO/intermedio.php');
require_once('./FUNCIONANDO/nivelDAL.php');
require_once('./FUNCIONANDO/profesorDAL.php');


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
    <!-- llamar a la coleccion  -->
    <?php require("cargarDatos.php"); ?>
    <div class="container-carousel">
        <!-- <div class="error"> -->
        <div class="carruseles" id="slider">
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
                    <p><?php echo $nivel; ?></p>
                </div>

                <div class="contenedor-folleto">
                    <div class="titulo-folleto text1">
                        <p>Desarrollo Web Full Stack</p>
                    </div>
                    <div class="text1">
                        <p>✔ Dirección de formación docente permanente</p>

                    </div>

                    <div class="text1">
                        <p>✔ Formacion Docente, gratuita, de calidad y con puntaje</p>
                    </div>


                    <!-- <div class="contenedor-relative">
                        <p>FORMADORA: <br>Angela Hahn</p>
                    </div> -->

                    <div class="cronograma">
                        <h4>CRONOGRAMA</h4>
                        <small><?php echo $cronograma; ?></small>
                    </div>
                </div>
                <div class="contenedor-relative">
                    <p><?php echo $profesor; ?></p>
                </div>
                <div class="folleto-destinatarios">
                    <p>Destinatarios: <?php echo $destinatario; ?></p>
                </div>
                <div class="pie-folleto">
                    <p>SEDE DE CURSADA: EP NRO 1 PELLEGRINI 351 Belen de Escobar</p>
                    <img src="img/logo_ministerio.svg" alt="">
                </div>
            </section>
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