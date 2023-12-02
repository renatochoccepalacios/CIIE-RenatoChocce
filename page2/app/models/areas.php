<?php

class Area{

        //private string $Area;
    
        private string $idArea;

        private string $idCurso;

        public function __construct(string $idArea, int $idCurso)
        { 
             $this->idArea = $idArea;
             $this->idCurso = $idCurso;

        }



        /**
         * Get the value of idArea
         */ 
        public function getIdArea()
        {
                return $this->idArea;
        }

        /**
         * Set the value of idArea
         *
         * @return  self
         */ 
        public function setIdArea($idArea)
        {
                $this->idArea = $idArea;

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