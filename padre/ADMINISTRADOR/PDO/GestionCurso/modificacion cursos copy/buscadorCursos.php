<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Formulario buscador cursos</title>
<link rel='stylesheet' href='styles/estilo.css'>

</head>
<body>

<form name="form1" action="mostrarCurso.php" method="get">
    <label for='idCurso'>Cursos</label>
    <input type='text' name='idCurso' id='idCurso' list='lista-cursos'> 

    <datalist id='lista-cursos'>
        <?php
        require_once("../../../../models/DAL/cursoDAL.php");
        $cursoDAL = new cursoDAL();
        $cursoDAL->cargarCurso();
        ?>
    </datalist>
    
    <input type="submit" name="enviando" value="Buscar">
</form>
</body>
</html>
