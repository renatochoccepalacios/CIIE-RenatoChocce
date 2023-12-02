<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Mostrar el curso</title>
<link rel='stylesheet' href='styles/styles.css'>
</head>
<body>

<?php
require_once("../../../app/models/DAL/CursoDAL.php"); 
require_once("../../../app/models/curso.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
    $idCurso = $_POST["idCurso"];
    $cursoDAL = new CursoDAL();
    
    if (is_object($cursoDAL->getCursoPorId($idCurso))) {
        $nombreCurso = $_POST["nombreCurso"];
        $direccion = $_POST["direccion"];
        $destinatarios = $_POST["destinatarios"];
        $estado = $_POST["estado"];
        $nivel = $_POST["nivel"];
        $profesor = $_POST["profesor"];
        $fechaInicio = $_POST["fechaInicio"];
        $fechaFinal = $_POST["fechaFinal"];
        $resolucion = $_POST["resolucion"];
        $dictamen = $_POST["dictamen"];
        $nroProyecto = $_POST["nroProyecto"]; 
        $puntaje = $_POST["puntaje"];
        $cargaHoraria = $_POST["cargaHoraria"]; 

        $curso = new Curso($nombreCurso, $direccion, $destinatarios,
                        $estado, $profesor, $fechaInicio, $fechaFinal,
                        $resolucion, $dictamen, $nroProyecto, $puntaje, $cargaHoraria, $idCurso);

        // Guardar los cambios en la base de datos
        $cursoDAL->modificarCurso($curso, $idCurso);

    } else {
        echo "<p>Curso no encontrado</p>";
    }
} else if (isset($_GET['idCurso'])) {
    $idCurso = $_GET['idCurso'];
    $cursoDAL = new CursoDAL();
    $curso = $cursoDAL->getCursoPorId($idCurso);
    $nivel = new NivelDAL;

    if ($curso) { 
?>
        
        <form action="editarCurso.php" method="post">
        <div id='left-column'>

       
        <h1>Editar Curso</h1>

            <input type="hidden" name="idCurso" value="<?= $idCurso; ?>"><!--nosemuestra-->

            <label for="nombreCurso">Nuevo Nombre:</label>
            <input type="text" name="nombreCurso" value="<?= $curso->getNombreCurso(); ?>"><br>

            <label for="direccion">Nueva Dirección:</label>
            <input type="text" name="direccion" value="<?= $curso->getDireccion(); ?>"><br>

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

            <label for="nivel">Nuevo Nivel:</label>
            <input type="text" name="nivel" list="lista-niveles" value="<?= $nivel->getIdNivel($idCurso); ?>"><br>
            <datalist id="lista-niveles">
            <?php require_once("../../../app/models/DAL/nivelDAL.php");
            $nivelDAL->cargarNivel();
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

        </div>
        
    <div id='right-column'>
      <h1>Cronograma</h1>


      <label for="fechaInicio">Nueva Fecha de Inicio:</label>
      <input type="date" id="fechaInicio" name="fechaInicio" class="fechaInicio" value="<?= $curso->getFechaInicio(); ?>"><br>

      <label for="fechaFinal">Nueva Fecha Final:</label>
      <input type="date" id="fechaFinal" name="fechaFinal" class="fechaFinal" value="<?= $curso->getFechaFinal(); ?>"><br>


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
            <input type="submit" name="guardar" value="Guardar Cambios">
    </div>
            <!--Resto de los campos y botones -->
        </form>
<?php
    } else {
        echo "<p>Curso no encontrado</p>";
    }
}
?>
  <script src='script/dias.js'></script>

</body>
</html>



