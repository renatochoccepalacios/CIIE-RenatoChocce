<?php

require_once("../../models/DAL/cursoDAL.php");
require_once("../../models/DAL/profesorDAL.php");
require_once("../../models/DAL/cronogramaDAL.php");
require_once("../../models/DAL/main.php");

 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-curso"])) {

    


    $nombre_curso = $_POST["nombre_curso"];
    $direccion = $_POST["direccion"];
    $destinatarios = $_POST["destinatarios"];
    $estado = $_POST["estado"];
    $nivel = $_POST["nivel"];
    $profesorId = $_POST["profesor"]; 
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFinal = $_POST["fechaFinal"];

    $resolucion = $_POST["resolucion"];
    $dictamen = $_POST["dictamen"];
    $nroProyecto = $_POST["nroProyecto"];
    $puntaje = $_POST["puntaje"];
    $cargaHoraria = $_POST["cargaHoraria"];

    $curso = new Curso($nombre_curso, 
                        $direccion, 
                        $destinatarios, 
                        $estado, 
                        $nivel,                
                        $profesorId, 
                        $fechaInicio, 
                        $fechaFinal, 
                        $resolucion, 
                        $dictamen,                 
                        $nroProyecto, 
                        $puntaje, 
                        $cargaHoraria
    );


    $profesorDAL = new ProfesorDAL();
    $cursoDAL = new CursoDAL();

    $id_curso = $cursoDAL->insertCurso($curso);

        // Mostrar datos del curso
        echo "Datos del Curso Ingresado:";
        echo "<br>Nombre del Curso: " . $nombre_curso;
        echo "<br>Dirección: " . $direccion;
        echo "<br>Destinatarios: " . $destinatarios;
        echo "<br>Estado: " . $estado;
        echo "<br>Nivel: " . $nivel;
        echo "<br>Profesor: "; echo $profesorDAL->MostrarNombrePorId($profesorId);
        echo "<br>Fecha de Inicio: " . $fechaInicio;
        echo "<br>Fecha Final: " . $fechaFinal;
        echo "<br>Resolucion: " . $resolucion;
        echo "<br>Dictamen: " . $dictamen;
        echo "<br>Nro. del Proyecto: " . $nroProyecto;
        echo "<br>Puntaje: " . $puntaje;
        echo "<br>Carga Horaria: " . $cargaHoraria;
        echo "<br>ID del curso: " . $id_curso ."<br>";
     
        
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
