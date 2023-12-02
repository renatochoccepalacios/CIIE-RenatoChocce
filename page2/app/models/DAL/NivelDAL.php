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
    public function insertCursoNivel($nivel)
    {

        $query = sprintf("INSERT INTO cursoniveles (idNivel,idCurso) 
        VALUES ('%s', '%s')", $nivel->getIdNivel(), $nivel->getIdCurso());
        echo $query;

        $idNivel = $this->Execute($query);
        return $idNivel;
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

    public function getNivel()
    {
        $query = "SELECT * FROM niveles";

        $this->Execute($query);
        $registros = $this->getAll($query);
        return $registros;
    }

    public function doLoad($columna)
    {
        $nivel = new Nivel($columna["nivel"], $columna["idNivel"]);


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
