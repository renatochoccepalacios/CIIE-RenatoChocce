<?php  
// filtrar cursos...
require_once('../../app/models/DAL/cursoDAL.php');

/* RENATO */
$cursoDAL = new CursoDAL();
$nivel = $_GET['nivel'];
$estado = $_GET['estado'];
$profesor = $_GET['profesor'];
$sede = $_GET['sede'];


$filtrarCursos = $cursoDAL->filtrarCursos($estado, $nivel, $sede, $profesor);
/* var_dump($filtrarCursos);
$respuesta = [];
foreach($filtrarCursos as $key => $value) {
//    var_dump($key, $value);
    
} */









echo json_encode(['status' => 'success', 'data' => $filtrarCursos ]);



?>