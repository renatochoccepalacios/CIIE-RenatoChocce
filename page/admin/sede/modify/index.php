<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>Creación de sedes</title>
  <link rel='stylesheet' href='styles/styles.css'>
</head>
<?php include_once '../../templates/header.php';?>

<body>

<?php
require_once("../../../app/models/DAL/sedeDAL.php");
require_once("../../../app/models/DAL/CursoDAL.php");
require_once MODELS_PATH . '/curso.php';
$idSede = $_GET['id'];
$sedeDAL = new sedeDAL;
 $sede = $sedeDAL->getsedePorId($idSede);
$cursoDAL = new CursoDAL();
 

?>


<script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>  


  <form id='form1' name='form1' method='post' action='modifySede.php'>
  <div class="back">
            <a href="../../index.php" class="a-back" >
                <i class="fa fa-arrow-left"></i>
            </a>  
        </div>
        <h1>Modificar Sede</h1>

      <div id='left-column'>
        <input type="hidden" name="id" value="<?= $idSede; ?>">
        <label for='nombreSede'>Nombre de la Sede</label>
        <input type='text' name='nombreSede' id='nombreSede' value="<?= $sede->getSede(); ?>">

        <label for='direccion'>Direccion</label>
        <input type='text' name='direccion' id='direccion' value="<?= $sede->getDireccion(); ?>">




      </div>

      <div id='right-column'>
      <label for='altura'>Altura</label>
        <input type='text' name='altura' id='altura' value="<?= $sede->getAltura(); ?>">

        <label for='localidad'>Localidad</label>
        <input type='text' name='localidad' id='localidad' value="<?= $sede->getLocalidad(); ?>">
      </div>
      <input type='submit' name='submit-sede' id='submit-sede' value='Modificar'>

  </form>
<!--   <form name='form2' id='form2'>
    <h2>Cursos con esta Sede</h2>
  <table class="tabla-resultados">
    <tr>
      <th>CURSO</th>
      <th>MODIFICAR</th>
      </tr>
      <?php foreach ( ($cursos = $cursoDAL->getCursoPorId($idCurso = $sedeDAL->getIdCursoPorsede($idsede))) as $curso) { 

        ?>

      <tr>
      <td id="td-curso">
        <?php 
        echo $curso->getNombreCurso();
        ?>
      </td>
        </tr>
        <?php }?>
  </table>
    </form> -->
</body>

</html>