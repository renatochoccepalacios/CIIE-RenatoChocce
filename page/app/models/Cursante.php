<?php

require_once('Usuario.php');

class Cursante extends Usuario
{
    private array $niveles;
    private array $areas;

    public function __construct(string $dni, string $nombre, string $apellido, string $password, string $telefono, string $correo, string $tipoCuenta, string $estado, array $niveles = [], array $areas = [])
    {
        parent::__construct($dni, $nombre, $apellido, $password, $correo, $telefono, $estado, $tipoCuenta);
        $this->niveles = $niveles;
        $this->areas = $areas;
    }

    public function setNiveles(array $niveles): void
    {
        $this->niveles = $niveles;
    }

    public function setAreas(array $areas): void
    {
        $this->areas = $areas;
    }

    public function getNiveles(): array
    {
        return $this->niveles;
    }

    public function getAreas(): array
    {
        return $this->areas;
    }
}
