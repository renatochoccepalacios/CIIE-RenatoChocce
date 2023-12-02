<?php
abstract class AbstractMapper
{
    protected $db_host = "localhost";
    protected $db_nombre = "ciie";
    protected $db_usuarios = "root";
    protected $db_contra = "";

    /*PRUEBA N */
    protected $conexion;
    protected $consulta;

/*     public function __construct() {
        $conexion = mysqli_connect($this->db_host, $this->db_usuarios, $this->db_contra) or die("Error al conectar: ");
        mysqli_set_charset($conexion, 'utf8');

         $id = mysqli_insert_id($conexion);
    } */

    public function setConsulta($consulta)
    {
        $this->consulta = $consulta;
    }

    public function Execute()
    {
        $conexion = mysqli_connect($this->db_host, $this->db_usuarios, $this->db_contra) or die("Error al conectar: ");
        mysqli_set_charset($conexion, 'utf8');
        $baseDatos = mysqli_select_db($conexion, $this->db_nombre) or die("Error seleccionar la BD : ");
        
        mysqli_query($conexion, $this->consulta);
        $id = mysqli_insert_id($conexion);
        mysqli_close($conexion);
        return $id;

    }

    public function FindAll()
    {
        $registros = array();
        $conexion = mysqli_connect($this->db_host, $this->db_usuarios, $this->db_contra) or die("Error al conectar: ");
        mysqli_set_charset($conexion, 'utf8');
        $baseDatos = mysqli_select_db($conexion, $this->db_nombre) or die("Error seleccionar la BD : ");
        
        $resultado = mysqli_query($conexion, $this->consulta);

       

        $registros = $this->LoadAll($resultado);
        mysqli_close($conexion);
        return $registros;
    }

    public function Find()
    {
        $objeto = new stdClass();
        $conexion = mysqli_connect($this->db_host, $this->db_usuarios, $this->db_contra) or die("Error al conectar: ");
        mysqli_set_charset($conexion, 'utf8');
        $baseDatos = mysqli_select_db($conexion, $this->db_nombre) or die("Error seleccionar la BD : ");
        $resultado = mysqli_query($conexion, $this->consulta);
        while ($columna = mysqli_fetch_array($resultado)) {
            $objeto = $this->doLoad($columna);
        }
        mysqli_close($conexion);

        return $objeto;
    }



    private function LoadAll($resultado)
    {
        $registros = array();
        
        while ($columna = mysqli_fetch_array($resultado)) {
            $registros[] = $this->doLoad($columna);
        }

        return $registros;
    }

    abstract protected function doLoad($columna);
}

?>