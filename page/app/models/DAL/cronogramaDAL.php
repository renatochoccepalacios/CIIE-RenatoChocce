<?php
    require_once(MODELS_PATH . '/main.php');
    require_once(MODELS_PATH . '/cronograma.php');

class CronogramaDAL extends main
{

    public function insertCronograma($cronograma)
    
    {                      
         
        $query = sprintf("INSERT INTO cursocronograma (dia, horario, presencialidad, fecha, idcurso) 
        VALUES ('%s', '%s', '%s', '%s', '%s')",$cronograma->getDia(),$cronograma->getHorario(),
                                                $cronograma->getPresencialidad(), $cronograma->getFecha(), $cronograma->getIdCurso());
        echo $query;

        $idCronograma = $this->Execute($query); 
        echo $idCronograma;
        return $idCronograma;    
        
            
    }
   
//CELE
    public function eliminarCronogramaPorid($idCurso)
    {
        // FunciOn que elimina todos los registros asociados a un curso en la tabla cronograma
        $query = sprintf(
            "DELETE FROM cursocronograma WHERE idcurso = %d",
            $idCurso
        );

        $this->Execute($query);
        return true;
    }


//CELKE
    public function eliminarCronograma($idCronograma)
    {
        $query = sprintf("DELETE FROM cursocronograma WHERE idCronograma = %d", $idCronograma);
        $this->Execute($query);
        
        return true; 
    }
    

    public function eliminarCronogramaPorCurso($idCurso)
    {
        // function que elimina los registros en la tabla cronograma
        $query = sprintf(
            "DELETE FROM cronograma WHERE curso = %d",
            $idCurso
        );

        $this->Execute($query);
        return true; // Devuelve verdadero si la eliminación se realizó con éxito
    }



    public function getCronogramas()
    {
        $query = "SELECT * FROM cronograma";                         
        
        $this->Execute($query);
        $registros = $this->getAll($query);   
        return $registros;
    } 
 
    public function getCronogramaPorCurso($idCurso)
{
    $conexion = $this->conectar();

    $query = sprintf("SELECT * FROM cursocronograma WHERE idcurso IN (SELECT idcurso FROM cursos WHERE idcurso = %d)", $idCurso);
    $this->Execute($query);

    $resultado = mysqli_query($conexion, $query);

    $cronograma = array();  // Array para almacenar los resultados

    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            // Agregar cada fila al array
            $cronograma[] = array(
                'dia'           => $row['dia'],
                'horario'       => $row['horario'],
                'presencialidad' => $row['presencialidad'],
                'fecha'         => $row['fecha']
            );
        } 
    }else {
    echo "Error en la query de niveles: " . mysqli_error($conexion);
    }
    
    // Devolver el array con los resultados
    return $cronograma;
}

/* cele 
 public function eliminarCronogramaid($idCurso)
    {
        // Función que elimina un registro específico en la tabla cronograma
        $idCronogramaAEliminar = 22; // Cambiar el ID según tus necesidades

        $query = sprintf(
            "DELETE FROM cursocronograma WHERE idcurso = %d AND idCronograma = %d",
            $idCurso,
            $idCronogramaAEliminar
        );

        $this->Execute($query);
        return true; // Devuelve verdadero si la eliminación se realizó con éxito
    }*/
/* public function getIdCronogramasPorCurso($idCurso)
{
    $conexion = $this->conectar();

    $query = sprintf("SELECT idCronograma FROM cursocronograma WHERE idCurso = %d", $idCurso);
    $this->Execute($query);

    $resultado = mysqli_query($conexion, $query);

    $idCronogramas = array();  // Array para almacenar los resultados

    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            // Agregar cada idCronograma al array
            $idCronogramas[] = $row['idCronograma'];
        }
    } else {
        echo "Error en la query: " . mysqli_error($conexion);
    }

    // Devolver el array con los idCronogramas
    return $idCronogramas;
} */

    
    public function doLoad($columna)
    {
        $cronograma = new Cronograma($columna["dia"],$columna["horario"],$columna["presencialidad"],$columna["fecha"],$columna["idcurso"]);


        return $cronograma;
    }

}