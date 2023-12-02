<?php
require_once('./config/cursoDAL.php');

/*     require_once('conexion.php');
    require_once('GestionarCursos.php');

 $consulta = "SELECT * FROM curso";
 $resultado = mysqli_query($conexion, $consulta);


 if($resultado){
    while($row = mysqli_fetch_assoc($resultado)){
        $nombreCurso = $row['nombreCurso'];
        $destinatario = $row['destinatarios'];
        $direccion = $row['direccion'];
        $profesor = $row['profesor'];
        $nivel = $row['nivel'];
        $estado = $row['estado'];
        $id_curso = $row['idCurso'];
    }
 }*/

if (isset($_GET['cursoId'])) {
    $cursoId = $_GET['cursoId'];
    $cursoDAL = new CursoDAL();
    $curso = $cursoDAL->getCursoPorId($cursoId);


    if ($curso) {
        echo "<h1>Detalles del Curso</h1>";
        echo "<p>Nombre del Curso: " . $curso->getNombreCurso() . "</p>";
        echo "<p>Dirección: " . $curso->getDireccion() . "</p>";
        echo "<p>Destinatarios: " . $curso->getDestinatarios() . "</p>";
        echo "<p>Estado: " . $curso->getEstado() . "</p>";
        echo "<p>Nivel: " . $curso->getNivel() . "</p>";
        echo "<p>Profesor: " . $curso->getProfesor() . "</p>";
        echo "<p>Fecha de Inicio: " . $curso->getFechaInicio() . "</p>";
        echo "<p>Fecha Final: " . $curso->getFechaFinal() . "</p>";
    } else {
        echo "<p>Curso no encontrado</p>";
    }
}

?>