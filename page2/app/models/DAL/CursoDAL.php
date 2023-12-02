<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CIIE/page/dirs.php';

require_once MODELS_PATH . '/curso.php';
require_once MODELS_PATH . '/main.php';

require_once MODELS_PATH . '/DAL/UsuarioDAL.php';

class CursoDAL extends main
{


    public function insertCurso($curso)
    {

        $query = sprintf(
            "INSERT INTO cursos (curso, destinatarios, idestado,dniprofesor, fechaInicio, fechaFinal,
                                resolucion, dictamen, nroProyecto, puntaje, cargaHoraria)
        VALUES ('%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%s', '%s')",
            $curso->getNombreCurso(),
            $curso->getDestinatarios(),
            $curso->getEstado(),
            $curso->getProfesor(),
            $curso->getFechaInicio(),
            $curso->getFechaFinal(),
            $curso->getResolucion(),
            $curso->getDictamen(),
            $curso->getNroProyecto(),
            $curso->getPuntaje(),
            $curso->getCargaHoraria()

        );

        // echo $query;


        $idCurso = $this->Execute($query);
        return $idCurso;
    }

    public function actualizarEstadoCurso($idCurso, $nuevoEstado)
    {

        // Construir la consulta SQL para actualizar el estado del curso
        $query = sprintf(
            "UPDATE cursos SET idestado = %d WHERE idCurso = %d",
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
                "UPDATE cursos SET curso = '%s', destinatarios = '%s',
            idestado = '%s', fechaInicio = '%s', fechaFinal = '%s',  resolucion= '%s', dictamen= '%s', 
            nroProyecto= '%s', puntaje= '%s', cargaHoraria= '%s' WHERE idCurso = %d",
                $curso->getNombreCurso(),
                $curso->getDestinatarios(),
                $curso->getEstado(),
                //$curso->getNivel(),
                //$curso->getProfesor(),
                $curso->getFechaInicio(),
                $curso->getFechaFinal(),
                $curso->getResolucion(),
                $curso->getDictamen(),
                $curso->getNroProyecto(),
                $curso->getPuntaje(),
                $curso->getCargaHoraria(),

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

        $query_cursos = "SELECT idCurso, curso FROM cursos";

        $resultado_cursos = mysqli_query($conexion, $query_cursos);

        if ($resultado_cursos) {
            while ($fila = mysqli_fetch_assoc($resultado_cursos)) {
                echo '<option value="' . $fila['idCurso'] . '">' . $fila['curso'] . '</option>';
            }

            mysqli_free_result($resultado_cursos);
        } else {
            echo "Error en la query de cursos";
        }
    }

    public function getCursoPorId($idCurso)
    {
        $query = sprintf("SELECT * FROM cursos WHERE idCurso = %d", $idCurso);
        $this->Execute($query);
        $curso = $this->getObj($query);

        return $curso;
    }

    public function getNivelPorId($idCurso)
    {
        $query = sprintf("SELECT * FROM cursos WHERE idCurso = %d", $idCurso);
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
            "UPDATE curso SET nombreCurso = '%s', destinatarios = '%s', profesor = '%s', nivel = '%s', estado = '%s' WHERE idCurso = %d",
            $curso->getNombreCurso(),
            $curso->getDestinatarios(),
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
            "SELECT * FROM cursos WHERE curso LIKE '%$busqueda%';";
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
        $query = "SELECT * FROM cursos";

        $this->Execute($query);
        $registros = $this->getAll($query);
        return $registros;
    }


    public function doLoad($columna)
    {

        $curso = new Curso(
            $columna["curso"],
            $columna["destinatarios"],
            $columna["idestado"],
            $columna["dniprofesor"],
            $columna["fechaInicio"],
            $columna["fechaFinal"],
            $columna["resolucion"],
            $columna["dictamen"],
            $columna["nroProyecto"],
            $columna["puntaje"],
            $columna["cargaHoraria"],
            $columna["idCurso"],
            $columna["cargaHoraria"],

        );


        return $curso;
    }
    // NICOLAS
    // trae los alumnos aprobados de un curso
    public function getApprovedStudents($idCurso)
    {
        //conectar a la bd
        $conexion = $this->conectar();

        //traer el listado de alumnos del curso según idcurso
        $query = sprintf(
            "SELECT DISTINCT * FROM cursoalumnos CA
            INNER JOIN calificaciones C ON C.idCurso = %s
            AND C.dniAlumno = CA.dniAlumno
            AND C.idCurso = CA.idCurso 
            AND C.estado = 'Aprobado'",
            $idCurso
        );

        $resultado = mysqli_query($conexion, $query);

        $alumnos = [];
        $usuarioDAL = new UsuarioDAL();

        while ($col = mysqli_fetch_array($resultado)) {
            $alumnos[] = $usuarioDAL->getPerId($col['dniAlumno']);
        }

        return $alumnos;
    }

    // NICOLAS
    // verifica si un curso comenzó
    public function checkStart($idCurso)
    {
        $conexion = $this->conectar();
        $query = sprintf(
            "SELECT fechaInicio FROM cursos WHERE idCurso = %s",
            $idCurso
        );

        $resultado = mysqli_query($conexion, $query);
        $resultado = mysqli_fetch_array($resultado);

        $hoy = new DateTime();
        $fechaInicio = new DateTime($resultado['fechaInicio']);

        if ($hoy > $fechaInicio) {
            return 0; // ya arranco
        } else {
            return 1; // no arranco
        }
    }

    // NICOLAS
    // verifica si un curso terminó
    public function checkEnd($idCurso)
    {
        $conexion = $this->conectar();
        $query = sprintf(
            "SELECT fechaFinal FROM cursos WHERE idCurso = %s",
            $idCurso
        );

        $resultado = mysqli_query($conexion, $query);
        $resultado = mysqli_fetch_array($resultado);

        $hoy = new DateTime();
        $fechaFin = new DateTime($resultado['fechaFinal']);

        if ($hoy > $fechaFin) {
            return 0; // ya no esta en vigencia
        } else {
            return 1; // esta vigente
        }
    }

    // NICOLAS
    public function checkAttendance($idCurso)
    {
        $query = sprintf(
            "SELECT * FROM cursopresentismo WHERE idCurso = %s && fecha = '%s'",
            $idCurso,
            date_format(new DateTime(), "Y-m-d")
        );

        $filas = $this->count($query);

        return $filas > 0 ? 1 : 0;
    }

    // NICOLAS
    // trae los alumnos de un curso
    public function getStudents($idCurso)
    {
        //conectar a la bd
        $conexion = $this->conectar();

        //traer el listado de alumnos del curso según idcurso
        $query = sprintf(
            'SELECT DISTINCT dniAlumno FROM cursoalumnos WHERE idCurso = %s',
            $idCurso
        );

        $resultado = mysqli_query($conexion, $query);

        $alumnos = [];
        $usuarioDAL = new UsuarioDAL();

        while ($col = mysqli_fetch_array($resultado)) {
            $alumnos[] = $usuarioDAL->getPerId($col['dniAlumno']);
        }

        return $alumnos;
    }

    // NICOLAS
    // carga la asistencia
    public function setAttendance($dni, $idCurso, $estado)
    {
        //insertar en la tabla cursopresentismo
        $query = sprintf(
            'INSERT INTO cursopresentismo (fecha, dniAlumno, idCurso, estado) VALUES ("%s", "%s", %s, "%s")',
            date_format(new DateTime(), "Y-m-d") . " 00:00:00",
            $dni,
            $idCurso,
            $estado
        );

        $this->execute($query);
    }

    // NICOLAS
    // elimina las notas de un alumno
    public function removeGrades($idCurso)
    {
        $query = sprintf("DELETE FROM calificaciones WHERE idCurso = %s", $idCurso);
        $this->execute($query);
    }

    // NICOLAS
    // setea las notas de un alumno
    public function setGrades($dniAlumno, $idCurso, $estado)
    {
        $query = sprintf(
            "INSERT INTO calificaciones (dniAlumno,idCurso,estado) VALUES ('%s',%s,'%s')",
            $dniAlumno,
            $idCurso,
            $estado
        );

        $this->execute($query);
    }

    // NICOLAS
    // trae las notas de un alumno
    public function getGrades($dniAlumno, $idCurso)
    {
        $conexion = $this->conectar();

        // consulta (SOLO TRAER estado)
        $query = sprintf(
            "SELECT estado FROM calificaciones WHERE dniAlumno = '%s' AND idCurso = %s",
            $dniAlumno,
            $idCurso
        );


        // ejecutar la consulta
        $resultado = mysqli_query($conexion, $query);
        $resultado = mysqli_fetch_array($resultado);

        return isset($resultado['estado']) ? $resultado['estado'] : "Aún sin calificación";
    }

    // NICOLAS (esta mal porque deberia hacerla gabriel)
    public function getDates($idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT fecha FROM cursopresentismo WHERE idCurso = %s GROUP BY(fecha) ORDER BY fecha;",
            $idCurso
        );

        $posiciones = ["I", "J", "K", "L"];

        $i = 0;
        $fechas = [];

        // ejecutar la consulta
        $resultado = mysqli_query($conexion, $query);
        while ($col = mysqli_fetch_array($resultado)) {
            $fechas[$posiciones[$i]] = date_format(new DateTime($col['fecha']), 'Y-m-d 00:00:00');
            $i++;
        }

        return $fechas;
    }

    // NICOLAS
    // obtiene la asistencia de un alumno en una fecha y curso especificos
    public function getAttendance($fecha, $dni, $idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT estado FROM cursopresentismo WHERE fecha = '%s' AND dniAlumno = '%s' AND idCurso = %s ",
            date_format(new DateTime($fecha), "Y-m-d") . " 00:00:00",
            $dni,
            $idCurso
        );

        // ejecutar la consulta
        $resultado = mysqli_query($conexion, $query);
        $resultado = mysqli_fetch_array($resultado);

        return $resultado['estado'];
    }

    // NICOLAS
    // devuelve la cantidad de certificados emitidos
    public function verifyAllCertifies($idCurso)
    {
        $query = sprintf("SELECT id FROM cursocertificado WHERE idCurso = %s", $idCurso);
        return $this->count($query);
    }

    // NICOLAS
    // verificar si se emitio el certificado
    public function verifyCertificateIssuance($dni, $idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT id, fechaEmision FROM cursocertificado WHERE dniAlumno = '%s' AND idCurso = %s ORDER BY id DESC LIMIT 1",
            $dni,
            $idCurso
        );

        $resp = mysqli_query($conexion, $query);
        $resp = mysqli_fetch_array($resp);

        return isset($resp['fechaEmision']) && $resp['fechaEmision'] != "" ? [1, $resp['id']] : (isset($resp['id']) ? [0, $resp['id']] : null);
    }

    // NICOLAS
    // verificar si se retiro el certificado
    public function verifyCertificateWithdrawal($dni, $idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT id, fechaRetiro FROM cursocertificado WHERE dniAlumno = '%s' AND idCurso = %s ORDER BY id DESC LIMIT 1",
            $dni,
            $idCurso
        );

        $resp = mysqli_query($conexion, $query);
        $resp = mysqli_fetch_array($resp);

        return isset($resp['fechaRetiro']) && $resp['fechaRetiro'] != "" ? [1, $resp['id']] : [0, $resp['id']];
    }

    // NICOLAS
    // traer la fecha en la que se retiro el certificado
    public function getDateCertificateWithdrawal($id)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT fechaRetiro FROM cursocertificado WHERE id = %s",
            $id
        );

        $resp = mysqli_query($conexion, $query);
        $resp = mysqli_fetch_array($resp);

        return isset($resp['fechaRetiro']) ? date_format(new DateTime($resp['fechaRetiro']), "d/m/Y") : null;
    }

    // NICOLAS
    // traer la fecha en la que se retiro el certificado
    public function getDateCertificateIssuance($id)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT fechaEmision FROM cursocertificado WHERE id = %s",
            $id
        );

        $resp = mysqli_query($conexion, $query);
        $resp = mysqli_fetch_array($resp);

        return isset($resp['fechaEmision']) ? date_format(new DateTime($resp['fechaEmision']), "d/m/Y") : null;
    }

    // NICOLAS
    // emitir certificado
    public function issueCertificate($dniAlumno, $idCurso)
    {
        $query = sprintf(
            "INSERT INTO cursocertificado (dniAlumno, idCurso, fechaEmision) VALUES ('%s', %s, '%s')",
            $dniAlumno,
            $idCurso,
            date_format(new DateTime(), "Y-m-d")
        );

        $this->execute($query);
    }

    // NICOLAS
    // retirar certificado
    public function withdrawCertificate($id)
    {
        $query = sprintf(
            "UPDATE cursocertificado SET fechaRetiro = '%s' WHERE id = %s",
            date_format(new DateTime(), 'Y-m-d H:i:s'),
            $id
        );

        $this->execute($query);
    }

    // NICOLAS
    // remover certificado
    public function removeCertificate($dniAlumno, $idCurso)
    {
        $query = sprintf(
            "DELETE FROM cursocertificado WHERE dniAlumno = '%s' AND idCurso = %s",
            $dniAlumno,
            $idCurso
        );

        $this->execute($query);
    }

    // NICOLAS
    // traer la cantidad de veces que se generó el certificado
    public function getQuantityCertificateIssues($dniAlumno, $idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT count(id) FROM cursocertificado WHERE dniAlumno = '%s' AND idCurso = %s",
            $dniAlumno,
            $idCurso
        );

        $resp = mysqli_query($conexion, $query);
        $resp = mysqli_fetch_array($resp);

        return $resp[0];
    }
}
