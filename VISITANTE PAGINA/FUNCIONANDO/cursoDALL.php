<?php
    require_once("entidades/curso.php");
    require_once("AbstractMapper.php");
class CursoDAL extends AbstractMapper
{
    public function insertCurso($curso)
    {                      

        $consulta = sprintf("INSERT INTO curso (nombre_curso, direccion, destinatarios, estado, nivel, profesor)
        VALUES ('%s', '%s', '%s', '%s', '%s', '%s')", $curso->getNombre_Curso(), $curso->getDireccion(), $curso->getDestinatarios()
        , $curso->getEstado(), $curso->getNivel(), $curso->getProfesor());

        $this->setConsulta($consulta);
        $id_curso = $this->Execute(); 
        return $id_curso;     
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

        $curso = new Curso($columna["nombre_curso"], $columna["direccion"], $columna["destinatarios"], $columna["estado"], $columna["nivel"], $columna["profesor"]);



        return $curso;
    }

}