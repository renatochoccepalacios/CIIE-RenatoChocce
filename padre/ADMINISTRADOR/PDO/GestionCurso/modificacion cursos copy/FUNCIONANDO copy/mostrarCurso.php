<?php

require_once("cursoDALL.php");

require_once("entidades/curso.php");

if (isset($_GET['curso_id'])) {
    $cursoId = $_GET['curso_id'];
    $curso = $cursoDAL->getCursoPorId($cursoId);

    if ($curso) {
        echo "<h1>Detalles del Curso</h1>";
        echo "<p>Nombre del Curso: " . $curso->getNombre_curso() . "</p>";
        echo "<p>Dirección: " . $curso->getDireccion() . "</p>";
        echo "<p>Destinatarios: " . $curso->getDestinatarios() . "</p>";
        echo "<p>Estado: " . $curso->getEstado() . "</p>";
        echo "<p>Nivel: " . $curso->getNivel() . "</p>";
        echo "<p>Profesor: " . $curso->getProfesor() . "</p>";
        echo "<p>Fecha de Inicio: " . $curso->getFechaInicio() . "</p>";
        echo "<p>Fecha Final: " . $curso->getFechaFinal() . "</p>";

        //boton para la modi
        echo "<form action='editarCurso.php' method='post'>";
        echo "<input type='hidden' name='curso_id' value='$cursoId'>";
        echo "<input type='submit' name='editar' value='Editar Curso'>";
        echo "</form>";
    } else {
        echo "<p>Curso no encontrado</p>";
    }
}
?>
