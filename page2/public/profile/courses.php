<?php

session_start();
require_once '../../app/models/DAL/cursoDAL.php';

$limite = 5;

$cursoDAL = new CursoDAL();
$paginas = ceil($cursoDAL->countPages($_SESSION['user']) / $limite);

$paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;

$cursos = $cursoDAL->getCursosPerPage($paginaActual, $_SESSION['user']);

$array = [];

//! implementar aca
/*
public function doLoad2($data, $dni)
    {
        $obj = new stdClass();
        $obj->idCurso = $data['idCurso'];
        $obj->nombre = $data['nombre'];

        if ($this->verifyVigencia($data['idCurso']) == 1) {
            $obj->estado = "Aún no comienza.";
        } else {
            if ($this->verifyVigencia2($data['idCurso']) == 0) {
                $obj->estado = "Finalizado";

                $estado = $this->getCalificaciones($dni, $data['idCurso']);

                if ($estado == 'Aprobado') {
                    $obj->estado = $obj->estado . ' - Retiró certificado: ';

                    if ($fecha = $this->verifyRetiroCertificado($dni, $data['idCurso'])) {
                        $obj->estado = $obj->estado . "Si ($fecha)";
                    } else {
                        $obj->estado = $obj->estado . "No";
                    }
                }
            } else {
                $obj->estado = "En curso";
            }
        }

        return $obj;
    }
*/

foreach ($cursos as $curso):
    $array[] = $curso;

endforeach;

print_r(json_encode($array));