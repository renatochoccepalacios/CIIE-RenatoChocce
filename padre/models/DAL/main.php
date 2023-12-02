<?php

abstract class main
{ 
    protected $host;
    protected $user;
    protected $pass;
    protected $db;

    public function __construct()
    {
       // $config = parse_ini_file('C:\Apache24\htdocs\config\ciie.ini');
       $this->host = 'localhost';
        $this->db = 'ciie';
        $this->user = 'root';
        $this->pass = '';

    }

    /**
     * conexion a base de datos
     */
    public function conectar(): mysqli
    {
        $conexion = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or
            die("ERROR: no se pudo conectar a la base de datos.");

        return $conexion;
    }

    /**
     * ejecuta el valor pasado por parametro
     * $query es la query
     */
    public function execute($query)
    {
        $conexion = $this->conectar();

        mysqli_query($conexion, $query);
        $id = mysqli_insert_id($conexion);
        mysqli_close($conexion);
        return $id;
    }

    /**
     * trae todos los datos
     * $query es la query (por lo general, un select *)
     * 
     * return $registros el array con los datos cargados como obj
     */
    public function getAll($query)
    {
        $conexion = $this->conectar();
        $resultado = mysqli_query($conexion, $query);

        $registros = [];

        while ($columna = mysqli_fetch_array($resultado)) {
            $registros[] = $this->doLoad($columna);
        }

        return $registros;
    }


    /**
     * trae los datos (generalmente de una sola columna)
     * $query es la query
     * 
     * return $obj el obj con los datos ya cargados
     */
    public function getObj($query)
    {
        $conexion = $this->conectar();
        $resultado = mysqli_query($conexion, $query);

        $obj = $this->doLoad(mysqli_fetch_array($resultado));
        return $obj;
    }

    abstract protected function doLoad($data);
}
