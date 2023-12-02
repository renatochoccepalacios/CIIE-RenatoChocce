<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>Creación de niveles</title>
  <link rel='stylesheet' href='styles/styles.css'>
</head>
<?php include_once '../../templates/header.php';?>

<body>

<?php
require_once("../../../app/models/DAL/nivelDAL.php");
require_once("../../../app/models/DAL/CursoDAL.php");
require_once MODELS_PATH . '/curso.php';
$idNivel = $_GET['id'];
$nivelDAL = new nivelDAL;
$nivel = $nivelDAL->getnivelPorId($idNivel);
$cursoDAL = new CursoDAL();



?>


<script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>  


  <form id='form1' name='form1' method='post' action='modifyNivel.php'>
  <div class="back">
            <a href="../../index.php" class="a-back" >
                <i class="fa fa-arrow-left"></i>
            </a>  
        </div>
      <div id='left-column'>
        <h1>Modificar Nivel</h1>
        <input type="hidden" name="id" value="<?= $idNivel; ?>">
        <label for='nombreNivel'>Nombre del nivel</label>
        <input type='text' name='nombreNivel' id='nombreNivel' value="<?= $nivel->getNivel(); ?>">
      </div>

      <div id='right-column'>
        <input type='submit' name='submit-nivel' id='submit-nivel' value='Enviar'>
      </div>

  </form>
  <form name='form2' id='form2'>
    <h2>Cursos con este Nivel</h2>
  <table class="tabla-resultados">
    <tr>
      <th>CURSO</th>
      <th>MODIFICAR</th>
      </tr>
      <?php foreach ( ($cursos = $cursoDAL->getCursoPorId($idCurso = $nivelDAL->getIdCursoPorNivel($idNivel))) as $curso) { 

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
    </form>
</body>

</html>