<?php

class Usuario
{
    private string $dni;
    private string $nombre;
    private string $apellido;
    private string $password;
    private string $telefono;
    private string $correo;
    private string $estado;
    private string $tipoCuenta;

    public function __construct(string $dni, string $nombre, string $apellido, string $password, string $telefono, string $correo, string $estado, string $tipoCuenta)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->estado = $estado;
        $this->tipoCuenta = $tipoCuenta;
    }

    public function setDni(string $dni): void
    {
        $this->dni = $dni;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setCorreo(string $correo): void
    {
        $this->correo = $correo;
    }

    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function setTipoCuenta(string $tipoCuenta): self
    {
        $this->tipoCuenta = $tipoCuenta;

        return $this;
    }
    
    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }



    public function getDni(): string
    {
        return $this->dni;
    }
    
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }
    
    public function getTipoCuenta(): string
    {
        return $this->tipoCuenta;
    }
    
    public function getImagen(): string
    {
        return $this->imagen;
    }
    
    
}
