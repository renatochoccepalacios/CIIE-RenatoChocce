<?php

class Cronograma{

        private string $dia;
    
        private string $horario;
    
        private string $presencialidad;
    
        private string $fecha;

        private int $id_curso;
    

    
        public function __construct(string $dia, string $horario, string $presencialidad, string $fecha,int $id_curso)
        { 
             $this->dia = $dia;
             $this->horario = $horario;
             $this->presencialidad = $presencialidad;
             $this->fecha = $fecha;
             $this->id_curso = $id_curso;
        }


        /**
         * Get the value of dia
         */ 
        public function getDia()
        {
                return $this->dia;
        }

        /**
         * Set the value of dia
         *
         * @return  self
         */ 
        public function setDia($dia)
        {
                $this->dia = $dia;

                return $this;
        }

        /**
         * Get the value of horario
         */ 
        public function getHorario()
        {
                return $this->horario;
        }

        /**
         * Set the value of horario
         *
         * @return  self
         */ 
        public function setHorario($horario)
        {
                $this->horario = $horario;

                return $this;
        }

        /**
         * Get the value of presencialidad
         */ 
        public function getPresencialidad()
        {
                return $this->presencialidad;
        }

        /**
         * Set the value of presencialidad
         *
         * @return  self
         */ 
        public function setPresencialidad($presencialidad)
        {
                $this->presencialidad = $presencialidad;

                return $this;
        }

        /**
         * Get the value of fecha
         */ 
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */ 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        /**
         * Get the value of curso
         */ 
        public function getCurso()
        {
                return $this->curso;
        }

        /**
         * Set the value of curso
         *
         * @return  self
         */ 
        public function setCurso($curso)
        {
                $this->curso = $curso;

                return $this;
        }

        /**
         * Get the value of id_curso
         */ 
        public function getId_curso()
        {
                return $this->id_curso;
        }

        /**
         * Set the value of id_curso
         *
         * @return  self
         */ 
        public function setId_curso($id_curso)
        {
                $this->id_curso = $id_curso;

                return $this;
        }
}






?>