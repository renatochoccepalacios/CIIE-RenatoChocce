<?php
require_once("main.php");

class NivelDAL extends main {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function cargarNivel()
    {
        // No es necesario definir las variables $this->db_host, $this->db_nombre, $this->db_usuarios, $this->db_contra aquí.

        $conexion = $this->conectar(); // Utiliza el método de conexión heredado.

        $query_nivel = "SELECT idNivel, nivel FROM nivel";

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

        $query = "SELECT nivel FROM nivel WHERE idNivel = $idNivel";
        $this->Execute($query); 
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($nivel = mysqli_fetch_assoc($resultado)) {
                echo $nivel['nivel'];
            }
        } else {
            echo "Error en la query de profesores: " . mysqli_error($conexion);
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
            $nivel = new Nivel($columna["estado"],$columna["id_estado"]);


            return $nivel;
        }

 }

$nivelDAL = new NivelDAL();

?>