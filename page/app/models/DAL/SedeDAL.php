<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/CIIE/page/dirs.php';

require_once MODELS_PATH . '/main.php';
require_once MODELS_PATH . '../sedes.php';

class SedeDAL extends main
{
    public function __construct()
    {
        parent::__construct();
    }


    public function insertSede($sede)
    {

        $query = sprintf(
            "INSERT INTO sedes (sede, direccion, altura, localidad) VALUES ('%s','%s','%s','%s') ",
            $sede->getSede(),
            $sede->getDireccion(),
            $sede->getAltura(),
            $sede->getLocalidad(),

        );

        $idSede = $this->Execute($query);
        return $idSede;
    }
    
    public function updateSede($sede)
    {
         $query = sprintf(
            "UPDATE sedes SET sede = '%s' , direccion = '%s',altura = '%s',localidad = '%s' WHERE idSede = %d",
            $sede->getSede(), 
            $sede->getDireccion(),
            $sede->getAltura(),
            $sede->getLocalidad(),
            $sede->getIdSede()

        
         );
    $this->Execute($query);
    }


    public function getSedePorId($idSede)
    {
        $query = sprintf("SELECT * FROM sedes WHERE idSede = %d", $idSede);
        $this->Execute($query);
        $sede = $this->getObj($query);

        return $sede;
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

    // RENATO
    public function getSedePorCurso($idCurso){
        $conexion = $this->conectar();
        
        $query = sprintf("SELECT idSede FROM cursosedes WHERE idCurso = %d", $idCurso);
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);
        
        if ($resultado) {
            while ($curso = mysqli_fetch_assoc($resultado)) {
                return $curso['idSede'];
            }
        } else {
            echo "Error en la query de cursoSede: " . mysqli_error($conexion);
        }
    }

    public function MostrarSedePorId($idSede)
    {
        $conexion = $this->conectar();


        $query = sprintf("SELECT sede FROM sedes WHERE idSede = %d", $idSede);

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

    function contarSedes() {
    
        $query = "SELECT COUNT(*) AS total_sedes FROM sedes";
        $conexion = $this->conectar();
        $resultado = mysqli_query($conexion, $query);
    
        if ($resultado) {
            if (mysqli_num_rows($resultado) > 0) {
                $row = mysqli_fetch_assoc($resultado);
                $totalSedes = $row['total_sedes'];
    
                return $totalSedes; // Devuelve el número de Sedes
            } else {
                return 0; // No hay registros, devuelve 0
            }
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
    

    //cele
    public function asignarSedeACurso($idSede, $idCurso)
{
    $conexion = $this->conectar();

    $query = sprintf(
        "UPDATE cursosedes SET idSede = %d WHERE idCurso = %d",
        $idSede,
        $idCurso
    );

    if (mysqli_query($conexion, $query)) {
        echo "<p>Sede asignada</p>";

    } else {
        echo "Error al asignar la sede al curso: " . mysqli_error($conexion);
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
