<?php
include_once '../../app/templates/header.php';
require_once MODELS_PATH . '/DAL/cursoDAL.php';
require_once MODELS_PATH . '/DAL/estadoDAL.php';
require_once MODELS_PATH . '/DAL/UsuarioDAL.php';
require_once MODELS_PATH . '/curso.php';
require_once MODELS_PATH . '/DAL/nivelDAL.php';
require_once MODELS_PATH . '/DAL/AreaDAL.php';

/* require_once('../../app/models/DAL/cursoDAL.php');
require_once('../../app/models/DAL/estadoDAL.php');
require_once('../../app/models/DAL/UsuarioDAL.php');
require_once('../../app/models/curso.php');
require_once('../../app/models/DAL/nivelDAL.php'); */
$cursoDAL = new CursoDAL();
$cursos = $cursoDAL->getCursos();

$nivelDAL = new NivelDAL();
$estadoDAL = new EstadoDAL();
$areaDal = new AreaDAL();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a8aa7b0eff.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- RENATO -->
    <section class="card-container">
        <?php foreach ($cursos as $curso) { ?>
            <div class="card-item">
                <figure>
                    <?php $idCurso = $curso->getIdCurso();
                    $imagenCurso = $cursoDAL->mostrarImagenCurso($idCurso);
                    if ($imagenCurso) {
                        echo '<img src="' . $imagenCurso . '" alt="Imagen del curso">';
                    } else {
                        // imagen por defecto si no hay imagen del profesor
                        echo '<img src="imagenCurso/imagenpordefecto.jpg" alt="Imagen por defecto">';
                    }

                    ?>
                </figure>
                <div class="card-info">
                    <div class="card-info-item">
                        <span class="span-estado-<?php echo ($curso->getEstado()); ?>">
                            <?php
                            echo $estadoDAL->MostrarEstadoPorId($curso->getEstado())
                            ?>
                        </span>
                        </span>
                        <h4><?php echo $curso->getNombreCurso(); ?></h4>
                        <!-- <p class="card-des"><?php /* echo $curso->getDestinatarios(); */ ?></p> -->
                        <p class="card-stock"><i class="fa-solid fa-bolt"></i> Nivel: <?php $idCurso = $curso->getIdCurso();
                                                                                        $idNivel = $nivelDAL->getIdNivel($idCurso);
                                                                                        echo $nivelDAL->MostrarNivelPorId($idNivel); ?></p>

                        <p class="card-stock"><i class="fa-solid fa-star"></i> Area: <?php
                                                                                        $idArea = $areaDal->getIdArea($idCurso);
                                                                                        $areaDal->MostrarAreaPorId($idArea); ?>
                        </p>

                        <p class="card-stock"><i class="fa-solid fa-users"></i> Vacantes: <?php echo $curso->getVacantes(); ?> </p>
                        <!-- <p class="card-destinatarios"><?php /* echo $curso->getDestinatarios(); */?></p> -->
                    </div>
                    <div class="corazon">
                        <div class="corazon-item">
                            <i class="fa-solid fa-heart cora"></i>
                        </div>
                    </div>
                    <!-- <p class="card-precio">$ 149.999</p> -->
                </div>

                <input type="hidden" name="idCurso" value="<?php echo $idCurso; ?>">
                
                <div class="contenido">
                            <a type="submit" class="agregar-class-1" href="<?= ROOT_URL ?>/public/curso/?id=<?php echo $curso->getIdCurso(); ?>">
                                <button>Mas Informacion</button> 
                            </a>
                        </div>
    
            </div>
        <?php }  ?>
    </section>
    <script src="js/app.js"></script>
</body>

</html>