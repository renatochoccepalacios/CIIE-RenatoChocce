
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>mostrar el curso</title>
<link rel='stylesheet' href='styles/estilo.css'>
</head>
<body>


<?php


require_once("../../../../models/DAL/cursoDAL.php");
require_once("../../../../models/curso.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
    $idCurso = $_POST["idCurso"];
    $cursoDAL = new CursoDAL();
    // $curso = $cursoDAL->getCursoPorId($idCurso);

    if (is_object($cursoDAL->getCursoPorId($idCurso))) {
        $nombreCurso = $_POST["nombreCurso"];
        $direccion = $_POST["direccion"];
        $destinatarios = $_POST["destinatarios"];
        $estado = $_POST["estado"];
        $nivel = $_POST["nivel"];
        $profesor = $_POST["profesor"];
        $fechaInicio = $_POST["fechaInicio"];
        $fechaFinal = $_POST["fechaFinal"];
        $resolucion = "";
        $dictamen = "";
        $nroProyecto = ""; 
        $puntaje = 0;
        $cargaHoraria = ""; 




        $curso = new Curso($nombreCurso,$direccion,$destinatarios,
                        $profesor,$nivel,$estado,$fechaInicio,$fechaFinal,
                        $resolucion,$dictamen,$nroProyecto,$puntaje,$cargaHoraria,$idCurso);

/* 
        $curso->nombreCurso = $_POST["nombreCurso"];
        $curso->direccion = $_POST["direccion"];
        $curso->destinatarios = $_POST["destinatarios"];
        $curso->profesor = $_POST["profesor"];
        $curso->nivel = $_POST["nivel"];
        $curso->estado = $_POST["estado"];
        $curso->fechaInicio = $_POST["fechaInicio"];
        $curso->fechaFinal = $_POST["fechaFinal"]; */
       
        // Guardar los cambios en la base de datos
        $cursoDAL->modificarCurso($curso, $idCurso);

    } else {
        echo "<p>Curso no encontrado</p>";
    }
} else if (isset($_GET['idCurso'])) {
    $idCurso = $_GET['idCurso'];
    $cursoDAL = new CursoDAL();
    $curso = $cursoDAL->getCursoPorId($idCurso);

    if ($curso) {
        echo "<h1>Editar Curso</h1>";
        echo "<form action='editarCurso.php' method='post'>";
        echo "<input type='hidden' name='idCurso' value='$idCurso'>"; // Campo oculto para el ID del curso

        echo "<label for='nombreCurso'>Nuevo Nombre:</label>";
        echo "<input type='text' name='nombreCurso' value='" . $curso->getNombreCurso() . "'><br>";
        echo "<label for='direccion'>Nueva Dirección:</label>";
        echo "<input type='text' name='direccion' value='" . $curso->getDireccion() . "'><br>";
        echo "<label for='destinatarios'>Nuevos Destinatarios:</label>";
        echo "<input type='text' name='destinatarios' value='" . $curso->getDestinatarios() . "'><br>";
        echo "<label for='profesor'>Nuevo Profesor:</label>";
        echo "<input type='text' name='profesor' value='" . $curso->getProfesor() . "'><br>";
        echo "<label for 'nivel'> Nuevo Nivel: </label>";
        echo "<input type = 'text' name = 'nivel' value = '" . $curso->getNivel() . "'><br>";
        echo "<label for 'estado'> Nuevo Estado: </label>";
        echo "<input type = 'text' name = 'estado' value = '" . $curso->getEstado() . "'><br>";
        echo "<label for 'fechaInicio'> Nueva Fecha de Inicio: </label>";
        echo "<input type = 'text' name = 'fechaInicio' value = '" . $curso->getFechaInicio() . "'><br>";
        echo "<label for 'fechaFinal'> Nueva Fecha Final: </label>";
        echo "<input type = 'text' name = 'fechaFinal' value = '" . $curso->getFechaFinal() . "'><br>";

        echo "<label for 'resolucion'> Nueva Fecha Final: </label>";
        echo "<input type = 'text' name = 'fechaFinal' value = '" . $curso->getResolucion() . "'><br>";

        echo "<label for 'dictamento'> Nueva Fecha Final: </label>";
        echo "<input type = 'text' name = 'fechaFinal' value = '" . $curso->getDictamen() . "'><br>";

        echo "<label for 'nroProyecto'> Nueva Fecha Final: </label>";
        echo "<input type = 'text' name = 'fechaFinal' value = '" . $curso->getNroProyecto() . "'><br>";

        echo "<label for 'puntaje'> Nueva Fecha Final: </label>";
        echo "<input type = 'text' name = 'fechaFinal' value = '" . $curso->getPuntaje() . "'><br>";

        echo "<label for 'cargahoraria'> Nueva Fecha Final: </label>";
        echo "<input type = 'text' name = 'fechaFinal' value = '" . $curso->getCargaHoraria() . "'><br>";


        // Resto de los campos y botones
        echo "<input type='submit' name='guardar' value='Guardar Cambios'>";
        echo "</form>";
    } else {
        echo "<p>Curso no encontrado</p>";
    }
}
?>


</body>
</html>
