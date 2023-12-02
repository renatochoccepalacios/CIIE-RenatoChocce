<?php

require_once('Usuario.php');

class ETR extends Usuario
{
    private string $imagen;

    public function __construct(string $dni, string $nombre, string $apellido, string $password, string $telefono, string $correo, string $tipoCuenta, string $estado, string $imagen)
    {
        parent::__construct($dni, $nombre, $apellido, $password, $correo, $telefono, $estado, $tipoCuenta);
        $this->imagen = $imagen;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }
}