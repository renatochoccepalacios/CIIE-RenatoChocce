<?php
class Curso
{
    private string $nombreCurso;

    private string $direccion;

    private string $destinatarios;

    private string $profesor;

    private string $nivel;

    private string $estado;

    private string $fechaInicio;

    private string $fechaFinal;

    private int $idCurso;

    private string $resolucion;

    private string $dictamen;

    private string $nroProyecto;

    private int $puntaje;

    private string $cargaHoraria;

    public function __construct(string $nombreCurso,string $direccion,string $destinatarios,string $profesor,string $nivel,
                                string $estado, string $fechaInicio, string $fechaFinal, string $resolucion,
                                string $dictamen, string $nroProyecto, int $puntaje, string $cargaHoraria, int $idCurso = 0)
    { 
         $this->nombreCurso = $nombreCurso;
         $this->direccion = $direccion;
         $this->destinatarios = $destinatarios;
         $this->profesor = $profesor;
         $this->nivel = $nivel;
         $this->estado = $estado;
         $this->fechaInicio = $fechaInicio;
         $this->fechaFinal = $fechaFinal;
         $this->resolucion = $resolucion;
         $this->dictamen = $dictamen;
         $this->nroProyecto = $nroProyecto;
         $this->puntaje = $puntaje;
         $this->cargaHoraria = $cargaHoraria;
         $this->idCurso = $idCurso;

    }

    

    /**
     * Get the value of nombreCurso
     */ 
    public function getNombreCurso()
    {
        return $this->nombreCurso;
    }

    /**
     * Set the value of nombreCurso
     *
     * @return  self
     */ 
    public function setNombreCurso($nombreCurso)
    {
        $this->nombreCurso = $nombreCurso;

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

    /**
     * Get the value of fechaInicio
     */ 
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of fechaInicio
     *
     * @return  self
     */ 
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get the value of fechaFinal
     */ 
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    /**
     * Set the value of fechaFinal
     *
     * @return  self
     */ 
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get the value of idCurso
     */ 
    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     * Set the value of idCurso
     *
     * @return  self
     */ 
    public function setIdCurso($idCurso)
    {
        $this->idCurso = $idCurso;

        return $this;
    }

    /**
     * Get the value of resolucion
     */ 
    public function getResolucion()
    {
        return $this->resolucion;
    }

    /**
     * Set the value of resolucion
     *
     * @return  self
     */ 
    public function setResolucion($resolucion)
    {
        $this->resolucion = $resolucion;

        return $this;
    }

    /**
     * Get the value of dictamen
     */ 
    public function getDictamen()
    {
        return $this->dictamen;
    }

    /**
     * Set the value of dictamen
     *
     * @return  self
     */ 
    public function setDictamen($dictamen)
    {
        $this->dictamen = $dictamen;

        return $this;
    }

    /**
     * Get the value of nroProyecto
     */ 
    public function getNroProyecto()
    {
        return $this->nroProyecto;
    }

    /**
     * Set the value of nroProyecto
     *
     * @return  self
     */ 
    public function setNroProyecto($nroProyecto)
    {
        $this->nroProyecto = $nroProyecto;

        return $this;
    }

    /**
     * Get the value of puntaje
     */ 
    public function getPuntaje()
    {
        return $this->puntaje;
    }

    /**
     * Set the value of puntaje
     *
     * @return  self
     */ 
    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;

        return $this;
    }

    /**
     * Get the value of cargaHoraria
     */ 
    public function getCargaHoraria()
    {
        return $this->cargaHoraria;
    }

    /**
     * Set the value of cargaHoraria
     *
     * @return  self
     */ 
    public function setCargaHoraria($cargaHoraria)
    {
        $this->cargaHoraria = $cargaHoraria;

        return $this;
    }
}