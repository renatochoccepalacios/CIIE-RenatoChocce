<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='stylesAdmin.css'>

    <title>CIIE ADMIN</title>
</head>
<body>
    
<?php

require_once 'templates/header.php';

require_once MODELS_PATH . "\DAL\UsuarioDAL.php";
require_once MODELS_PATH . "\DAL\CursoDAL.php";
require_once MODELS_PATH . "\DAL\NivelDAL.php";
require_once MODELS_PATH . "\DAL\AreaDAL.php";
require_once MODELS_PATH . "\DAL\SedeDAL.php";



$cursoDAL = new CursoDAL();
$usuarioDAL = new UsuarioDAL();
$nivelDAL = new NivelDAL();
$areaDAL = new AreaDAL();
$sedeDAL = new SedeDAL();



$dni = $_SESSION['user'];
$nombreUsuario = ucfirst($usuarioDAL->getPerId($dni)->getNombre()); 
?>

<main>
    <section class="row-1">
        <h1>
            <?= "Te damos la bienvenida, $nombreUsuario." ?>
        </h1>
    </section>

    <!-- deberia ser el header -->
<!--     <section class="row-2">
        <a href="../public/">sitio principal</a>
        <a href="curso/create">crear curso</a>
        <a href="cursos/">lista de cursos</a>

        <a href="../public/login/logout.php">cerrar sesion</a>
    </section> -->


<div class="card-container">
    <div class="card-curso">
      <div class="card-body curso">
        <div class="card-header curso">CURSOS</div>
        <h5 class="card-title curso">Cursos actuales: <?php  $totalCursos = $cursoDAL->contarCursos(); echo $totalCursos;    ?></h5>
        <p class="card-text">Los cursos educativos son experiencias de aprendizaje dirigidas a personas que quieren adquirir conocimientos, profundizar su aprendizaje en una materia, etc</p>
        <div class="card-links curso">
          <a href="curso/" class="card-link curso">Administrar</a>
          <a href="curso/create/" class="card-link curso">Crear Curso</a>
        </div>
      </div>
    </div>

    <div class="card-sede">
      <div class="card-body sede">
        <div class="card-header sede">SEDES</div>
        <h5 class="card-title sede">Sedes actuales: <?php  $totalSedes = $sedeDAL->contarSedes(); echo $totalSedes;    ?></h5>
        <p class="card-text">Es la localización donde funciona una sección o grupo de secciones que depende pedagógica y administrativamente de una sede ubicada en otro lugar geográfico.</p>
        <div class="card-links sede">
          <a href="sedes/" class="card-link sede">Administrar</a>
          <a href="sede/create/" class="card-link sede">Crear Sede</a>
        </div>
      </div>
    </div>
    <div class="card-niveles">

      <div class="card-body niv">
        <div class="card-header niv">NIVELES</div>
        
        <h5 class="card-title niv">Niveles actuales: <?php  $totalNiv = $nivelDAL->contarNiveles(); echo $totalNiv;    ?></h5>
        <p class="card-text">Los Niveles son tramos del sistema educativo que acreditan y certifican el proceso educativo organizado en función de las características psicosociales del sujeto</p>
        <div class="card-links niv">
          <a href="niveles/" class="card-link niv">Administrar</a>
          <a href="nivel/create/" class="card-link niv">Crear Nivel</a>
        </div>
      </div>
    </div>
    <div class="card-areas">
      <div class="card-body area">
        <div class="card-header area">AREAS</div>
        <h5 class="card-title area">Areas actuales: <?php  $totalAreas = $areaDAL->contarAreas(); echo $totalAreas;    ?></h5>
        <p class="card-text">Las áreas son organizadores del currículo que, al momento de realizar su programación, toman en cuenta las características particulares de los y las estudiantes.</p>
        <div class="card-links area">
          <a href="areas/" class="card-link niv">Administrar</a>

          <a href="area/create/" class="card-link niv">Crear Area</a>
        </div>
      </div>
    </div>
    
  </div>

</main>





<?php include_once 'templates/footer.php';?>


</body>
</html>
