
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


if (isset($_GET['idCurso'])) {
    $idCurso = $_GET['idCurso'];
    $cursoDAL = new CursoDAL();
    $curso = $cursoDAL->getCursoPorId($idCurso);

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

        echo "<p>LALALALALAL: " . $curso->getResolucion() . "</p>";
        echo "<p>dictamen: " . $curso->getDictamen() . "</p>";
        echo "<p>lalalla: " . $curso->getNroProyecto() . "</p>";
        echo "<p>aiaia: " . $curso->getPuntaje() . "</p>";
        echo "<p>ajhha: " . $curso->getCargaHoraria() . "</p>";
      


        //agregar un campo oculto para enviar el ID del curso a editarcurso
        echo "<a href='editarCurso.php?idCurso=$idCurso'>Editar Curso</a>";

    } else {
        echo "<p>Curso no encontrado</p>";
    }

}
?>

</body>
</html>
