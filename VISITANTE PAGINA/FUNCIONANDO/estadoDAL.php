<?php
require_once("AbstractMapper.php");
require_once("entidades/estado.php");
class EstadoDAL extends AbstractMapper{

    public function cargarEstado()
    {
        $this->db_host;
        $this->db_nombre;
        $this->db_usuarios;
        $this->db_contra;  

        $conexion = mysqli_connect($this->db_host, $this->db_usuarios, $this->db_contra, $this->db_nombre);

        if (mysqli_connect_errno()) {
            echo "Fallo al conectar con la BBDD";
            exit();
        }
    
        mysqli_select_db($conexion, $this->db_nombre) or die("No se encuentra la BBDD");
        mysqli_set_charset($conexion, "utf8");
    

        $consulta_estado = "SELECT id_estado, estado FROM estado";

        $resultado_estado = mysqli_query($conexion, $consulta_estado);

        if ($resultado_estado) {
            while ($fila = mysqli_fetch_assoc($resultado_estado)) {
                echo '<option value="' . $fila['id_estado'] . '">' . $fila['estado'] . '</option>';
            }

            mysqli_free_result($resultado_estado);
        } else {
            echo "Error en la consulta de niveles";
        }
        }
        public function getEstado()
        {
            $consulta = "SELECT * FROM estado";                         
            
            $this->setConsulta($consulta);
            $registros = $this->FindAll();   
            return $registros;
        } 

        public function doLoad($columna)
        {
            $estado = new Estado($columna["estado"],$columna["id_estado"]);


            return $estado;
        }

 }

$estadoDAL = new EstadoDAL();

?>