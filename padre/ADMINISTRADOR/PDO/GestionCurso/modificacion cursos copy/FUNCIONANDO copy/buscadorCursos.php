<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Formulario buscador cursos</title>
</head>
<body>
 

  <!--<form name="form1"  action="cursoDALL.php"  method="get">
    <label for='cursos'>cursos</label>
        <input type='select'  name='cursos' id='cursos' list='lista-cursos'>
        <datalist id='lista-cursos'>

        </datalist> 
    <input type="submit" name="enviando" value="Buscar">
</form>
-->
<form name="form1" action="mostrarCurso.php" method="get">
    <label for='cursos'>Cursos</label>
    <input type='select' name='curso_id' id='curso_id' list='lista-cursos'>
    <datalist id='lista-cursos'>
        <?php require_once("cursoDALL.php");
        $cursoDAL->cargarCurso();
        ?>
    </datalist>
    <input type="submit" name="enviando" value="Buscar">
</form>



</body>
</html>
