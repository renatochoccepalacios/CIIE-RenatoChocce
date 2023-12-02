<?php
require_once("main.php");

class EstadoDAL extends main {
    public function __construct()
    {
        parent::__construct();
    }

    public function cargarEstado()
    {
        // No es necesario definir las variables $this->db_host, $this->db_nombre, $this->db_usuarios, $this->db_contra aquí.

        $conexion = $this->conectar(); // Utiliza el método de conexión heredado.

        $query_estado = "SELECT idEstado, estado FROM estado";

        $resultado_estado = mysqli_query($conexion, $query_estado);

        if ($resultado_estado) {
            while ($fila = mysqli_fetch_assoc($resultado_estado)) {
                echo '<option value="' . $fila['idEstado'] . '">' . $fila['estado'] . '</option>';
            }

            mysqli_free_result($resultado_estado);
        } else {
            echo "Error en la query de estados";
        }

        mysqli_close($conexion); // Cierra la conexión.
    }

    public function MostrarEstadoPorId($idEstado)
    {
        $conexion = $this->conectar(); 

        $query = "SELECT estado FROM estado WHERE idEstado = $idEstado";
        $this->Execute($query); 
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($nivel = mysqli_fetch_assoc($resultado)) {
                echo $nivel['estado'];
            }
        } else {
            echo "Error en la query de profesores: " . mysqli_error($conexion);
        }
    }


    public function getEstado()
    {
        $query = "SELECT * FROM estado";                         

        $this->Execute($query); // Utiliza el método heredado para establecer la query.
        $registros = $this->getAll($query); // Utiliza el método heredado para obtener los registros.
        return $registros;
    }

    public function doLoad($columna)
    {
        $estado = new Estado($columna["estado"], $columna["idEstado"]);

        return $estado;
    }
}

$estadoDAL = new EstadoDAL();

?>