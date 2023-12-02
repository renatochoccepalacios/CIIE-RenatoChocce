<?php
    require_once("entidades/cronograma.php");
    require_once("AbstractMapper.php");
class CronogramaDAL extends AbstractMapper
{

    public function insertCronograma($cronograma)
    
    {                      
         
        $consulta = sprintf("INSERT INTO cronograma (dia, horario, presencialidad, fecha, curso) 
        VALUES ('%s', '%s', '%s', '%s', '%s')",$cronograma->getDia(),$cronograma->getHorario(),
                                                $cronograma->getPresencialidad(), $cronograma->getFecha(), $cronograma->getId_Curso());
        echo $consulta;
        $this->setConsulta($consulta);
        $id_cronograma = $this->Execute(); 
        echo $id_cronograma;

        return $id_cronograma;    
        
            
    }


    public function getCronogramas()
    {
        $consulta = "SELECT * FROM cronograma";                         
        
        $this->setConsulta($consulta);
        $registros = $this->FindAll();   
        return $registros;
    } 

    public function doLoad($columna)
    {
        $cronograma = new Cronograma($columna["dia"],$columna["horario"],$columna["presencialidad"],$columna["fecha"],$columna["id_curso"]);


        return $cronograma;
    }

}