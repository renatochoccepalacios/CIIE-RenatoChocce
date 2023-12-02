<?php

class Sede{

    
        private string $idSede;

        private string $idCurso;

        public function __construct(string $idSede, int $idCurso)
        { 
             $this->idSede = $idSede;
             $this->idCurso = $idCurso;

        }



        /**
         * Get the value of idSede
         */ 
        public function getIdSede()
        {
                return $this->idSede;
        }

        /**
         * Set the value of idSede
         *
         * @return  self
         */ 
        public function setIdSede($idSede)
        {
                $this->idSede = $idSede;

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