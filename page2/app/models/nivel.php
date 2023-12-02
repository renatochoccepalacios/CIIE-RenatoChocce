<?php

class Nivel{

        //private string $nivel;
    
        private string $idNivel;

        private string $idCurso;

        public function __construct(string $idNivel, int $idCurso)
        { 
             $this->idNivel = $idNivel;
             $this->idCurso = $idCurso;

        }



        /**
         * Get the value of idNivel
         */ 
        public function getIdNivel()
        {
                return $this->idNivel;
        }

        /**
         * Set the value of idNivel
         *
         * @return  self
         */ 
        public function setIdNivel($idNivel)
        {
                $this->idNivel = $idNivel;

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
}






?>