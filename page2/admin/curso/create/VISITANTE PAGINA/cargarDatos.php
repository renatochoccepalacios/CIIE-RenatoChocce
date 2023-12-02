<?php
require("datosconexion.php");

class ConexionBD
{
    private $conexion;

    public function __construct($host, $usuario, $contrasena, $nombre)
    {
        $this->conexion = new mysqli($host, $usuario, $contrasena, $nombre);
        if ($this->conexion->connect_errno) {
            echo "Fallo al conectar con la BBDD";
            exit();
        }
        $this->conexion->set_charset("utf8");
    }

    public function consultarNivel($id_registro)
    {
        $sql = "SELECT nivel FROM nivel WHERE id_nivel = $id_registro";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();  /* fetch_assoc() se utiliza para recuperar una fila de resultados de una consulta SQL en PHP y devolverla como un array asociativo*/
            $nivel = $fila["nivel"];
        } else {
            $nivel = "Nivel no encontrado";
            echo "No se encontraron resultados";
        }

        return $nivel;
    }


    public function ConsultarDestinatarios($id_destinatario)
    {

        $sql = "SELECT destinatarios FROM curso WHERE id_curso = $id_destinatario";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $destinatario = $fila["destinatarios"];
        } else {
            $destinatario = "destinatario no encontrado";
            echo "No se encontraron resultados";
        }
        return $destinatario;
    }

    public function ConsultarProfesores($id_profesor)
    {
        $sql = "SELECT nombre_prof FROM profesor WHERE id_prof = $id_profesor";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $profesor = $fila["nombre_prof"];
        } else {
            $profesor = "profesor no encontrado";
            echo "No se encontraron resultados";
        }
        return $profesor;
    }


    public function ConsultarCronograma($id_cronograma)
    {

        $sql = "SELECT dia, horario, presencialidad, fecha FROM cronograma WHERE id_cronograma = $id_cronograma";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $cronograma = $fila["dia"] . " " .  $fila["fecha"] . ", Hora: " . $fila["horario"] . ", "  .  $fila["presencialidad"];
        } else {
            $cronograma = "cronograma no encontrado";
            echo "No se encontraron resultados";
        }
        return $cronograma;
    }



    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}

// clase ConexionBD
$conexionBD = new ConexionBD($db_host, $db_usuarios, $db_contra, $db_nombre);


// nivel
$id_registro = 3;
$nivel = $conexionBD->consultarNivel($id_registro);

// destinatario
$id_destinatario = 1;
$destinatario = $conexionBD->ConsultarDestinatarios($id_destinatario);


$id_profesor = 3;
$profesor = $conexionBD->ConsultarProfesores($id_profesor);

$id_cronograma = 1;
$cronograma = $conexionBD->ConsultarCronograma($id_cronograma);


// Cierra la conexión a la base de datos
$conexionBD->cerrarConexion();
