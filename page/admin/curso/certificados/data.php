<?php

include_once __DIR__ . '/../../../dirs.php';
require_once MODELS_PATH . '/DAL/cursoDAL.php';
require_once APP_PATH . '/modules/getError.php';
require_once APP_PATH . '/modules/setInfo.php';

$idCurso = $_GET['id'];

$cursoDAL = new CursoDAL();

$nombreCurso = $cursoDAL->getCursoPorId($idCurso)->getNombreCurso();
$alumnos = $cursoDAL->getApprovedStudents($idCurso);

?>


<section class="row-1">
    <a href="../?id=<?= $idCurso ?>">
        <span class="material-symbols-outlined">
            arrow_back_ios_new
        </span>Volver</a>
    <h1>
        <?= "Curso de $nombreCurso" ?>
    </h1>
    <p>Certificaciones</p>
</section>
<?php if (count($alumnos) > 0) { ?>
    <section class="row-2">
        <form action="validarCertificado.php?id=<?= $idCurso ?>" method="post">
            <input type="hidden" name="idCurso" value="<?= $idCurso ?>">
            <button type="submit" name="action" value="generateAll">Generar todos</button>
        </form>
    </section>

    <section class="row-3">
        <?php foreach ($alumnos as $alumno): ?>
            <form action="validarCertificado.php?id=<?= $idCurso ?>" method="post" style="display:flex; margin-bottom: 10px;">
                <div class="col-1">
                    <div class="cursante">
                        <?= $alumno->getDni() ?> -
                        <?= $alumno->getNombre() . ", " . $alumno->getApellido() ?>
                    </div>

                    <input type="hidden" name="dni" value="<?= $alumno->getDni() ?>">
                    <input type="hidden" name="idCurso" value="<?= $idCurso ?>">

                    <div class="info">
                        <?php
                        $data = $cursoDAL->verifyCertificateIssuance($alumno->getDni(), $idCurso);

                        if (isset($data) && $data[0] != 0) {
                            $veces = $cursoDAL->getQuantityCertificateIssues($alumno->getDni(), $idCurso); ?>

                            <span>
                                <?= "Generado el " . $cursoDAL->getDateCertificateIssuance($data[1]) . " (" .
                                    $veces . ($veces == 1 ? ' vez)' : ' veces)') ?>
                            </span>

                            <?php
                            $data = $cursoDAL->verifyCertificateWithdrawal($alumno->getDni(), $idCurso);

                            if (isset($data) && $data[0] != 0) { ?>
                                <span>
                                    <?= "Retirado el " . $cursoDAL->getDateCertificateWithdrawal($data[1]) ?>
                                </span>
                            </div>
                        </div>

                        <div class="col-2">
                            <button class="button" type="submit" name="action" value="generate">Generar</button>
                            <button class="button disabled" type="submit" name="action" value="retirar">Retirar</button>
                        </div>

                    <?php } else { ?>
                        </div>
                        </div>

                        <div class="col-2">
                            <button class="button" type="submit" name="action" value="generate">Generar</button>
                            <button class="button" type="submit" name="action" value="retirar">Retirar</button>
                        </div>

                        <?php
                            }
                        } else {
                            ?>
                    </div>
                    </div>
                    <div class="col-2"> <button class="button" type="submit" name="action" value="generate">Generar</button>
                        <button class="button disabled" type="submit" name="action" value="retirar">Retirar</button>
                    </div>
                <?php } ?>
            </form>

            <?php
        endforeach;
} else {
    ?>
        <h2 class="warning">No se encontraron alumnos aprobados.</h2>
    <?php } ?>