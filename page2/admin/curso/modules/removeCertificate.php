<?php

function removeCertificate($dniAlumno, $idCurso)
{
    $cursoDAL = new CursoDAL();
    $usuarioDAL = new UsuarioDAL();

    $alumno = $usuarioDAL->getPerId($dniAlumno);
    $curso = $cursoDAL->getCursoPorId($idCurso);

    unlink(ADMIN_PATH . '/curso/certificados/certificados/' . $curso->getIdCurso() . "_" . $curso->getNombreCurso() . "/" . $alumno->getDni() . '.pdf');
}