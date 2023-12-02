<?php

class Nivel{

        private string $nivel;
    
        private string $idNivel;

        public function __construct(string $nivel, string $idNivel)
        { 
             $this->nivel = $nivel;
             $this->idNivel = $idNivel;

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
         * Get the value of idNivel
         */ 
        public function getidNivel()
        {
                return $this->idNivel;
        }

        /**
         * Set the value of idNivel
         *
         * @return  self
         */ 
        public function setidNivel($idNivel)
        {
                $this->idNivel = $idNivel;

                return $this;
        }
}






?>