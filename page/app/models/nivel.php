<?php

class Nivel{

        //private string $nivel;
    
        private int $idNivel;

        private string $nivel;

        public function __construct(string $nivel, int $idNivel = 0)
        { 
             $this->nivel = $nivel;
             $this->idNivel = $idNivel;


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
}






?>