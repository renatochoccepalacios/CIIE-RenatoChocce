<?php
require_once( __DIR__ ."/../../../padre/models/profesor.php");
require_once("main.php");
class ProfesorDAL extends main
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cargarProfesor()
    {

        $conexion = $this->conectar(); 

        $query = "SELECT idProf, nombreProf FROM profesor";

        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo '<option value="' . $fila['idProf'] . '">' . $fila['nombreProf'] . '</option>';
            }

            mysqli_free_result($resultado);
        } else {
            echo "Error en la query de niveles";
        }

        mysqli_close($conexion); 
    }

    public function insertarProfesor($profesor)
    {


        $sql = sprintf("INSERT INTO profesor (nombreProf, dni, cuil, fotoProf) 
                        VALUES (%s, %s, %s, %s)",
                    $profesor->getNombreProf(),
                    $profesor->getDni(),
                    $profesor->getCuil(),
                    $profesor->getFoto(),

        );

        $this->Execute($sql);

        
    }

    public function MostrarNombrePorId($idProf)
    {
        $conexion = $this->conectar(); 

        $query = "SELECT nombreProf FROM profesor WHERE idProf = $idProf";
        $this->Execute($query); 
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($nombre = mysqli_fetch_assoc($resultado)) {
                echo $nombre['nombreProf'];
            }
        } else {
            echo "Error en la query de profesores: " . mysqli_error($conexion);
        }
    }

    public function getProfesor()
    {
        
        $query = "SELECT * FROM profesor";
        $this->Execute($query);
        $registros = $this->getObj($query);
        return $registros;
    }



    public function doLoad($columna)
    {
        $profesor = new Profesor($columna["nombreProf"], $columna["dni"], $columna["cuil"], $columna["idProf"]);
        return $profesor;
    }
}

$profesorDAL = new ProfesorDAL();
?>
