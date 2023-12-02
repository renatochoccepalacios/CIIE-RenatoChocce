<.?php use CursoDAL as GlobalCursoDAL; require_once("entidades/curso.php"); require_once("AbstractMapper.php"); class CursoDAL extends AbstractMapper { public function insertCurso($curso) { $consulta=sprintf("INSERT INTO curso (nombre_curso, direccion, destinatarios, estado, nivel, profesor, fechaInicio, fechaFinal) VALUES ('%s', '%s' , '%s' , '%s' , '%s' , '%s' ,'%s', '%s' )", $curso->getNombre_Curso(), $curso->getDireccion(), $curso->getDestinatarios()
    , $curso->getEstado(), $curso->getNivel(), $curso->getProfesor(), $curso->getFechaInicio(), $curso->getFechaFinal());

    $this->setConsulta($consulta);
    $id_curso = $this->Execute();
    return $id_curso;
    }

    public function modificarCurso($curso)
    {
    $consulta = sprintf("UPDATE curso SET nombre_curso = '%s', direccion = '%s', destinatarios = '%s', estado = '%s', nivel = '%s', profesor = '%s', fechaInicio = '%s', fechaFinal = '%s' WHERE id_curso = %d",
    $curso->getNombre_Curso(),$curso->getDireccion(),$curso->getDestinatarios(),$curso->getEstado(),
    $curso->getNivel(),$curso->getProfesor(),$curso->getFechaInicio(),$curso->getFechaFinal(),$curso->getIdCurso()
    );


    $this->setConsulta($consulta);
    $this->Execute();
    }

    public function cargarCurso(){

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


    $consulta_cursos = "SELECT id_curso, nombre_curso FROM curso";

    $resultado_cursos = mysqli_query($conexion, $consulta_cursos);

    if ($resultado_cursos){
    while ($fila = mysqli_fetch_assoc($resultado_cursos)) {
    echo '<option value="' . $fila['id_curso'] . '">' . $fila['nombre_curso'] . '</option>';
    }

    mysqli_free_result($resultado_cursos);
    } else {
    echo "Error en la consulta de cursos";
    }

    }


    public function getCursoPorId($id_curso)
    {
    $consulta = sprintf("SELECT * FROM curso WHERE id_curso = %d", $id_curso);
    $this->setConsulta($consulta);
    $curso = $this->Find();

    return $curso;
    }



    public function getCursos()
    {
    $consulta = "SELECT * FROM curso";

    $this->setConsulta($consulta);
    $registros = $this->FindAll();
    return $registros;
    }


    public function doLoad($columna)
    {

    $curso = new Curso($columna["nombre_curso"], $columna["direccion"], $columna["destinatarios"],
    $columna["estado"], $columna["nivel"], $columna["profesor"], $columna["fechaInicio"], $columna["fechaFinal"]);



    return $curso;
    }

    }
    $cursoDAL = new CursoDAL();

    ?>