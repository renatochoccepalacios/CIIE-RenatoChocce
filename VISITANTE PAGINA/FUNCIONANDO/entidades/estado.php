<?php

class Estado{

        private string $estado;
    
        private string $id_estado;

        public function __construct(string $estado, string $id_estado)
        { 
             $this->estado = $estado;
             $this->id_estado = $id_estado;

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
         * Get the value of id_estado
         */ 
        public function getId_estado()
        {
                return $this->id_estado;
        }

        /**
         * Set the value of id_estado
         *
         * @return  self
         */ 
        public function setId_estado($id_estado)
        {
                $this->id_estado = $id_estado;

                return $this;
        }
}






?>