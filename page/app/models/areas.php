<?php

class Area
{

        private string $area;

        private int $idArea;

        // private string $idCurso;

        public function __construct(string $area, int $idArea = 0)
        {
                $this->idArea = $idArea;
                $this->area = $area;

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
         * Get the value of area
         *
         * @return string
         */
        public function getArea(): string
        {
                return $this->area;
        }

        /**
         * Set the value of area
         *
         * @param string $area
         *
         * @return self
         */
        public function setArea(string $area): void
        {
                $this->area = $area;
        }
}






?>