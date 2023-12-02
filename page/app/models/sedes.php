<?php

class Sede
{


        private int $idSede;

        private string $sede;

        private string $direccion;

        private string $altura;

        private string $localidad;


        public function __construct(string $sede, string $direccion, string $altura, string $localidad, int $idSede = 0)
        {
                $this->sede = $sede;
                $this->direccion = $direccion;
                $this->altura = $altura;
                $this->localidad = $localidad;
                $this->idSede = $idSede;
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
         * Get the value of Sede
         */
        public function getSede()
        {
                return $this->sede;
        }

        /**
         * Set the value of Sede
         *
         * @return  self
         */
        public function setSede($sede)
        {
                $this->sede = $sede;

                return $this;
        }

        /**
         * Get the value of direccion
         */
        public function getDireccion()
        {
                return $this->direccion;
        }

        /**
         * Set the value of direccion
         *
         * @return  self
         */
        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;

                return $this;
        }

        /**
         * Get the value of altura
         */
        public function getAltura()
        {
                return $this->altura;
        }

        /**
         * Set the value of altura
         *
         * @return  self
         */
        public function setAltura($altura)
        {
                $this->altura = $altura;

                return $this;
        }

        /**
         * Get the value of localidad
         */
        public function getLocalidad()
        {
                return $this->localidad;
        }

        /**
         * Set the value of localidad
         *
         * @return  self
         */
        public function setLocalidad($localidad)
        {
                $this->localidad = $localidad;

                return $this;
        }
}
