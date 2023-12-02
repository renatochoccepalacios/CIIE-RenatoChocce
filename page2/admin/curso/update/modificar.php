

<?php
//noanda 

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
} /* else if (isset($_GET['idCurso'])) {
    $idCurso = $_GET['idCurso'];
    $cursoDAL = new CursoDAL();
    $curso = $cursoDAL->getCursoPorId($idCurso);
    $nivel = new NivelDAL;

    if ($curso) { 

    } else {
        echo "<p>Curso no encontrado</p>";
    }
} */
?>
?>