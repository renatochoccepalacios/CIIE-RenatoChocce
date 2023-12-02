<?php

require_once('DAL/UsuarioDAL.php');

class Magia
{
    private $user;
    private $pass;
    private $host;
    private $db;

    // gabriel
    public function __construct()
    {
        $config = parse_ini_file('C:\Apache24\htdocs\config\ciie.ini');
        $this->user = $config['user'];
        $this->pass = $config['password'];
        $this->host = $config['host'];
        $this->db = $config['db'];
    }

    // gabriel
    public function getCursosPerPage(int $page, $dni)
    {
        $query = sprintf(
            "SELECT DISTINCT C.idCurso, C.nombre, CA.dniAlumno
            FROM cursos c
            INNER JOIN cursoalumnos CA ON C.idCurso = CA.idCurso
            WHERE CA.dniAlumno = '%s'
            LIMIT %s, 5",
            $dni,
            ($page - 1) * 5
        );

        $cursos = $this->getAll2($query, $dni);
        return $cursos;
    }

    // gabriel
    public function getAll2($query, $dni)
    {
        $conexion = $this->conectar();
        $resultado = mysqli_query($conexion, $query);

        $registros = [];

        while ($columna = mysqli_fetch_array($resultado)) {
            $registros[] = $this->doLoad2($columna, $dni);
        }

        return $registros;
    }

    // gabriel
    public function doLoad2($data, $dni)
    {
        $obj = new stdClass();
        $obj->idCurso = $data['idCurso'];
        $obj->nombre = $data['nombre'];

        if ($this->verifyVigencia($data['idCurso']) == 1) {
            $obj->estado = "Aún no comienza.";
        } else {
            if ($this->verifyVigencia2($data['idCurso']) == 0) {
                $obj->estado = "Finalizado";

                $estado = $this->getCalificaciones($dni, $data['idCurso']);

                if ($estado == 'Aprobado') {
                    $obj->estado = $obj->estado . ' - Retiró certificado: ';

                    if ($fecha = $this->verifyRetiroCertificado($dni, $data['idCurso'])) {
                        $obj->estado = $obj->estado . "Si ($fecha)";
                    } else {
                        $obj->estado = $obj->estado . "No";
                    }
                }
            } else {
                $obj->estado = "En curso";
            }
        }

        return $obj;
    }

    public function countPages($dni)
    {
        $query = sprintf(
            "SELECT DISTINCT C.idCurso, C.nombre, CA.dniAlumno
            FROM cursos c
            INNER JOIN cursoalumnos CA ON C.idCurso = CA.idCurso
            WHERE CA.dniAlumno = '%s'",
            $dni
        );

        return $this->count($query);
    }

    // main
    public function conectar(): mysqli
    {
        $conexion = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or
            die("ERROR: no se pudo conectar a la base de datos.");

        return $conexion;
    }

    // main
    public function getData()
    {
        $query = "SELECT * FROM cursos";

        $data = $this->getAll($query);
        return $data;
    }

    // main
    public function execute($query)
    {
        $conexion = $this->conectar();

        mysqli_query($conexion, $query);
        mysqli_close($conexion);
    }

    // main
    public function getAll($query)
    {
        $conexion = $this->conectar();
        $resultado = mysqli_query($conexion, $query);

        $registros = [];

        while ($columna = mysqli_fetch_array($resultado)) {
            $registros[] = $this->doLoad($columna);
        }

        return $registros;
    }

    // gabriel
    public function getCursosVigentes()
    {
        $query = sprintf(
            "SELECT * FROM cursos WHERE fechaInicio >= '%s'",
            date_format(new DateTime(), "Y-m-d H:i:s")
        );

        $data = $this->getAll($query);
        return $data;
    }

    // gabriel
    // verifica si el curso ya comenzo
    public function verifyVigencia($idCurso)
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

    // gabriel
    // verifica si el curso ya termino
    public function verifyVigencia2($idCurso)
    {
        $conexion = $this->conectar();
        $query = sprintf(
            "SELECT fechaFin FROM cursos WHERE idCurso = %s",
            $idCurso
        );

        $resultado = mysqli_query($conexion, $query);
        $resultado = mysqli_fetch_array($resultado);

        $hoy = new DateTime();
        $fechaFin = new DateTime($resultado['fechaFin']);

        if ($hoy > $fechaFin) {
            return 0; // ya no esta en vigencia
        } else {
            return 1; // esta vigente
        }
    }

    // main
    public function getObj($query)
    {
        $conexion = $this->conectar();
        $resultado = mysqli_query($conexion, $query);

        $obj = $this->doLoad(mysqli_fetch_array($resultado));
        return $obj;
    }

    // main
    public function doLoad($data)
    {
        $usuarioDAL = new UsuarioDAL();

        $obj = new stdClass();
        $obj->idCurso = $data['idCurso'];
        $obj->nombre = $data['nombre'];
        $obj->profesor = $usuarioDAL->getPerId($data['dniProfesor']);
        $obj->estado = $data['idEstado'];
        $obj->vacantes = $data['vacantes'];
        // $obj->niveles = $this->getNiveles($data['idCurso']);
        // $obj->areas = $this->getAreas($data['idCurso']);
        $obj->fechaInicio = date_format(new Datetime($data['fechaInicio']), "d/m/Y");
        $obj->fechaFin = date_format(new Datetime($data['fechaFin']), "d/m/Y");

        return $obj;
    }

    // no va
    /*     public function getNiveles($idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(

            "SELECT nivel FROM cursoniveles CN INNER JOIN niveles N ON CN.idNivel = N.idNivel WHERE CN.idCurso = '%s'",
            $idCurso
        );
        $res = mysqli_query($conexion, $query);

        $niveles = [];

        foreach ($res as $col) :
            $niveles[] = $col['nivel'];
        endforeach;

        return $niveles;
    } */

    // no va
    /* public function getAreas($idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(

            "SELECT area FROM cursoareas CA INNER JOIN areas A ON CA.idArea = A.idArea WHERE CA.idCurso = '%s'",
            $idCurso
        );
        $res = mysqli_query($conexion, $query);

        $areas = [];

        foreach ($res as $col) :
            $areas[] = $col['area'];
        endforeach;

        return $areas;
    } */

    // gabriel
    public function getPerEstado($estado)
    {
        $query = sprintf(
            "SELECT *
            FROM CURSOS C
            INNER JOIN CURSOESTADO CE ON C.IDESTADO = CE.IDESTADO
            WHERE C.IDESTADO = %s",
            $estado
        );

        $data = $this->getAll($query);
        return $data;
    }

    public function getPerParticipacion($dni)
    {
        $query = sprintf(
            "SELECT * FROM CURSOS C
            INNER JOIN CURSOALUMNOS CA ON CA.IDCURSO = C.IDCURSO
            WHERE DNIALUMNO = %s",
            $dni
        );

        $data = $this->getAll($query);
        return $data;
    }

    // gabriel
    public function getPerId($idCurso)
    {
        $query = sprintf(
            "SELECT * FROM cursos
            WHERE idCurso = %s",
            $idCurso
        );

        $data = $this->getAll($query);
        return $data;
    }

    // no va
    /* public function getPerArea($idArea)
    {
        $query = sprintf(
            "SELECT * FROM CURSOS C
            INNER JOIN cursoareas CA ON C.IDCURSO = CA.IDCURSO
            WHERE C.IDCURSO = %s;",
            $idArea
        );

        $data = $this->getAll($query);
        return $data;
    } */

    // no va
    /* public function getPerNivel($idNivel)
    {
        $query = sprintf(
            "SELECT * FROM CURSOS C
            INNER JOIN cursoniveles CN ON C.IDCURSO = CN.IDCURSO
            WHERE C.IDCURSO = %s;",
            $idNivel
        );

        $data = $this->getAll($query);
        return $data;
    } */

    // no v
    /* public function getPerNivelAndCurso($dni)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT C.IDCURSO from usuarios U 
            INNER JOIN CURSANTEAREA CA ON U.DNI = CA.DNI 
            INNER JOIN CURSANTENIVEL CN ON U.DNI = CN.DNI 
            INNER JOIN CURSONIVELES CNN ON CNN.IDNIVEL = CN.IDNIVEL
            INNER JOIN CURSOAREAS CAA ON CAA.IDAREA = CA.IDAREA
            INNER JOIN CURSOS C ON C.IDCURSO = CAA.IDCURSO AND C.IDCURSO = CNN.IDCURSO
            WHERE U.DNI = %s GROUP BY C.IDCURSO;",
            $dni
        );

        $res = mysqli_query($conexion, $query);

        $cursos = [];

        while ($col = mysqli_fetch_array($res)) {
            $cursos[] = $this->getPerId($col['IDCURSO']);
        }

        return $cursos;
    } */

    // gabriel
    public function vacantesCurso($idCurso)
    {
        $query = sprintf('select * from cursoalumnos where idcurso = %s', $idCurso);
        $filas = $this->count($query);

        $curso = $this->getPerId($idCurso);

        return $curso[0]->vacantes - $filas;
    }

    // main
    public function count($query)
    {
        $conexion = $this->conectar();

        $resp = mysqli_query($conexion, $query);
        $filas = mysqli_num_rows($resp);

        return $filas;
    }

    public function getPerDni($dni)
    {
        // conectamos a la base de datos
        $conexion = $this->conectar();

        // definimos la consulta
        $query = sprintf(
            'SELECT idCurso FROM cursoalumnos WHERE dniAlumno = "%s"',
            $dni
        );

        // realizamos la consulta
        $resp = mysqli_query($conexion, $query);

        // inicializamos el array en el que vamos a cargar los cursos
        $cursos = [];

        // iteramos los resultados
        while ($col = mysqli_fetch_array($resp)) {
            $cursos[] = $this->getPerId($col['idCurso']);
        }

        // devolvemos los cursos
        return $cursos;
    }

    public function getAlumnos($idCurso)
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

    public function loadPresentismo($dni, $idCurso, $estado)
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

    public function verifyAsistencia($idCurso)
    {
        $query = sprintf(
            "SELECT * FROM cursopresentismo WHERE idCurso = %s && fecha = '%s'",
            $idCurso,
            date_format(new DateTime(), "Y-m-d")
        );

        $filas = $this->count($query);

        return $filas > 0 ? 1 : 0;
    }

    public function eliminarNotas($idCurso)
    {
        $query = sprintf(
            "DELETE FROM CursoFinalizacion WHERE idCurso = %s",
            $idCurso
        );

        $this->execute($query);
    }

    public function cerrarNotas($dni, $idCurso, $estado)
    {
        $query = sprintf(
            "INSERT INTO CursoFinalizacion (dni,idCurso,estado) VALUES ('%s',%s,%s)",
            $dni,
            $idCurso,
            $estado

        );

        $this->execute($query);
    }

    public function generateCertificado($dniAlumno, $idCurso)
    {
        $query = sprintf(
            "INSERT INTO cursocertificado (dniAlumno, idCurso , fechaEmision) VALUES ('%s', %s, '%s')",
            $dniAlumno,
            $idCurso,
            date_format(new DateTime(), "y-m-d")
        );

        $this->execute($query);
    }


    // funcion verificar estado curso
    public function verificarEstadoNotas($idCurso)
    {
        $query = sprintf(
            'SELECT * FROM calificaciones WHERE idCurso = %s',
            $idCurso
        );

        $filas = $this->count($query);
        return $filas;
    }

    public function deleteCalificaciones($idCurso)
    {
        $query = sprintf("DELETE FROM calificaciones WHERE idCurso = %s", $idCurso);
        $this->execute($query);
    }

    public function calificaciones($dniAlumno, $idCurso, $estado)
    {
        $query = sprintf(
            "INSERT INTO calificaciones (dniAlumno,idCurso,estado) VALUES ('%s',%s,'%s')",
            $dniAlumno,
            $idCurso,
            $estado
        );

        $this->execute($query);
    }

    public function getCalificaciones($dniAlumno, $idCurso)
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

    public function verifyCertificado($dni, $idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT * FROM cursocertificado WHERE dniAlumno = '%s' AND idCurso = %s",
            $dni,
            $idCurso
        );

        $resp = mysqli_query($conexion, $query);
        $resp = mysqli_fetch_array($resp);

        return isset($resp['fechaRetiro']) ? $resp['fechaRetiro'] : "No";
    }

    public function verifyGeneracionCertificado($dni, $idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT fechaEmision FROM cursocertificado WHERE dniAlumno = '%s' AND idCurso = %s",
            $dni,
            $idCurso
        );

        $resp = mysqli_query($conexion, $query);
        $resp = mysqli_fetch_array($resp);

        return isset($resp['fechaEmision']) ? date_format(new DateTime($resp['fechaEmision']), "d/m/Y") : null;
    }

    public function getAlumnosAprobados($idCurso)
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

    public function verifyRetiroCertificado($dni, $idCurso)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT fechaRetiro FROM cursocertificado WHERE dniAlumno = '%s' AND idCurso = %s",
            $dni,
            $idCurso
        );

        $resp = mysqli_query($conexion, $query);
        $resp = mysqli_fetch_array($resp);

        return isset($resp['fechaRetiro']) ? date_format(new DateTime($resp['fechaRetiro']), "d/m/Y") : null;
    }

    public function verifyAllCertifies($idCurso)
    {
        $query = sprintf("SELECT id FROM cursocertificado WHERE idCurso = %s", $idCurso);
        return $this->count($query);
    }

    public function getPerETR(string $dni)
    {
        $query = sprintf("SELECT * FROM cursos WHERE dniprofesor = '%s'", $dni);

        $cursos = $this->getAll($query);
        return $cursos;
    }

    public function verifyETR(string $dni, int $idCurso)
    {
        $query = sprintf("SELECT * FROM cursos WHERE dniprofesor = '%s' AND idCurso = %s", $dni, $idCurso);

        $cursos = $this->count($query);
        return $cursos > 0 ? 1 : 0;
    }

    // pasar fecha, dni, idCurso y que traega el estado
    public function getEstado($fecha, $dni, $idCurso)
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

    public function getDias($idCurso)
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
}