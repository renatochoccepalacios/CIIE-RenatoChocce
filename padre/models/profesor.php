<?php

class Profesor
{

        private string $nombreProf;
    
        private int $dni;

        private string $cuil;

        private int $idProf;

        private $foto;

        public function __construct(string $nombreProf, int $dni, string $cuil, int $idProf)
        { 
             $this->nombre_prof = $nombreProf;
             $this->dni = $dni;
             $this->cuil = $cuil;
             $this->idProf = $idProf;

        }



        /**
         * Get the value of nombre_prof
         */ 
        public function getNombreProf()
        {
                return $this->nombreProf;
        }

        /**
         * Set the value of nombre_prof
         *
         * @return  self
         */ 
        public function setNombreProf($nombreProf)
        {
                $this->nombreProf = $nombreProf;

                return $this;
        }

        /**
         * Get the value of dni
         */ 
        public function getDni()
        {
                return $this->dni;
        }

        /**
         * Set the value of dni
         *
         * @return  self
         */ 
        public function setDni($dni)
        {
                $this->dni = $dni;

                return $this;
        }

        /**
         * Get the value of cuil
         */ 
        public function getCuil()
        {
                return $this->cuil;
        }

        /**
         * Set the value of cuil
         *
         * @return  self
         */ 
        public function setCuil($cuil)
        {
                $this->cuil = $cuil;

                return $this;
        }

        /**
         * Get the value of idProf
         */ 
        public function getIdProf()
        {
                return $this->idProf;
        }

        /**
         * Set the value of idProf
         *
         * @return  self
         */ 
        public function setIdProf($idProf)
        {
                $this->idProf = $idProf;

                return $this;
        }

        /**
         * Get the value of foto
         */ 
        public function getFoto()
        {
                return $this->foto;
        }

        /**
         * Set the value of foto
         *
         * @return  self
         */ 
        public function setFoto($foto)
        {
                $this->foto = $foto;

                return $this;
        }
}






?>