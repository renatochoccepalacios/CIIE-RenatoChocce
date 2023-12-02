<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CIIE/page/dirs.php';

require_once MODELS_PATH . '/main.php';
require_once MODELS_PATH . '/sedes.php';

class SedeDAL extends main
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insertCursoSede($sede)
    {

        $query = sprintf("INSERT INTO cursoSedes (idSede,idCurso) 
        VALUES ('%s', '%s')", $sede->getIdSede(), $sede->getIdCurso());
        echo $query;

        $idSede = $this->Execute($query);
        return $idSede;
    }

    public function cargarSede()
    {
        $conexion = $this->conectar(); 

        $query_Sede = "SELECT idSede, sede FROM sedes";

        $resultado_Sede = mysqli_query($conexion, $query_Sede);

        if ($resultado_Sede) {
            while ($fila = mysqli_fetch_assoc($resultado_Sede)) {
                echo '<option value="' . $fila['idSede'] . '">' . $fila['sede'] . '</option>';
            }

            mysqli_free_result($resultado_Sede);
        } else {
            echo "Error en la query de Sedees";
        }

        mysqli_close($conexion); 
    }

    public function MostrarSedePorId($idSede)
    {
        $conexion = $this->conectar();

        $query = "SELECT sede FROM sedes WHERE idSede = $idSede";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($sede = mysqli_fetch_assoc($resultado)) {
                echo $sede['sede'];
            }
        } else {
            echo "Error en la query de Sedees: " . mysqli_error($conexion);
        }
    }

    public function getIdSede($idCurso)
    {
        $conexion = $this->conectar();

        $query = "SELECT idSede FROM cursosedes WHERE idCurso = $idCurso";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
            while ($Sede = mysqli_fetch_assoc($resultado)) {
                return $Sede['idSede'];
            }
        } else {
            echo "Error en la query de cursoSede: " . mysqli_error($conexion);
        }
    }

    public function getSede()
    {
        $query = "SELECT * FROM sedes";

        $this->Execute($query);
        $registros = $this->getAll($query);
        return $registros;
    }

    public function doLoad($columna)
    {
        $sede = new Sede($columna["sede"],$columna["direccion"],$columna["altura"],$columna["localidad"], $columna["idSede"]);


        return $sede;
    }

}

$sedeDAL = new SedeDAL();
