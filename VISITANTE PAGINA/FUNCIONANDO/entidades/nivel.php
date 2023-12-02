<?php

class Nivel{

        private string $nivel;
    
        private string $id_nivel;

        public function __construct(string $nivel, string $id_nivel)
        { 
             $this->nivel = $nivel;
             $this->id_nivel = $id_nivel;

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
         * Get the value of id_nivel
         */ 
        public function getId_Nivel()
        {
                return $this->id_nivel;
        }

        /**
         * Set the value of id_nivel
         *
         * @return  self
         */ 
        public function setId_Nivel($id_nivel)
        {
                $this->id_nivel = $id_nivel;

                return $this;
        }
}






?>