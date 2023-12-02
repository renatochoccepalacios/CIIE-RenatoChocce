
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>mostrar el curso</title>
<link rel='stylesheet' href='styles/estilo.css'>
</head>
<body>

<?php
require_once("../../../app/models/DAL/CursoDAL.php");
require_once("../../../app/models/curso.php");



if (isset($_GET['id'])) {
    $idCurso = $_GET['id'];
    $cursoDAL = new CursoDAL();
    $curso = $cursoDAL->getCursoPorId($idCurso);
    $nivel = new NivelDAL;
    echo $nivel->getIdNivel($idCurso);}
?>

<?php
if ($curso) {
?>
    <h1>Detalles del Curso</h1>
    <p>Nombre del Curso: <?php echo $curso->getNombreCurso(); ?></p>
    <p>Dirección: <?php echo $curso->getDireccion(); ?></p>
    <p>Destinatarios: <?php echo $curso->getDestinatarios(); ?></p>
    <p>Estado: <?php echo $curso->getEstado(); ?></p>
    <p>Nivel: <?php echo $nivel->getIdNivel($idCurso); ?></p>
    <p>Profesor: <?php echo $curso->getProfesor(); ?></p>
    <p>Fecha de Inicio: <?php echo $curso->getFechaInicio(); ?></p>
    <p>Fecha Final: <?php echo $curso->getFechaFinal(); ?></p>
    <p>Resolucion: <?php echo $curso->getResolucion(); ?></p>
    <p>dictamen: <?php echo $curso->getDictamen(); ?></p>
    <p>Nro. Proyecto: <?php echo $curso->getNroProyecto(); ?></p>
    <p>Puntaje: <?php echo $curso->getPuntaje(); ?></p>
    <p>Carga Horaria: <?php echo $curso->getCargaHoraria(); ?></p>

    <!-- Agregar un campo oculto para enviar el ID del curso a editarcurso -->
    <input type="hidden" name="idCurso" value="<?php echo $idCurso; ?>">
    <a href="editarCurso.php?idCurso=<?php echo $idCurso; ?>">Editar Curso</a>
<?php
} else {
    echo "Curso no encontrado";
}
?>




</body>
</html>



