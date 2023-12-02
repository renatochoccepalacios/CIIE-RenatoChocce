<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CIIE/page/dirs.php';

require_once MODELS_PATH . '/main.php';
require_once MODELS_PATH . '/areas.php';

class areaDAL extends main
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insertCursoArea($Area)
    {

        $query = sprintf("INSERT INTO cursoareas (idArea,idCurso) 
        VALUES ('%s', '%s')", $Area->getIdArea(), $Area->getIdCurso());
        echo $query;

        $idArea = $this->Execute($query);
        return $idArea;
    }

    public function cargarArea()
    {
        // No es necesario definir las variables $this->db_host, $this->db_nombre, $this->db_usuarios, $this->db_contra aquí.

        $conexion = $this->conectar(); // Utiliza el método de conexión heredado.

        $query_Areas = "SELECT idArea, area FROM Areas";

        $resultado_Areas = mysqli_query($conexion, $query_Areas);

        if ($resultado_Areas) {
            while ($fila = mysqli_fetch_assoc($resultado_Areas)) {
                echo '<option value="' . $fila['idArea'] . '">' . $fila['area'] . '</option>';
            }

            mysqli_free_result($resultado_Areas);
        } else {
            echo "Error en la query de Areas";
        }

        mysqli_close($conexion); // Cierra la conexión.
    }

    public function MostrarAreasPorId($idArea)
    {
        $conexion = $this->conectar();

        $query = "SELECT Area FROM Areas WHERE idArea = $idArea";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($Areas = mysqli_fetch_assoc($resultado)) {
                echo $Areas['Area'];
            }
        } else {
            echo "Error en la query de Areas: " . mysqli_error($conexion);
        }
    }


    public function getAreas()
    {
        $query = "SELECT * FROM Areas";

        $this->Execute($query);
        $registros = $this->getAll($query);
        return $registros;
    }

    public function doLoad($columna)
    {
        $Areas = new Area($columna["area"], $columna["idArea"]);


        return $Areas;
    }

    // nicolas
    public function getPerDni($dni)
    {
        $query = sprintf(
            "SELECT CA.idArea, A.area
            FROM cursanteArea CA 
            INNER JOIN areas A ON CA.idArea = A.idArea 
            WHERE dni = '%s';",
            $dni
        );

        $data = $this->getAll($query);
        return $data;
    }
}

$areaDAL = new areaDAL();
