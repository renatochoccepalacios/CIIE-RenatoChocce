<?php
    require_once("../../../app/models/main.php");
    require_once("../../../app/models/cronograma.php");

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

    public function doLoad($columna)
    {
        $cronograma = new Cronograma($columna["dia"],$columna["horario"],$columna["presencialidad"],$columna["fecha"],$columna["idCurso"]);


        return $cronograma;
    }

}