<?php
require_once(__DIR__ ."/../../models/curso.php");
require_once("main.php");
class CursoDAL extends main
{


    public function insertCurso($curso)
    {

        $query = sprintf(
            "INSERT INTO curso (nombreCurso, direccion, destinatarios, estado, nivel, profesor, fechaInicio, fechaFinal,
                                resolucion, dictamen, nroProyecto, puntaje, cargaHoraria)
        VALUES ('%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%s', '%s','%s','%s')",
            $curso->getNombreCurso(),
            $curso->getDireccion(),
            $curso->getDestinatarios(),
            $curso->getEstado(),
            $curso->getNivel(),
            $curso->getProfesor(),
            $curso->getFechaInicio(),
            $curso->getFechaFinal(),
            $curso->getResolucion(),
            $curso->getDictamen(),
            $curso->getNroProyecto(),
            $curso->getPuntaje(),
            $curso->getCargaHoraria(),

        );


        $idCurso = $this->Execute($query);
        return $idCurso;
    }



    public function actualizarEstadoCurso($idCurso, $nuevoEstado)
    {

        // Construir la consulta SQL para actualizar el estado del curso
        $query = sprintf(
            // "UPDATE curso SET estado = %d WHERE idCurso = %d",
            "UPDATE curso SET estado = %d WHERE idCurso = %d",
            $nuevoEstado,
            $idCurso
        );

        // Ejecutar la consulta
        $this->Execute($query);
    }


    public function modificarCurso($curso)
    {
        if ($curso->getIdCurso() > 0) {
            $query = sprintf(
                "UPDATE curso SET nombreCurso = '%s', direccion = '%s', destinatarios = '%s',
            estado = '%s', nivel = '%s', profesor = '%s', fechaInicio = '%s', fechaFinal = '%s' WHERE idCurso = %d",
                $curso->getNombreCurso(),
                $curso->getDireccion(),
                $curso->getDestinatarios(),
                $curso->getEstado(),
                $curso->getNivel(),
                $curso->getProfesor(),
                $curso->getFechaInicio(),
                $curso->getFechaFinal(),
                $curso->getIdCurso()
            );

            $this->Execute($query);
            echo "<p>Curso actualizado con éxito.</p>";
            echo $query;
        } else {
            echo "Error: El idCurso es inválido.";
        }
    }



    public function cargarCurso()
    {

        $conexion = $this->conectar();

        $query_cursos = "SELECT idCurso, nombreCurso FROM curso";

        $resultado_cursos = mysqli_query($conexion, $query_cursos);

        if ($resultado_cursos) {
            while ($fila = mysqli_fetch_assoc($resultado_cursos)) {
                echo '<option value="' . $fila['idCurso'] . '">' . $fila['nombreCurso'] . '</option>';
            }

            mysqli_free_result($resultado_cursos);
        } else {
            echo "Error en la query de cursos";
        }
    }

    public function getCursoPorId($idCurso)
    {
        $query = sprintf("SELECT * FROM curso WHERE idCurso = %d", $idCurso);
        $this->Execute($query);
        $curso = $this->getObj($query);

        return $curso;
    }





    public function eliminarCursoYRegistrosRelacionados($idCurso)
    {
        if (isset($_GET['id'])) {
            $idCurso = $_GET['id'];

            // instancia la clase CursoDAL para acceder a la base de datos
            $cursoDAL = new CursoDAL();

            // elimina los registros de cronograma
            $eliminadoCronograma = $cursoDAL->eliminarCronogramaPorCurso($idCurso);

            if ($eliminadoCronograma) {
                // elimina el curso de la base de datos.
                $eliminadoCurso = $cursoDAL->eliminarCurso($idCurso);

                if ($eliminadoCurso) {
                    // Curso eliminado con éxito.
                    header("Location: AbmCurso.php"); // mandamos al usuario a la pagina principal
                } else {
                    // Error al eliminar el curso.
                    echo "Error al eliminar el curso.";
                }
            } else {
                // Error al eliminar registros en la tabla 'cronograma'.
                echo "Error al eliminar registros en la tabla 'cronograma'.";
            }
        }
    }

    public function BuscarPorId($idCurso)
    {
        $query = "SELECT * FROM curso WHERE idCurso = $idCurso";
        $this->Execute($query);
        $registro = $this->getObj($query);

        if ($registro) {
            // Crear un objeto Curso a partir de los datos del registro
            return $this->doLoad($registro);
        } else {
            return null; // Curso no encontrado
        }
    }


    public function EditarCurso($curso, $idCurso)
    {
        $query = sprintf(
            "UPDATE curso SET nombreCurso = '%s', destinatarios = '%s', direccion = '%s', profesor = '%s', nivel = '%s', estado = '%s' WHERE idCurso = %d",
            $curso->getNombreCurso(),
            $curso->getDestinatarios(),
            $curso->getDireccion(),
            $curso->getProfesor(),
            $curso->getNivel(),
            $curso->getEstado(),
            $idCurso
        );

        $this->Execute($query);
        return true; // Devuelve verdadero si la actualización se realizó con éxito
    }


    public function EliminarCurso($idCurso)
    {
        $query = sprintf(
            "DELETE FROM curso WHERE idCurso = %d",
            $idCurso
        );

        $this->Execute($query);
        return true; // Devuelve verdadero si la eliminación se realizó con éxito
    }

    public function BuscarCurso($busqueda)
    {
        $query =
            "SELECT * FROM curso WHERE nombreCurso LIKE '%$busqueda%';";
        // $curso->getNombreCurso(),;
        $this->Execute($query);
        $registros = $this->getAll($query);
        return $registros;
    }








    public function eliminarCursoCronograma($idCurso)
    {

        $query = sprintf(
            "DELETE FROM cronograma WHERE curso= %d",
            "DELETE FROM curso WHERE id_curso = %d",
            $idCurso
        );

        $this->Execute($query);
        return true;
    }

    public function eliminarCronogramaPorCurso($idCurso)
    {
        // function que elimina los registros en la tabla cronograma
        $query = sprintf(
            "DELETE FROM cronograma WHERE curso = %d",

            $idCurso
        );

        $this->Execute($query);
        return true; // Devuelve verdadero si la eliminación se realizó con éxito

    }




    public function getCursos()
    {
        $query = "SELECT * FROM curso";

        $this->Execute($query);
        $registros = $this->getAll($query);
        return $registros;
    }


    public function doLoad($columna)
    {

        $curso = new Curso(
            $columna["nombreCurso"],
            $columna["direccion"],
            $columna["destinatarios"],
            $columna["profesor"],
            $columna["nivel"],
            $columna["estado"],
            $columna["fechaInicio"],
            $columna["fechaFinal"],
            $columna["resolucion"],
            $columna["dictamen"],
            $columna["nroProyecto"],
            $columna["puntaje"],
            $columna["cargaHoraria"],
            $columna["idCurso"]
        );



        return $curso;
    }
}
