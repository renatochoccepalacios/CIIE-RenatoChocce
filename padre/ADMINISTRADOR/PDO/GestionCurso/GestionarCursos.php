<?php
require_once("../../../models/DAL/cursoDAL.php");
require_once("../../../models/curso.php");

    $cursoId = $_GET['idCurso'];    
    $cursoDAL = new CursoDAL();
    $curso = $cursoDAL->getCursoPorId($cursoId);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de cursos</title>
    <link rel="stylesheet" href="../css/styleGestion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>  
    <div class="main">
        <div class="back">
            <a href="../AbmCurso.php" class="a-back" >
                <i class="fa fa-arrow-left"></i>
            </a>  
        </div>
        <div class="div-name-curso">
            <h2 class="name-curso"><?php echo $curso->getNombreCurso($cursoId); ?></h2>
        </div>
        <div class="column">
            <div class="div-info">
                <h4 class="title-info">Dirección: </h4>
                <p class="p-info"><?php echo  $curso->getDireccion(); ?></p>

                <h4 class="title-info">Profesor: </h4>
                <p class="p-info">
                    <?php 
                        require_once( '../../../models/DAL/profesorDAL.php');
                        $idProf = $curso->getProfesor();
                        echo $profesorDAL->MostrarNombrePorId($idProf) 
                        //echo $curso->getProfesor(); 
                    ?>
                </p>

                <h4 class="title-info">Nivel: </h4>
                <p class="p-info">
                    <?php 
                        require_once("../../../models/DAL/nivelDAL.php");
                        $idNivel = $curso->getNivel();
                        echo $nivelDAL->MostrarNivelPorId($idNivel)
                        //echo $curso->getNivel(); 
                    ?>
                </p>

                <h4 class="title-info">Estado: </h4>
                <p class="p-info">
                    <?php 
                        require_once("../../../models/DAL/estadoDAL.php");
                        $idEstado = $curso->getEstado();
                        echo $estadoDAL->MostrarEstadoPorId($idEstado);
                        //echo $curso->getEstado(); 
                    ?>
                </p>

                <h4 class="title-info">Destinatario: </h4>
                <p class="p-info"><?php echo $curso->getDestinatarios();?></p>

                <h4 class="title-info">Fecha De Inicio: </h4>
                <p class="p-info"><?php echo $curso->getFechaInicio(); ?></p>

                <h4 class="title-info">Fecha De Fin: </h4>
                <p class="p-info"><?php echo $curso->getFechaFinal(); ?></p>

                <h4 class="title-info">Carga Horaria: </h4>
                <p class=""></p><?php echo $curso->getCargaHoraria(); ?></p>

  
                <h4 class="title-info">Resolucion: </h4>
                <p class=""></p><?php echo $curso->getResolucion(); ?></p>

                <h4 class="title-info">Dictamen: </h4>
                <p class=""></p><?php echo $curso->getDictamen(); ?></p>

                <h4 class="title-info">Nro Proyecto: </h4>
                <p class=""></p><?php echo $curso->getNroProyecto(); ?></p>

                <h4 class="title-info">Puntaje: </h4>
                <p class=""></p><?php echo $curso->getPuntaje(); ?></p>
            </div>
            
            <div class="btns">
                <button type="button" class="btn"><a href="#">Pasar Lista</a></button>
                <button type="button" class="btn"><a href="#">Cerrar Notas</a></button>
                <button type="button" class="btn"><a href="#">Emitir Certificados</a></button>
                <button type="button" class="btn"><a href="#">Exportar nominas de alumnos</a></button>
                <button type="button" class="btn-modificar"><a href="./modificacion cursos/editarCurso.php?idCurso=<?php echo $cursoId ?>">Modificar</a></button>
            </div>
        </div>
    </div>
</body>
</html>