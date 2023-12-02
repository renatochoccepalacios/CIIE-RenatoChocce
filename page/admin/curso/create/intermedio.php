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
    $vacantes = $_POST["vacantes"];



    $dniProf= $_POST["profesor"]; 

    $fechaInicio = $_POST["fechaInicio"];
    $fechaFinal = $_POST["fechaFinal"];

    $resolucion = $_POST["resolucion"];
    $dictamen = $_POST["dictamen"];
    $nroProyecto = $_POST["nroProyecto"];
    $puntaje = $_POST["puntaje"];
    $cargaHoraria = $_POST["cargaHoraria"];

    $descripcion = $_POST["descripcion"];
    $imagen = $_POST["imagen"];

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
                        $cargaHoraria,
                        $vacantes,
                        $descripcion,
                        $imagen
    );


    $UsuarioDAL = new UsuarioDAL();
    $cursoDAL = new CursoDAL();

    $idCurso = $cursoDAL->insertCurso($curso);

    $eventosJSON = isset($_POST["eventosJSON"]) ? $_POST["eventosJSON"] : "";


    $eventos = json_decode($eventosJSON, true);

    $cronogramaDAL = new CronogramaDAL();


    if ($eventos && is_array($eventos)) {
        foreach ($eventos as $evento) {
                $dia =  $evento["dia"];
                $horario = $evento["horario"];
                $presencialidad = $evento["presencialidad"];
                $fecha = $evento["fecha"];

                $cronograma = new Cronograma($dia, $horario, $presencialidad, $fecha, $idCurso);

                $cronogramaDAL->insertCronograma($cronograma);
    }  
    }
    
 }

/*     $nivelDAL = new nivelDAL;*/
    $nivelClass = new Nivel("", $nivel); 

    $cursoDAL->insertCursoNivel($nivelClass, $idCurso);

    $areaClass = new Area("", $area);

    $cursoDAL->insertCursoArea($areaClass, $idCurso);

    $sedeClass = new Sede("","","","", $sede);

    $cursoDAL->insertCursoSede($sedeClass, $idCurso);
    header("Location: ../../../admin/curso/?id=$idCurso");
    exit;
    ?>
