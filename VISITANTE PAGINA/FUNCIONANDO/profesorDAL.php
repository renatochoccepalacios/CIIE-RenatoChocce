<?php
    require_once("entidades/profesor.php");
    require_once("AbstractMapper.php");
class ProfesorDAL extends AbstractMapper
{
    public function cargarProfesor()
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
    

        $consulta_profesores = "SELECT id_prof, nombre_prof FROM profesor";

        $resultado_profesores = mysqli_query($conexion, $consulta_profesores);

        if ($resultado_profesores) {
            while ($fila = mysqli_fetch_assoc($resultado_profesores)) {
                echo '<option value="' . $fila['id_prof'] . '">' . $fila['nombre_prof'] . '</option>';
            }

            mysqli_free_result($resultado_profesores);
        } else {
            echo "Error en la consulta de profesores";
        }
    }

    public function getProfesor()
    {
        $consulta = "SELECT * FROM profesor";                         
        
        $this->setConsulta($consulta);
        $registros = $this->FindAll();   
        return $registros;
    } 

    public function doLoad($columna)
    {

        $profesor = new Profesor($columna["nombre_prof"], $columna["dni"], $columna["cuil"], $columna["id_prof"]);



        return $profesor;
    }

}
$profesorDAL = new ProfesorDAL();
?>