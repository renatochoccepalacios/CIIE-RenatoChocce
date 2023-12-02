<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>Formulario creación de cursos</title>
  <link rel='stylesheet' href='styles/styles.css'>
</head>

<body>
  <form name='form1' method='post' action='intermedio.php'>
    <div id='left-column'>
      <h1>Registro de cursos</h1>
      <label for='nombre_curso'>Nombre del curso</label>
      <input type='text' name='nombre_curso' id='nombre_curso'>
      <label for='direccion'>Dirección</label>
      <input type='text' name='direccion' id='direccion'>
      <label for='destinatarios'>Destinatarios</label>
      <input type='text' name='destinatarios' id='destinatarios'>

      <label for='estado'>Estado</label>
      <select name='estado' id='estado'>
        <?php require_once("../../../padre/models/DAL/estadoDAL.php");
        $estadoDAL->cargarEstado();
        ?>
      </select>

      <label for='nivel'>Nivel</label>
      <input type='select' name='nivel' id='nivel' list='lista-niveles'>
      <datalist id='lista-niveles'>
        <?php require_once("../../../padre/models/DAL/nivelDAL.php");
        $nivelDAL->cargarNivel();
        ?>
      </datalist>
      <label for='profesor'>Profesor:</label>
      <input type='search' name='profesor' id='profesor' list='lista-profesores'>
      <datalist id='lista-profesores'>
        <?php require_once("../../../padre/models/DAL/profesorDAL.php");
        $profesorDAL->cargarProfesor();
        ?>
      </datalist>

      <label for='resolucion'>Resolucion</label>
      <input type='text' name='resolucion' id='resolucion'>

      <label for='dictamen'>Dictamen</label>
      <input type='text' name='dictamen' id='dictamen'>

      <label for='nroProyecto'>Nro. del Proyecto</label>
      <input type='text' name='nroProyecto' id='nroProyecto'>

      <label for='puntaje'>Puntaje</label>
      <input type='number' name='puntaje' id='puntaje'>

      <label for='cargaHoraria'>Carga Horaria</label>
      <input type='text' name='cargaHoraria' id='cargaHoraria'>


    </div>

    <div id='right-column'>
      <h1>Cronograma</h1>

      <label for="fechaInicio">Fecha Inicio</label>
      <input type="date" id="fechaInicio" name="fechaInicio" class="fechaInicio">

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