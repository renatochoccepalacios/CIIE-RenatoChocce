<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CIIE/page/dirs.php';

require_once MODELS_PATH . '/main.php';
require_once MODELS_PATH . '/areas.php';

class AreaDAL extends main
{
    public function __construct()
    {
        parent::__construct();
    }

 
    public function insertArea($area)
    {

        $query = sprintf(
            "INSERT INTO areas (area) VALUES ('%s') ",
            $area->getArea(),
        );

        $idArea = $this->Execute($query);
        return $idArea;
    }

    public function updatearea($area)
    {
         $query = sprintf(
            "UPDATE areas SET area = '%s' WHERE idArea = %d",
            $area->getArea(), $area->getIdArea()

        
         );
    $this->Execute($query);
    }


    public function getAreaPorId($idArea)
    {
        $query = sprintf("SELECT * FROM areas WHERE idArea = %d", $idArea);
        $this->Execute($query);
        $area = $this->getObj($query);

        return $area;
    }
    //cele

    public function getIdArea($idCurso)
    {
        $conexion = $this->conectar();

        $query = "SELECT idArea FROM cursoareas WHERE idCurso = $idCurso";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
            while ($area = mysqli_fetch_assoc($resultado)) {
                return $area['idArea'];
            }
        } else {
            echo "Error en la query de cursoarea: " . mysqli_error($conexion);
        }
    }

    public function asignarAreaACurso($idArea, $idCurso)
    {
        $conexion = $this->conectar();
    
        $query = sprintf(
            "UPDATE cursoareas SET idArea = %d WHERE idCurso = %d",
            $idArea,
            $idCurso
        );
    
        if (mysqli_query($conexion, $query)) {
            echo "<p>area asignada</p>";
    
        } else {
            echo "Error al asignar la area al curso: " . mysqli_error($conexion);
        }
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


    public function MostrarAreaPorId($idArea)
    {
        $conexion = $this->conectar();

        $query = "SELECT area FROM areas WHERE idArea = $idArea";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($Area = mysqli_fetch_assoc($resultado)) {
                echo $Area['area'];
            }
        } else {
            echo "Error en la query de Areas: " . mysqli_error($conexion);
        }
    }

    function contarAreas() {
    
        $query = "SELECT COUNT(*) AS total_areas FROM areas";
        $conexion = $this->conectar();
        $resultado = mysqli_query($conexion, $query);
    
        if ($resultado) {
            if (mysqli_num_rows($resultado) > 0) {
                $row = mysqli_fetch_assoc($resultado);
                $totalAreas = $row['total_areas'];
    
                return $totalAreas; // Devuelve el número de areaes
            } else {
                return 0; // No hay registros, devuelve 0
            }
        }
    }


    public function getAreas()
    {
        $query = "SELECT * FROM areas";

        $this->Execute($query);
        $registros = $this->getAll($query);
        return $registros;
    }

    public function doLoad($columna)
    {
        $Areas = new Area($columna["area"],$columna["idArea"]);

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

?>