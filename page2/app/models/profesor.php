<?php

class Profesor{

        private string $nombre_prof;
    
        private int $dni;

        private string $cuil;

        private int $idProf;

        public function __construct(string $nombre_prof, int $dni, string $cuil, int $idProf)
        { 
             $this->nombre_prof = $nombre_prof;
             $this->dni = $dni;
             $this->cuil = $cuil;
             $this->idProf = $idProf;

        }





        /**
         * Get the value of nombre_prof
         */ 
        public function getNombre_prof()
        {
                return $this->nombre_prof;
        }

        /**
         * Set the value of nombre_prof
         *
         * @return  self
         */ 
        public function setNombre_prof($nombre_prof)
        {
                $this->nombre_prof = $nombre_prof;

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
}






?>