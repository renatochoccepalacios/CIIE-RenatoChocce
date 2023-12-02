<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Mostrar el curso</title>
<link rel='stylesheet' href='styles/styles.css'>
</head>

<?php 
include_once '../../templates/header.php';
require_once 'intermediomodi.php';
require_once("../../../app/models/DAL/CronogramaDAL.php");


?>


<body>
   <!--Inclusión de la biblioteca Font Awesome para íconos -->
<script src="https://kit.fontawesome.com/cfa51a9d6b.js" crossorigin="anonymous"></script>  

        
        <form name='form1' action="intermediomodi.php" method="post">

      <!--Botón de retroceso a la página principal -->
        <div class="back">
            <a href="../../index.php" class="a-back" >
                <i class="fa fa-arrow-left"></i>
            </a>  
        </div>

        <div id='left-column'>
          
        <h1>Editar Curso</h1>
      <!--Campo oculto para almacenar el ID del curso -->
            <input type="hidden" name="idCurso" value="<?= $idCurso; ?>">
            
       <!--Campos de entrada para editar información del curso -->
            <label for="nombreCurso">Nuevo Nombre:</label>
            <input type="text" name="nombreCurso" value="<?= $curso->getNombreCurso(); ?>"><br>
            
            <label for='descripcion'>Nueva Descripcion:</label>
            <input type='text' name='descripcion' id='descripcion' value="<?= $curso->getDescripcion(); ?>"><br>

            <label for='imagen'>Nueva Imagen del curso</label>
            <input type='text' name='imagen' id='imagen' value="<?= $curso->getImagen(); ?>"><br>
           
            <label for='idSede'>Nueva Sede:</label>
            <input type='text' name='idSede' id='sede' list='lista-sedes' value="<?= $sede->getIdSede($idCurso); ?>">

          <!--Utilizamos un datalist para desplegar los datos ya cargados en la base--> 
          
            <datalist id='lista-sedes'>
            <?php require_once("../../../app/models/DAL/SedeDAL.php");
            $sedeDAL->cargarSede();
            ?>
            </datalist>
            
            <label for="destinatarios">Nuevos Destinatarios:</label>
            <input type="text" name="destinatarios" value="<?= $curso->getDestinatarios(); ?>"><br>

            <label for="profesor">Nuevo Profesor:</label>
            <input type="text" name="profesor" list='lista-profesores' value="<?= $curso->getProfesor(); ?>"><br>
            <datalist id='lista-profesores'>
            <?php require_once("../../../app/models/DAL/UsuarioDAL.php");
            $UsuarioDAL = new UsuarioDAL;
            $UsuarioDAL->mostrarProfesores();
            ?>
           </datalist>

            <label for="idNivel">Nuevo Nivel:</label>
            <input type="text" name="idNivel" id="nivel" list="lista-niveles" value="<?= $nivel->getIdNivel($idCurso); ?>"><br>
            <datalist id="lista-niveles">
            <?php require_once("../../../app/models/DAL/nivelDAL.php");
            $nivelDAL->cargarNivel();
            ?>
            </datalist>

            <label for='idArea'>Nueva Area:</label>
            <input type='text' name='idArea' id='area' list='lista-area' value="<?= $area->getIdArea($idCurso); ?>" >
            <datalist id='lista-area'>
            <?php require_once("../../../app/models/DAL/areaDAL.php");
            $areaDAL->cargarArea();
            ?>
            </datalist>


            <label for="estado">Nuevo Estado:</label>
            <input type="text" name="estado" list="lista-estados" value="<?= $curso->getEstado(); ?>"><br>
            <datalist id="lista-estados">
            <?php require_once("../../../app/models/DAL/estadoDAL.php");
            $estadoDAL->cargarEstado();
            ?>
            </datalist>

            <label for="resolucion">Nueva Resolución:</label>
            <input type="text" name="resolucion" value="<?= $curso->getResolucion(); ?>"><br>

            <label for="dictamen">Nuevo Dictamen:</label>
            <input type="text" name="dictamen" value="<?= $curso->getDictamen(); ?>"><br>

            <label for="nroProyecto">Nuevo Nro. de Proyecto:</label>
            <input type="text" name="nroProyecto" value="<?= $curso->getNroProyecto(); ?>"><br>

            <label for="puntaje">Nuevo Puntaje:</label>
            <input type="text" name="puntaje" value="<?= $curso->getPuntaje(); ?>"><br>

            <label for="cargaHoraria">Nueva Carga Horaria:</label>
            <input type="text" name="cargaHoraria" value="<?= $curso->getCargaHoraria(); ?>"><br>

            <label for="vacantes">Nuevas Vacantes:</label>
            <input type="text" name="vacantes" value="<?= $curso->getVacantes(); ?>"><br>

        </div>
        
    <div id='right-column'>
      <h1>Cronograma</h1>


      <label for="fechaInicio">Nueva Fecha de Inicio:</label>
      <input type="date" id="fechaInicio" name="fechaInicio" class="fechaInicio" value="<?= $curso->getFechaInicio(); ?>"><br>

      <label for="fechaFinal">Nueva Fecha Final:</label>
      <input type="date" id="fechaFinal" name="fechaFinal" class="fechaFinal" value="<?= $curso->getFechaFinal(); ?>"><br>


      <div id="contenido">
        <div id="cronograma">
         
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
          <label for="horario">Horario:</label>
          <input type="time" id="horario" name="horario[]" class="horario">
          <label for="presencialidad">Presencialidad:</label>
          <select id="presencialidad" name="presencialidad[]" class="presencialidad">
            <option value="Presencial">Presencial</option>
            <option value="Virtual">Virtual</option>
          </select>
          <label for="fecha">fecha:</label>
          <input type="date" id="fecha" name="fecha[]" class="fecha">

          <button type="button" id="agregar-cronograma">Agregar Cronograma</button>
          <!-- Fin de los elementos del cronograma -->
          <h2>Mis Días</h2>
          <div id="lista-eventos"></div>
        </div>
        
        <div class="tabla">
    <h3 style="text-align: center;">Dias Registrados</h3>
    <table class="tabla" style="border-spacing: 0;">
        <tr>
            <th>Día: </th>
            <th>Horario: </th>
            <th>Modalidad: </th>
            <th>Fecha: </th>
            <th>Eliminar</th>
        </tr>
    <tbody>
      <?php
      $cronogramaDAL = new CronogramaDAL();
      $cronograma = $cronogramaDAL->getCronogramaPorCurso($idCurso);
      foreach ($cronograma as $row) {
      ?>
        <tr> 
          <td class="datos"><?php echo $row['dia']; ?></td>
          <td class="datos"><?php echo $row['horario']; ?></td>
          <td class="datos"><?php echo $row['presencialidad']; ?></td>
          <td class="datos"><?php echo $row['fecha']; ?></td>
          <td class="datos">
            <button type="button">X</button>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>

    </table>

        </div>
      </div>
            <input type="submit" name="guardar" id="guardar" value="Guardar Cambios">
    </div>
           
        </form>

  <script src='script/dias.js'></script>
  <script src='script/script.js'></script>
  
</body>
</html>



