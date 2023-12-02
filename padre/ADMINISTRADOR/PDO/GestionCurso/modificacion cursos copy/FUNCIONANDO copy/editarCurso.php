
<?php
require_once("cursoDALL.php");
require_once("entidades/curso.php");

if (isset($_POST['curso_id'])) {
    $cursoId = $_POST['curso_id'];
    $curso = $cursoDAL->getCursoPorId($cursoId);

    if ($curso) {
        if (isset($_POST['guardar'])){

            // Obtener los nuevos valores desde el formulario
            $nuevoNombre = $_POST['nuevo_nombre'];
            $nuevaDireccion = $_POST['nueva_direccion'];
           /* $nuevoDestino = $_POST['nuevo_destino'];
            $nuevosDestinatarios = $_POST['nuevos_destinatarios'];
            $nuevoEstado = $_POST['nuevo_estado'];
            $nuevoNivel = $_POST['nuevo_nivel'];
            $nuevoProfesor = $_POST['nuevo_profesor'];
            $nuevaFechainicio = $_POST['nueva_fechainicio'];
            $nuevaFechafinal = $_POST['nueva_fechafinal'];*/

            // Actualizar los datos del curso
            $curso->setNombre_curso($nuevoNombre);
            $curso->setDireccion($nuevaDireccion);
           

    
            $cursoDAL->modificarCurso($curso);

           
            echo "<p>Curso actualizado con éxito.</p>";
        } else {
            
            echo "<h1>Editar Curso</h1>";
            echo "<form action='editarCurso.php' method='post'>";
            echo "<input type='hidden' name='curso_id' value='$cursoId'>";
            echo "<label for='nuevo_nombre'>Nuevo Nombre:</label>";
            echo "<input type='text' name='nuevo_nombre' value='" . $curso->getNombre_curso() . "'><br>";
            echo "<label for='nueva_direccion'>Nueva Dirección:</label>";
            echo "<input type='text' name='nueva_direccion' value='" . $curso->getDireccion() . "'><br>";
           



            echo "<input type='submit' name='guardar' value='Guardar Cambios'>";
            echo "</form>";
        }
    } else {
        echo "<p>Curso no encontrado</p>";
    }
}
?>