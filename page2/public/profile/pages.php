<?php

require_once '../../app/models/DAL/cursoDAL.php';
session_start();

$limite = 5;

$cursoDAL = new CursoDAL();
$paginas = ceil($cursoDAL->countPages($_SESSION['user']) / $limite);

echo $paginas;
