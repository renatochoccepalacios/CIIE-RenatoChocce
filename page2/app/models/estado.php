<?php

class Estado{

        private string $estado;
    
        private string $idEstado;

        public function __construct(string $estado, string $idEstado)
        { 
             $this->estado = $estado;
             $this->idEstado = $idEstado;

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
         * Get the value of idEstado
         */ 
        public function getidEstado()
        {
                return $this->idEstado;
        }

        /**
         * Set the value of idEstado
         *
         * @return  self
         */ 
        public function setidEstado($idEstado)
        {
                $this->idEstado = $idEstado;

                return $this;
        }
}






?>