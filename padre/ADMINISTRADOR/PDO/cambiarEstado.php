<?php  
    if (isset($_POST['idCurso'], $_POST['nuevoEstado'])) {
        $idCurso = $_POST['idCurso'];
        $nuevoEstado = $_POST['nuevoEstado'];

        // Validar que $nuevoEstado sea válido (por ejemplo, "Fuera de Servicio" o "Disponible")
        if ($nuevoEstado !== '1' && $nuevoEstado !== '2') {
            echo 'Estado no válido';
        } else {
            // Realiza la actualización del estado del curso en la base de datos
            require_once('../../models/DAL/cursoDAL.php');
            $cursoDAL = new CursoDAL();
            $success = $cursoDAL->actualizarEstadoCurso($idCurso, $nuevoEstado);

            if ($success) {
                echo '<script>alert("Estado Actualizado")</script>';
            } else {
                echo 'Error al actualizar el estado del curso.';
            }
        }
    } else {
        echo 'Datos insuficientes en la solicitud.';
    }

?>