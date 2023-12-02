<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CIIE/page/dirs.php';

require_once MODELS_PATH . '/main.php';
require_once MODELS_PATH . '/nivel.php';

class NivelDAL extends main
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertNivel($nivel)
    {

        $query = sprintf(
            "INSERT INTO niveles (nivel) VALUES ('%s') ",
            $nivel->getNivel(),
        );

        $idNivel = $this->Execute($query);
        return $idNivel;
    }
    
    public function updateNivel($nivel)
    {
         $query = sprintf(
            "UPDATE niveles SET nivel = '%s' WHERE idNivel = %d",
            $nivel->getNivel(), $nivel->getIdNivel()

        
         );
    $this->Execute($query);
    }


    function contarNiveles() {
    
        $query = "SELECT COUNT(*) AS total_niveles FROM niveles";
        $conexion = $this->conectar();
        $resultado = mysqli_query($conexion, $query);
    
        if ($resultado) {
            if (mysqli_num_rows($resultado) > 0) {
                $row = mysqli_fetch_assoc($resultado);
                $totalNiveles = $row['total_niveles'];
    
                return $totalNiveles; // Devuelve el número de niveles
            } else {
                return 0; // No hay registros, devuelve 0
            }
        }
    }



    public function cargarNivel()
    {
        // No es necesario definir las variables $this->db_host, $this->db_nombre, $this->db_usuarios, $this->db_contra aquí.

        $conexion = $this->conectar(); // Utiliza el método de conexión heredado.

        $query_nivel = "SELECT idNivel, nivel FROM niveles";

        $resultado_nivel = mysqli_query($conexion, $query_nivel);

        if ($resultado_nivel) {
            while ($fila = mysqli_fetch_assoc($resultado_nivel)) {
                echo '<option value="' . $fila['idNivel'] . '">' . $fila['nivel'] . '</option>';
            }

            mysqli_free_result($resultado_nivel);
        } else {
            echo "Error en la query de niveles";
        }

        mysqli_close($conexion); // Cierra la conexión.
    }

    public function MostrarNivelPorId($idNivel)
    {
        $conexion = $this->conectar();

        $query = "SELECT nivel FROM niveles WHERE idNivel = $idNivel";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($nivel = mysqli_fetch_assoc($resultado)) {
                echo $nivel['nivel'];
            }
        } else {
            echo "Error en la query de niveles: " . mysqli_error($conexion);
        }
    } 

    public function getIdNivel($idCurso)
    {
        $conexion = $this->conectar();

        $query = "SELECT idNivel FROM cursoniveles WHERE idCurso = $idCurso";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
            while ($nivel = mysqli_fetch_assoc($resultado)) {
                return $nivel['idNivel'];
            }
        } else {
            echo "Error en la query de cursonivel: " . mysqli_error($conexion);
        }
    }


        //cele
        public function asignarNivelACurso($idNivel, $idCurso)
        {
            $conexion = $this->conectar();
        
            $query = sprintf(
                "UPDATE cursoniveles SET idNivel = %d WHERE idCurso = %d",
                $idNivel,
                $idCurso
            );
        
            if (mysqli_query($conexion, $query)) {
                echo "<p>nivel asignada</p>";
        
            } else {
                echo "Error al asignar la sede al curso: " . mysqli_error($conexion);
            }
        }
        
         
    public function getNivelPorId($idNivel)
    {
        $query = sprintf("SELECT * FROM niveles WHERE idNivel = %d", $idNivel);
        $this->Execute($query);
        $nivel = $this->getObj($query);

        return $nivel;
    }

/*     public function getIdCursoPorNivel($idNivel)
    {
        $conexion = $this->conectar();

        $query = "SELECT idCurso FROM cursoniveles WHERE idNivel = $idNivel";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
            while ($curso = mysqli_fetch_assoc($resultado)) {
                return $curso['idCurso'];
            }
        } else {
            echo "Error en la query de cursonivel: " . mysqli_error($conexion);
        }
    } */
    public function getIdCursoPorNivel($idNivel)
{
    $conexion = $this->conectar();

    $query = "SELECT idCurso FROM cursoniveles WHERE idNivel = $idNivel";
    $this->Execute($query);
    $resultado = mysqli_query($conexion, $query);

    $cursos = array(); // Crear un array para almacenar los cursos

    if ($resultado) {
        while ($curso = mysqli_fetch_assoc($resultado)) {
            $cursos[] = $curso['idCurso']; // Agregar cada ID de curso al array
        }
    } else {
        echo "Error en la query de cursonivel: " . mysqli_error($conexion);
    }

    return $cursos; // Retornar el array de cursos
}

    
    public function getCursoPorNivel($idNivel)
    {
        $query = sprintf("SELECT idCurso FROM cursoniveles WHERE idNivel = %d", $idNivel);
        $this->Execute($query);
        $cursos = $this->getObj($query);

        return $cursos;
    }

    public function getNiveles()
    {
        $query = "SELECT * FROM niveles";

        $this->Execute($query);
        $registros = $this->getAll($query);
        return $registros;
    }

    public function doLoad($columna)
    {
        $nivel = new Nivel($columna["nivel"],$columna["idNivel"],);


        return $nivel;
    }

    // NICOLAS
    public function getPerDni($dni)
    {
        $query = sprintf(
            "SELECT CN.idNivel, N.nivel
                FROM cursanteNivel CN 
                INNER JOIN niveles N ON CN.idNivel = N.idNivel 
                WHERE dni = '%s';",
            $dni
        );

        $data = $this->getAll($query);
        return $data;
    }
}

$nivelDAL = new NivelDAL();
