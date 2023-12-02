<?php

require_once("../../../app/models/DAL/cursoDAL.php");
require_once("../../../app/models/DAL/UsuarioDAL.php");
require_once("../../../app/models/DAL/cronogramaDAL.php");
require_once("../../../app/models/DAL/nivelDAL.php");
require_once("../../../app/models/DAL/areaDAL.php");
require_once("../../../app/models/DAL/SedeDAL.php");



require_once("../../../app/models/main.php");

 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-curso"])) {

    


    $nombreCurso = $_POST["nombreCurso"];

    $sede = $_POST["sede"];

    $destinatarios = $_POST["destinatarios"];
    $estado = $_POST["estados"];
    $nivel = $_POST["nivel"];
    $area = $_POST["area"];


    $dniProf= $_POST["profesor"]; 

    $fechaInicio = $_POST["fechaInicio"];
    $fechaFinal = $_POST["fechaFinal"];

    $resolucion = $_POST["resolucion"];
    $dictamen = $_POST["dictamen"];
    $nroProyecto = $_POST["nroProyecto"];
    $puntaje = $_POST["puntaje"];
    $cargaHoraria = $_POST["cargaHoraria"];

    $curso = new Curso($nombreCurso, 
                        $destinatarios, 
                        $estado,               
                        $dniProf, 
                        $fechaInicio, 
                        $fechaFinal, 
                        $resolucion, 
                        $dictamen,                 
                        $nroProyecto, 
                        $puntaje, 
                        $cargaHoraria
    );


    $UsuarioDAL = new UsuarioDAL();
    $cursoDAL = new CursoDAL();

    $idCurso = $cursoDAL->insertCurso($curso);

        // Mostrar datos del curso
        echo "Datos del Curso Ingresado:";
        echo "<br>Nombre del Curso: " . $nombreCurso;
        echo "<br>Destinatarios: " . $destinatarios;
        echo "<br>Estado: " . $estado;
        echo "<br>Nivel: " . $nivel;
        echo "<br>Profesor: "; echo $dniProf.$UsuarioDAL->MostrarNombrePorDni($dniProf);
        echo "<br>Fecha de Inicio: " . $fechaInicio;
        echo "<br>Fecha Final: " . $fechaFinal;
        echo "<br>Resolucion: " . $resolucion;
        echo "<br>Dictamen: " . $dictamen;
        echo "<br>Nro. del Proyecto: " . $nroProyecto;
        echo "<br>Puntaje: " . $puntaje;
        echo "<br>Carga Horaria: " . $cargaHoraria;
        echo "<br>ID del curso: " . $idCurso ."<br>";
     
        
    $eventosJSON = isset($_POST["eventosJSON"]) ? $_POST["eventosJSON"] : "";


    $eventos = json_decode($eventosJSON, true);

    if ($eventos === null && json_last_error() !== JSON_ERROR_NONE) {
    echo "Error al decodificar el JSON de eventos: " . json_last_error_msg();
    return;
    }else{
        print_r($eventos);
    }


    $cronogramaDAL = new CronogramaDAL();


    if ($eventos && is_array($eventos)) {
        foreach ($eventos as $evento) {
                $dia =  $evento["dia"];
                $horario = $evento["horario"];
                $presencialidad = $evento["presencialidad"];
                $fecha = $evento["fecha"];

                $cronograma = new Cronograma($dia, $horario, $presencialidad, $fecha, $idCurso);

                $cronogramaDAL->insertCronograma($cronograma);


            echo "<br>".$dia."<br>".$horario."<br>".$presencialidad."<br>".$fecha."<br>".$idCurso;
    }  
    }
    
 }

    $nivelDAL = new nivelDAL;
    $nivelClass = new Nivel($nivel, $idCurso);

    $nivelDAL->insertCursoNivel($nivelClass);

    $areaDAL = new AreaDAL;
    $areaClass = new Area($area, $idCurso);

    $areaDAL->insertCursoArea($areaClass);

    $sedeDAL = new SedeDAL;
    $sedeClass = new Sede($sede, $idCurso);

    $sedeDAL->insertCursoSede($sedeClass);
    ?>
