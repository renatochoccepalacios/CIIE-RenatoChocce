<?php

session_start();

// importar carpetas y archivos
include_once __DIR__ . "\..\..\..\dirs.php";

// if (!isset($_SESSION['user'])) {
//     header('Location: ../');
// }

// include_once __DIR__ . '/../modules/verifyCurso.php';

require_once '../../../app/vendor/autoload.php';
require_once MODELS_PATH . "\DAL\UsuarioDAL.php";
require_once MODELS_PATH . "\DAL\cursoDAL.php";
// require_once(MODELS_PATH . "\Magia.php");

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

//? completar de alguna manera
$posiciones = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L"];

$id = $_GET['id'];
$cursoDAL = new CursoDAL();
// $magia = new Magia;

$curso = $cursoDAL->getCursoPorId($id);
$alumnos = $cursoDAL->getStudents($id);


// inicializando el spreadsheet
$spreadsheet = new Spreadsheet();

// creador del excel
$spreadsheet->getProperties()->setCreator('CIIE Escobar');

// nombre del documento
$spreadsheet->getProperties()->setTitle('Nomina de alumnos de curso de ' . $curso->getNombreCurso());

// indicar en que posicion se trabaja
$spreadsheet->setActiveSheetIndex(0);

// setear una fuente
$spreadsheet->getDefaultStyle()->getFont()->setName('Verdana');

// tamaño de fuente
$spreadsheet->getDefaultStyle()->getFont()->setSize(10);

// obtener la hoja activa
$activeSheet = $spreadsheet->getActiveSheet();

// tamaño de columna (ancho)
// $activeSheet->getColumnDimension('A')->setWidth(40);

// tamaño de fila (alto)
// $activeSheet->getRowDimension(1)->setRowHeight(40);

// agregar una celda donde
// 1er argumento: posicion
// 2do argumento: contenido

$filaActiva = 12;

// info curso

// combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('A1:H1');

// insertar imagen
$drawing = new Drawing();
$drawing->setName('Imagen');
$drawing->setDescription('Dirección general de cultura y educación');
$drawing->setPath('image.png');
$drawing->setHeight(60);
$drawing->setCoordinates('A1');

$activeSheet->getRowDimension('1')->setRowHeight(50);

$drawing->setWorksheet($activeSheet);


$activeSheet->setCellValue("A2", "ACTA DE FINALIZACION DE CURSO Y EVALUACIÓN");
$activeSheet->setCellValue("B3", "Nombre de curso: " . $curso->getNombreCurso());
$activeSheet->setCellValue("C3", "Educación y Medios el diario digital en la Escuela");
$activeSheet->setCellValue("B4", "Resolución: 2711/15");
$activeSheet->setCellValue("D4", "Dictamen: 9739");
$activeSheet->setCellValue("E4", "Escobar (Lunes)");
$activeSheet->setCellValue("B5", "Nro. proyecto: 073/15 N/C");
$activeSheet->setCellValue("D5", "Puntaje: 0.44");
$activeSheet->setCellValue("B6", "Carga horaria: 30 horas reloj");
$activeSheet->setCellValue("A7", "Desde");
$activeSheet->setCellValue("C7", "23/08/2022");
$activeSheet->setCellValue("D7", "Hasta");
$activeSheet->setCellValue("E7", "19/09/2022");
$activeSheet->setCellValue("B8", "Capacitador: Carlos Javier Roldán");
$activeSheet->setCellValue("A9", "En la cuidad de Escobar; a los dias del mes de septiembre de 2022 se labra la presenteacta destinada a registrar la condicion final de los alumnos que han participado del curso: Educación y Medios el diario digital en la escuela");

$activeSheet->setCellValue("I11", "Asistencia");

// encabezados
$activeSheet->setCellValue("A" . $filaActiva, "N°");
$activeSheet->setCellValue("B" . $filaActiva, "Apellido/s");
$activeSheet->setCellValue("C" . $filaActiva, "Nombre/s");
$activeSheet->setCellValue("D" . $filaActiva, "DNI");
$activeSheet->setCellValue("E" . $filaActiva, "Email");
$activeSheet->setCellValue("F" . $filaActiva, "Escuela");
$activeSheet->setCellValue("G" . $filaActiva, "Distrito");
$activeSheet->setCellValue("H" . $filaActiva, "Calificación");

$fechas = $cursoDAL->getDates($id);

$i = 1;

foreach ($fechas as $pos => $fecha) {
    $activeSheet->setCellValue($pos . $filaActiva, "E" . $i++);
}


// contenido

// iterar alumnos
$columnaActual = 8;
$filaActual = $filaActiva;

foreach ($alumnos as $alumno) {
    $filaActiva++;
    $activeSheet->setCellValue("A" . $filaActiva, $filaActiva - $filaActual);
    $activeSheet->setCellValue("B" . $filaActiva, $alumno->getApellido());
    $activeSheet->setCellValue("C" . $filaActiva, $alumno->getNombre());
    $activeSheet->setCellValue("D" . $filaActiva, $alumno->getDni());
    $activeSheet->setCellValue("E" . $filaActiva, $alumno->getCorreo());
    $activeSheet->setCellValue("F" . $filaActiva, "Escuela");
    $activeSheet->setCellValue("G" . $filaActiva, "Distrito");
    $activeSheet->setCellValue("H" . $filaActiva, $cursoDAL->getGrades($alumno->getDni(), $id));

    // asistencia
    foreach ($fechas as $pos => $fecha) {
        $activeSheet->setCellValue($pos . $filaActiva, $cursoDAL->getAttendance($fecha, $alumno->getDni(), $id));
    }
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Nómina.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');