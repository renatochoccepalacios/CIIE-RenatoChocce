<?php

include_once '../../app/templates/header.php';

require_once MODELS_PATH . "/DAL/UsuarioDAL.php";
require_once MODELS_PATH . "/DAL/cursoDAL.php";

// $magia = new Magia();
$cursoDAL = new CursoDAL();
$usuarioDAL = new UsuarioDAL();

$id = $_GET['id'];
$curso = $cursoDAL->getCursoPorId($id);

if ($cursoDAL->courseVacancies($curso->getIdCurso()) > 0) {
    //@todo generar error
    echo "quedan algunas vacantes.....";
} else {
    //@todo generar error
    echo "no hay mas vacantes..........";
}

if ($cursoDAL->checkStart($curso->getIdCurso()) == 1) {
    //@todo generar error
    echo "Aun no comienza el curso.....";
} else {
    if ($cursoDAL->checkEnd($curso->getIdCurso()) == 0) {
        //@todo generar error
        // inscripcion finalizada
        $activo = 1;
    } else {
        // en curso
        $activo = 1;
    }
}

?>

<h1>curso de
    <?= $curso->getNombreCurso() ?>
</h1>

<form action="validarInscripcion.php" method="post">
    <input type="hidden" name="dni" value="<?= $_SESSION['user'] ?>">
    <input type="hidden" name="idCurso" value="<?= $id ?>">
    <button type="submit" name="accion" value="inscribirse" <?=
        $cursoDAL->courseVacancies($id) > 0 ? (isset($activo) ? "disabled" : ($usuarioDAL->verificarAlumno($_SESSION['user'], $id) == 1 ? "disabled" : "")) : "disabled";
    ?>>inscribirse al curso</button>
</form>

<?php include APP_PATH . '/templates/footer.php';