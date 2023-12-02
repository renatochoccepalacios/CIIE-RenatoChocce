<?php

// incluyo directorios
include_once __DIR__ . '/../templates/header.php';
// include_once __DIR__ . '/modules/verifyCurso.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/CIIE/page/dirs.php';
require_once MODELS_PATH . '/DAL/cursoDAL.php'; // curso a mayuscula

$id = $_GET['id'];

$cursoDAL = new CursoDAL();
$curso = $cursoDAL->getCursoPorId($id);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Curso</title>
</head>

<body>

    <a href="../cursos/">volver a la lista de cursos</a>

    <h1>curso de
        <?= $curso->getNombreCurso() ?>
    </h1>

    <br>

    <?php
    if ($cursoDAL->checkStart($id) == 1) {
        echo "Aun no comienza el curso.....";
    } else {
        if ($cursoDAL->checkEnd($id) == 0) {
    ?>
            <a href="update/index.php?id=<?= $id ?>">modificar curso</a>
            <?php

            ?>
            <a href="condicion/index.php?id=<?= $id ?>">cerrar notas</a>
            <?php
            ?>
            <a href="certificados/index.php?id=<?= $id ?>">emitir certificados</a>
            <?php
        } else {
            if ($cursoDAL->checkAttendance($id) == 1) {
                echo "Ya se regítro el presentismo el dia de hoy";
            } else {
            ?>
                <a href="presentismo/?id=<?= $id ?>">registrar presentismo</a>
    <?php
            }
        }
    }
    ?>

    <a href="nomina/?id=<?= $id ?>">Exportar nómina</a>

    <?php

    include_once __DIR__ . '/../templates/footer.php';
