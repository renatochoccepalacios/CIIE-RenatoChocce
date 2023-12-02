<?php

// include '../../templates/header.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/SuperCIIE/page/dirs.php';
require_once MODELS_PATH . '/DAL/cursoDAL.php'; // curso a mayuscula

require_once(MODELS_PATH . "\DAL\UsuarioDAL.php");
// require_once(MODELS_PATH . "\Magia.php");

$idCurso = $_GET['id'];
$dni = $_SESSION['user'];

$cursoDAL = new CursoDAL();

// $magia = new Magia();
$alumnos = $cursoDAL->getApprovedStudents($idCurso);

?>

<a href="../?id=<?= $idCurso ?>">volver</a>
<h1>Alumnos aprobados:</h1>

<?php
if (count($alumnos) > 0) {
    // if ($cursoDAL->verifyAllCertifies($idCurso) == count($alumnos)) {
    // echo "<h3>Todos los certificados fueron generados.</h3>";
    // } else {
    ?>

    <form action="validarCertificado.php" method="post">
        <input type="hidden" name="idCurso" value="<?= $idCurso ?>">
        <button type="submit" name="action" value="generateAll">Generar todos</button>
    </form>

    <?php

    // }
    foreach ($alumnos as $alumno):
        ?>

        <form action="validarCertificado.php" method="post" style="display:flex; margin-bottom: 10px;">
            <div>
                <?= $alumno->getDni() ?> -
                <?= $alumno->getNombre() . " " . $alumno->getApellido() ?>&nbsp;
            </div>
            <input type="hidden" name="dni" value="<?= $alumno->getDni() ?>">
            <input type="hidden" name="idCurso" value="<?= $idCurso ?>">


            <?php

                $data = $cursoDAL->verifyCertificateIssuance($alumno->getDni(), $idCurso);

            if (isset($data) && $data[0] != 0 ) {
                echo "- Este certificado fue generado el " . $cursoDAL->getDateCertificateIssuance($data[1]) . " (" . $cursoDAL->getQuantityCertificateIssues($alumno->getDni(), $idCurso);

                $veces = $cursoDAL->getQuantityCertificateIssues($alumno->getDni(), $idCurso);
                echo $veces == 1 ? " vez)&nbsp" : " veces)&nbsp";


                $data = $cursoDAL->verifyCertificateWithdrawal($alumno->getDni(), $idCurso);

                if (isset($data) && $data[0] != 0) {
                    echo "- Este certificado fue retirado el " . $cursoDAL->getDateCertificateWithdrawal($data[1]) . "&nbsp;";
                    ?>
                    <button type="submit" name="action" value="generate">Volver a generar certificado</button>&nbsp;
                    <?php
                } else {

                    ?>
                    <button type="submit" name="action" value="generate">Volver a generar certificado</button>&nbsp;
                    <button type="submit" name="action" value="retirar">Retirar certificado</button>

                    <?php





                }
            } else {
                ?>
                <button type="submit" name="action" value="generate">Generar certificado</button>
                <?php
            }
            ?>
        </form>

        <?php
    endforeach;
} else {
    ?>
    <h2>NO SE ENCONTRARON ALUMNOS APROBADOS</h2>
    <?php
}
?>
</body>

</html>