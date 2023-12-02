<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/CIIE/page/dirs.php");

require_once(MODELS_PATH . "/main.php");
require_once(MODELS_PATH . "/Cursante.php");
require_once(MODELS_PATH . "/ETR.php");
require_once(MODELS_PATH . "/Admin.php");
require_once(MODELS_PATH . "/Usuario.php");

// require_once(MODELS_PATH . "/Magia.php");
require_once(MODELS_PATH . "/DAL/AreaDAL.php");
require_once(MODELS_PATH . "/DAL/NivelDAL.php");

//Hugo

/* require_once("../main.php");
require_once("../Usuario.php");
require_once("../ETR.php");
require_once("../Admin.php");
require_once("../Cursante.php"); */

class UsuarioDAL extends main
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Verifica si el existe un usuario que coincida con los registros ingresados en la base de datos.
     * $dni es el dni ingresado.
     * $password es la contraseña ingresada.
     * El return devuelve 0 o 1 dependiendo si es falso o verdadero.
     */
    public function login($dni, $password)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT idTipoCuenta FROM usuarios WHERE dni='%s' AND password='%s' AND estado='1'",
            $dni,
            $password
        );

        $resp = mysqli_query($conexion, $query);

        $filas = mysqli_num_rows($resp);

        if ($filas == 1) {
            $resp = mysqli_fetch_array($resp);
            $resp = $resp['idTipoCuenta'];
        } else {
            $resp = 0;
        }

        return $resp;
    }
    /* RENATO */
    public function mostrarImagenEtr($dniProfesor) {
        $conexion = $this->conectar(); 

        $query = "SELECT imagen FROM usuarios WHERE dni='$dniProfesor'";

        $resultado = mysqli_query($conexion, $query);

        
        if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);
            $imagenProfesor = $fila['imagen'];
            mysqli_free_result($resultado);
            mysqli_close($conexion);
            return $imagenProfesor;
        } else {
            echo "Error en la query de etr";
            mysqli_close($conexion);
            return null;
        }
        
        mysqli_close($conexion); 
    }
    /* if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo '<img src="' . $fila['imagen2'] . '">';
        }

        mysqli_free_result($resultado);
    } else {
        echo "Error en la query de etr";
    } */
    
    public function insert($usuario)
    {
        if ($usuario->getTipoCuenta() == 1) {
            $query = sprintf(
                "INSERT INTO usuarios(DNI,nombre,apellido,password,telefono,correo,estado,idTipoCuenta)
            VALUES ('%s','%s','%s','%s','%s','%s','%s','%s', NULL)",
                $usuario->getDni(),
                $usuario->getNombre(),
                $usuario->getApellido(),
                $usuario->getPassword(),
                $usuario->getTelefono(),
                $usuario->getCorreo(),
                $usuario->getEstado(),
                $usuario->getTipoCuenta()
            );
        } else {
            $query = sprintf(
                "INSERT INTO usuarios(DNI,nombre,apellido,password,telefono,correo,estado,idTipoCuenta, imagen)
            VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
                $usuario->getDni(),
                $usuario->getNombre(),
                $usuario->getApellido(),
                $usuario->getPassword(),
                $usuario->getTelefono(),
                $usuario->getCorreo(),
                $usuario->getEstado(),
                $usuario->getTipoCuenta(),
                $usuario->getImagen()
            );
        }

        return $this->execute($query);
    }

    public function update($usuario)
    {
        $query = sprintf(
            "UPDATE usuarios SET nombre='%s', apellido='%s', telefono='%s', correo='%s', estado='%s' WHERE dni='%s'",
            $usuario->getNombre(),
            $usuario->getApellido(),
            $usuario->getTelefono(),
            $usuario->getCorreo(),
            $usuario->getEstado(),
            $usuario->getDni()
        );

        $this->execute($query);

    }

    public function getData()
    {
        $query = "SELECT * FROM usuarios";

        $data = $this->getAll($query);
        return $data;
    }

    public function getPerId($dni)
    {
        $query = sprintf(
            "SELECT * FROM usuarios WHERE dni='%s'",
            $dni
        );

        $data = $this->getObj($query);
        return $data;
    }

    public function doLoad($col)
    {
        $estado = $col['estado'] == 1 ? 'Habilitado' : 'Inhabilitado';

        switch ($col['idTipoCuenta']) {
            case 1:
                $nivelDAL = new NivelDAL();
                $areaDAL = new AreaDAL();

                $niveles = $nivelDAL->getPerDni($col['dni']);
                $areas = $areaDAL->getPerDni($col['dni']);

                $user = new Cursante($col['dni'], $col['nombre'], $col['apellido'], $col['password'], $col['correo'], $col['telefono'], 'Cursante', $estado, $niveles, $areas);
                break;

            case 2:
                $user = new ETR($col['dni'], $col['nombre'], $col['apellido'], $col['password'], $col['correo'], $col['telefono'], 'ETR', $estado, "imagen");
                break;

            case 3:
                $user = new Admin($col['dni'], $col['nombre'], $col['apellido'], $col['password'], $col['correo'], $col['telefono'], 'Admin', $estado, "imagen");
                break;

            default:
                exit("Hubo un error inesperado.");
        }

        return $user;
    }

    
    /**
     * Desactivar un usuario.
     * $dni es el identificador de cursante.
     */

    public function disableUser($dni)
    {
        $query = sprintf(
            "UPDATE usuarios SET Estado = 2 WHERE dni = '%s'",
            $dni
        );

        $this->execute($query);
    }

    /**
     * Activar un usuario.
     * $dni es el identificador de cursante.
     */
    public function enableUser($dni)
    {
        $query = sprintf(
            "UPDATE usuarios SET Estado = 1 WHERE dni = '%s'",
            $dni
        );

        $this->execute($query);
    }

    /**
     * Agregar nivel a un usuario.
     * $dni es el identificador del usuario.
     * $nivel es el nivel a agregar.
     */
    public function addNivel($dni, $idNivel)
    {
        $query = sprintf(
            "INSERT INTO cursantenivel VALUES('%s','%s')",
            $dni,
            $idNivel
        );
        $this->execute($query);
    }

    /**
     * Agregar área a un usuario.
     * $dni es el identificador del usuario.
     * $area es el area a agregar.
     */
    public function addArea($dni, $idArea)
    {
        $query = sprintf(
            "INSERT INTO cursantearea VALUES('%s', '%s')",
            $dni,
            $idArea
        );

        $this->execute($query);
    }

    public function deleteAreas($dni)
    {
        $query = sprintf(
            "DELETE FROM cursantearea WHERE dni = '%s' ",
            $dni
        );

        $this->execute($query);
    }

    /**
     * Agregar áreas al cursante.
     * $dni es el identificador de cursante.
     * $areas es un array en el que están todas las áreas seleccionadas.
     */
    public function updateAreas($dni, array $areas)
    {
        // debe de eliminar todos los niveles
        // existentes y volver a cargar los ingresados
        foreach ($areas as $area) {
            $query = sprintf(
                "INSERT INTO cursantearea VALUES('%s', '%s')",
                $dni,
                $area->getId(),
            );

            $this->execute($query);
        }
    }

    public function deleteNiveles($dni)
    {
        $query = sprintf(
            "DELETE FROM cursantenivel WHERE dni = '%s' ",
            $dni
        );

        $this->execute($query);
    }

    /**
     * Agregar niveles al cursante.
     * $dni es el identificador de cursante.
     * $niveles es un array en el que están todos los niveles seleccionados.
     */
    public function updateNiveles($dni, array $niveles)
    {
        // debe de eliminar todos los niveles
        // existentes y volver a cargar los ingresados

        foreach ($niveles as $nivel) {
            $query = sprintf(

                "INSERT INTO cursantenivel VALUES('%s','%s')",
                $dni,
                $nivel->getId()
            );

            $this->execute($query);
        }
    }

    /**
     * Verifica si el dni ingresado existe en la base de datos.
     * $dni es el dni ingresado.
     * El return devuelve 0 o 1 dependiendo si es falso o verdadero.
     */
    public function validarDni($dni)
    {

        $query = sprintf(
            "SELECT * from usuarios where dni = '%s'",
            $dni
        );

        $filas = $this->count($query);

        // 1 es que existen usuarios (true)
        // 0 es que no (false).
        return $filas > 0 ? 1 : 0;
    }

    /**
     * Verifica si el mail ingresado existe en la base de datos.
     * $mail es el mail ingresado.
     * El return devuelve 0 o 1 dependiendo si es falso o verdadero.
     */
    public function verifyMail($mail)
    {
        $query = sprintf(
            "SELECT * FROM usuarios WHERE correo = '%s'",
            $mail
        );

        $filas = $this->count($query);

        return $filas > 0 ? 1 : 0;
    }

    /**
     * Devuelve la cantidad de filas que retorna la consulta enviada.
     * $query es la consulta.
     * $filas es la cantidad de filas.
     */
    public function count($query)
    {
        $conexion = $this->conectar();

        $resp = mysqli_query($conexion, $query);
        $filas = mysqli_num_rows($resp);

        return $filas;
    }

    /**
     * Incribir un cursante a un curso utilizando el dni propio del cursante 
     * y el id del curso en donde quiere inscribirse 
     */
    public function inscripcionCursante($dniAlumno, $idCurso)
    {
        $query = sprintf(
            "INSERT INTO cursoalumnos VALUES( '%s', %s )",
            $dniAlumno,
            $idCurso
        );
        $this->execute($query);
    }

    // verificar si el alumno ya esta inscripto en el curso
    public function verificarAlumno($dniAlumno, $idCurso)
    {
        $query = sprintf(
            "SELECT * FROM cursoalumnos WHERE dnialumno = %s AND idcurso = %s;",
            $dniAlumno,
            $idCurso
        );

        $filas = $this->count($query);
        return $filas > 0 ? 1 : 0;
    }

    // hacer funcion
    public function changeImage($usuario, $imagen)
    {
        return 0;
    }

    public function getPerMail($mail)
    {
        $conexion = $this->conectar();

        $query = sprintf(
            "SELECT * FROM usuarios WHERE correo = '%s'",
            $mail
        );

        $resp = mysqli_query($conexion, $query);
        $resp = mysqli_fetch_array($resp);

        return isset($resp['dni']) ? $resp['dni'] : null;
    }

    public function getResetInfo($resetID)
    {
        $conexion = $this->conectar();

        $query = sprintf("SELECT * FROM passwordReset WHERE resetID = '%s'", $resetID);
        $resp = mysqli_query($conexion, $query);

        $resp = mysqli_fetch_array($resp);
        return $resp;
    }

    public function generatePin($dniUsuario)
    {
        $uniqID = uniqid();
        $pin = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);

        $query = sprintf(
            "INSERT INTO passwordReset (resetId, pin, expirationTime, dniUsuario)
            VALUES ('%s', %s, '%s', '%s')",
            $uniqID,
            $pin,
            date('Y-m-d H:i:s', strtotime('+20 minutes')),
            $dniUsuario
        );

        $this->execute($query);
        return [$uniqID, $pin];
    }

    public function validatePin($resetID, $pin)
    {
        $conexion = $this->conectar();

        $query = sprintf("SELECT * FROM passwordReset WHERE resetId = '%s'", $resetID);
        $resp = mysqli_query($conexion, $query);

        $resp = mysqli_fetch_array($resp);

        if (isset($resp['pin']) && $resp['pin'] == $pin) {
            if (strtotime($resp['expirationTime']) > time()) {
                return true;
                // DELETE FROM passwordReset WHERE resetId = '%s'
            } else {
                return false;
            }
        }

        return false;
    }

    public function changePassword($newPassword, $dni)
    {
        $query = sprintf(
            "UPDATE usuarios SET password = '%s' WHERE dni = '%s'",
            $newPassword,
            $dni
        );

        $this->execute($query);
    }

    // GABRIEL
    public function mostrarProfesores()
    {

        $conexion = $this->conectar();

        $query = "SELECT dni, nombre FROM usuarios WHERE idTipoCuenta = 2";

        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo '<option value="' . $fila['dni'] . '">' . $fila['nombre'] . '</option>';
            }

            mysqli_free_result($resultado);
        } else {
            echo "Error en la query de niveles";
        }

        mysqli_close($conexion);
    }

    // GABRIEL
    public function MostrarNombrePorDni($dni)
    {
        $conexion = $this->conectar();

        $query = "SELECT nombre FROM usuarios WHERE dni = $dni";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($nombre = mysqli_fetch_assoc($resultado)) {
                echo $nombre['nombre'];
            }
        } else {
            echo "Error en la query de profesores: " . mysqli_error($conexion);
        }
    }

    // RENATO
    public function MostrarApellidoPorDni($dni)
    {
        $conexion = $this->conectar();

        $query = "SELECT apellido FROM usuarios WHERE dni = $dni";
        $this->Execute($query);
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($nombre = mysqli_fetch_assoc($resultado)) {
                echo $nombre['apellido'];
            }
        } else {
            echo "Error en la query de profesores: " . mysqli_error($conexion);
        }
    }




//-----------------------------------------------------------------------------------------

    //HUGO

    public function mostrarUsuarios()
    {

        $conexion = $this->conectar();

        $query = "SELECT dni, nombre FROM usuarios";

        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo '<option value="' . $fila['dni'] . '">' . $fila['nombre'] . '</option>';
            }

            mysqli_free_result($resultado);
        } else {
            echo "Error en la query de niveles";
        }

        mysqli_close($conexion);
    }


    public function obtenerTipo($dni)
    {
        $query = sprintf(
            "SELECT idTipoCuenta FROM usuarios WHERE dni='%s'",
            $dni
        );

        $this->execute($query);

    }

    
    public function updateTipoCuenta($tipoCuenta, $dni)
    {
        $query = sprintf(
            "UPDATE usuarios SET idTipoCuenta='%s' WHERE dni='%s'",
            $tipoCuenta,
            $dni
        );

        $this->execute($query);
    }


//prueba

    public function filtrarUser($estado, $tipoCuenta)
    {
        $conexion = $this->conectar();
        $where = '';
        $condiciones = [];

        if (!empty($estado)) {
            $condiciones[] = 'usuarios.estado = ' . $estado;
        }

        if (!empty($tipoCuenta)) {
            $condiciones[] = 'usuarios.idTipoCuenta = ' . $tipoCuenta;
        }

        if (!empty($condiciones)) {
            $where = 'WHERE ' . implode(' AND ', $condiciones);
        }

        $query = sprintf("SELECT usuarios.*, usuarios.estado AS estado, tiposcuenta.tipoCuenta AS tipoCuenta
            FROM `usuarios` 
            INNER JOIN tiposcuenta ON usuarios.idTipoCuenta = tiposCuenta.idTipoCuenta
            $where
            GROUP BY usuarios.dni");

        $usuario = mysqli_query($conexion, $query);
        $usuario = mysqli_fetch_all($usuario, MYSQLI_ASSOC);

        return $usuario; 

    }


//-------------------------------------------------------

    public function mostrarUsuariosDos()
    {

        $conexion = $this->conectar();

        $query = "SELECT idTipoCuenta, tipoCuenta FROM tiposcuenta";

        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo '<option value="' . $fila['idTipoCuenta'] . '">' . $fila['tipoCuenta'] . '</option>';
            }

            mysqli_free_result($resultado);
        } else {
            echo "Error en la query de niveles";
        }

        mysqli_close($conexion);
    }


    public function buscarUser($busqueda)
    {
        $query ="SELECT * FROM usuarios WHERE dni LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR 
                                            apellido LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR 
                                            correo  LIKE '%$busqueda%'";
        // $curso->getNombreCurso(),;
        $this->Execute($query);
        $registros = $this->getAll($query);
        return $registros;
    }

}

$UsuarioDAL = new UsuarioDAL();
?>