<?php

require_once("AbstractMapper.php");

require_once("cursoDALL.php");

require_once("cronogramaDAL.php");


 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-curso"])) {

    


    $nombre_curso = $_POST["nombre_curso"];
    $direccion = $_POST["direccion"];
    $destinatarios = $_POST["destinatarios"];
    $estado = $_POST["estado"];
    $nivel = $_POST["nivel"];
    $profesor = $_POST["profesor"]; 

    $curso = new Curso($nombre_curso, $direccion, $destinatarios, $estado, $nivel, $profesor);

    $cursoDAL = new CursoDAL();

    $id_curso = $cursoDAL->insertCurso($curso);

    $eventosJSON = isset($_POST["eventosJSON"]) ? $_POST["eventosJSON"] : "";


    $eventos = json_decode($eventosJSON, true);

    if ($eventos === null && json_last_error() !== JSON_ERROR_NONE) {
    // Manejar error de decodificación JSON
    echo "Error al decodificar el JSON de eventos: " . json_last_error_msg();
    return;
    }else{
        print_r($eventos);
    }


    $cronogramaDAL = new CronogramaDAL();
 


    //$cronograma = new Cronograma("dia", "horario", "presencialidad", "fecha", 0);

    //$cronogramaDAL->insertCronograma($cronograma);
//     $cronograma = new Cronograma("lunes", "horario", "presencialidad", "fecha", 0);
 
   // $cronogramaDAL->insertCronograma($cronograma);

    if ($eventos && is_array($eventos)) {
        foreach ($eventos as $evento) {
                $dia =  $evento["dia"];
                $horario = $evento["horario"];
                $presencialidad = $evento["presencialidad"];
                $fecha = $evento["fecha"];

                $cronograma = new Cronograma($dia, $horario, $presencialidad, $fecha, $id_curso);

                $cronogramaDAL->insertCronograma($cronograma);


            echo "<br>".$dia."<br>".$horario."<br>".$presencialidad."<br>".$fecha."<br>".$id_curso;
    }  
    }
    
 }


    ?>