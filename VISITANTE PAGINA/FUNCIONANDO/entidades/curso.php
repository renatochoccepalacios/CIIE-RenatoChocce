<?php
class Curso
{
    private string $nombre_curso;

    private string $direccion;

    private string $destinatarios;

    private string $profesor;

    private string $nivel;

    private string $estado;

    public function __construct(string $nombre_curso,string $direccion,string $destinatarios,string $profesor,string $nivel,string $estado)
    { 
         $this->nombre_curso = $nombre_curso;
         $this->direccion = $direccion;
         $this->destinatarios = $destinatarios;
         $this->profesor = $profesor;
         $this->nivel = $nivel;
         $this->estado = $estado;



    }

    

    /**
     * Get the value of nombre_curso
     */ 
    public function getNombre_curso()
    {
        return $this->nombre_curso;
    }

    /**
     * Set the value of nombre_curso
     *
     * @return  self
     */ 
    public function setNombre_curso($nombre_curso)
    {
        $this->nombre_curso = $nombre_curso;

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of destinatarios
     */ 
    public function getDestinatarios()
    {
        return $this->destinatarios;
    }

    /**
     * Set the value of destinatarios
     *
     * @return  self
     */ 
    public function setDestinatarios($destinatarios)
    {
        $this->destinatarios = $destinatarios;

        return $this;
    }

    /**
     * Get the value of profesor
     */ 
    public function getProfesor()
    {
        return $this->profesor;
    }

    /**
     * Set the value of profesor
     *
     * @return  self
     */ 
    public function setProfesor($profesor)
    {
        $this->profesor = $profesor;

        return $this;
    }

    /**
     * Get the value of nivel
     */ 
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set the value of nivel
     *
     * @return  self
     */ 
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}
