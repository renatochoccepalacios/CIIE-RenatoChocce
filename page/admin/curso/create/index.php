<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>Formulario creación de cursos</title>
  <link rel='stylesheet' href='styles/styles.css'>
</head>
<?php include_once '../../templates/header.php';?>

<body>


<script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>  


  <form name='form1' method='post' action='intermedio.php'>
  <div class="back">
            <a href="../../index.php" class="a-back" >
                <i class="fa fa-arrow-left"></i>
            </a>  
        </div>
    <div id='left-column'>
      <h1>Registro de cursos</h1>
      <label for='nombreCurso'>Nombre del curso</label>
      <input type='text' name='nombreCurso' id='nombreCurso' required>

      <label for='descripcion'>Descripcion del curso</label>
      <input type='text' name='descripcion' id='descripcion' required>

      <label for='imagen'>Imagen del curso</label>
      <input type='text' name='imagen' id='imagen' required>

      <label for='sede'>Sede</label>
      <input type='select' name='sede' id='sede' list='lista-sedes' required>
      <datalist id='lista-sedes'>
        <?php require_once("../../../app/models/DAL/SedeDAL.php");
        $sedeDAL->cargarSede();
        ?>
      </datalist>
      
      <label for='destinatarios'>Destinatarios</label>
      <input type='text' name='destinatarios' id='destinatarios' required>

      <label for='estados'>Estado</label>
      <input type='select' name='estados' id='estados' list='lista-estados' required>
      <datalist id='lista-estados'>
        <?php require_once("../../../app/models/DAL/estadoDAL.php");
        $estadoDAL->cargarEstado();
        ?>
      </datalist>

      <label for='nivel'>Nivel</label>
      <input type='select' name='nivel' id='nivel' list='lista-niveles' required>
      <datalist id='lista-niveles'>
        <?php require_once("../../../app/models/DAL/nivelDAL.php");
        $nivelDAL->cargarNivel();
        ?>
      </datalist>

      <label for='area'>Area</label>
      <input type='select' name='area' id='area' list='lista-area' required>
      <datalist id='lista-area'>
        <?php require_once("../../../app/models/DAL/areaDAL.php");
        $areaDAL->cargarArea();
        ?>
      </datalist>

      <label for='profesor'>Profesor:</label>
      <input type='search' name='profesor' id='profesor' list='lista-profesores' required>
      <datalist id='lista-profesores'>
        <?php require_once("../../../app/models/DAL/UsuarioDAL.php");
        $UsuarioDAL = new UsuarioDAL;
        $UsuarioDAL->mostrarProfesores();
        ?>
      </datalist>

      <label for='resolucion'>Resolucion</label>
      <input type='text' name='resolucion' id='resolucion' required>

      <label for='dictamen'>Dictamen</label>
      <input type='text' name='dictamen' id='dictamen' required>

      <label for='nroProyecto'>Nro. del Proyecto</label>
      <input type='text' name='nroProyecto' id='nroProyecto' required>

      <label for='puntaje'>Puntaje</label>
      <input type='number' name='puntaje' id='puntaje' required>

      <label for='vacantes'>Vacantes</label>
      <input type='number' name='vacantes' id='vacantes' required>

      <label for='cargaHoraria'>Carga Horaria</label>
      <input type='text' name='cargaHoraria' id='cargaHoraria' required>


    </div>

    <div id='right-column'>
      <h1>Cronograma</h1>

      <label for="fechaInicio">Fecha Inicio</label>
      <input type="date" id="fechaInicio" name="fechaInicio" class="fechaInicio" >

      <label for="fechaFinal">Fecha Final</label>
      <input type="date" id="fechaFinal" name="fechaFinal" class="fechaFinal">


      <div id="contenido">
        <div id="cronograma">
          <!-- Elimina el formulario interno aquí -->
          <label for="dia">Dia:</label>
          <select id="dia" name="dia[]" class="dia">
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miércoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sábado">Sábado</option>
            <option value="Domingo">Domingo</option>
          </select>
          <label for="horario">Horario</label>
          <input type="time" id="horario" name="horario[]" class="horario">
          <label for="presencialidad">Presencialidad</label>
          <select id="presencialidad" name="presencialidad[]" class="presencialidad">
            <option value="Presencial">Presencial</option>
            <option value="Virtual">Virtual</option>

          </select>
          <label for="fecha">fecha</label>
          <input type="date" id="fecha" name="fecha[]" class="fecha">
          <button type="button" id="agregar-cronograma">Agregar Cronograma</button>
          <!-- Fin de los elementos del cronograma -->
          <h2>Mis Días</h2>
          <div id="lista-eventos"></div>
        </div>
      </div>
      <input type='submit' name='submit-curso' id='submit-curso' value='Enviar'>
      <!--       <button type="button" id="submit-curso" onclick="enviarFormulario()">Enviar</button>-->
    </div>
  </form>
  <script src='script/dias.js'></script>

</body>

</html>