<?php
require_once("AbstractMapper.php");
require_once("entidades/nivel.php");
class NivelDAL extends AbstractMapper{

    public function cargarNivel()
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
    

        $consulta_nivel = "SELECT id_nivel, nivel FROM nivel";

        $resultado_nivel = mysqli_query($conexion, $consulta_nivel);
        
        if ($resultado_nivel) {
            while ($fila = mysqli_fetch_assoc($resultado_nivel)) {
                echo '<option value="' . $fila['id_nivel'] . '">' . $fila['nivel'] . '</option>';
            }
        
            mysqli_free_result($resultado_nivel);
        } else {
            echo "Error en la consulta de niveles";
        }
    }


        public function getNivel()
        {
            $consulta = "SELECT * FROM niveles";                         
            
            $this->setConsulta($consulta);
            $registros = $this->FindAll();   
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