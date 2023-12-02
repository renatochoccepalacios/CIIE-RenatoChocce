<?php

session_start();

// importar carpetas y archivos
include_once __DIR__ . "\..\..\..\dirs.php";
include_once APP_PATH . '/modules/getError.php';
include_once APP_PATH . '/modules/setInfo.php';

if (!isset($_SESSION['user'])) {
    getError('Cod4');
    header('Location: ' . ROOT_URL . '/public/login');
    exit();
}

include_once __DIR__ . '/../verifyCurso.php';
require_once APP_PATH . '/vendor/autoload.php';
require_once MODELS_PATH . "\DAL\UsuarioDAL.php";
require_once MODELS_PATH . "\DAL\cursoDAL.php";
// require_once(MODELS_PATH . "\Magia.php");

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

//? completar de alguna manera
$posiciones = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L"];

$curso = $cursoDAL->getCursoPorId($idCurso);
$alumnos = $cursoDAL->getStudents($idCurso);

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

foreach ($posiciones as $posicion):
    $activeSheet->getColumnDimension($posicion)->setAutoSize(true);
endforeach;

// tamaño de columna (ancho)
// $activeSheet->getColumnDimension('A')->setWidth(40);

// tamaño de fila (alto)
// $activeSheet->getRowDimension(1)->setRowHeight(40);

$filaActiva = 12;

// info curso

// combinar celdas
$spreadsheet->getActiveSheet()->mergeCells('A1:H1');

// insertar imagen
$drawing = new Drawing();
$drawing->setName('Imagen');
$drawing->setDescription('Dirección general de cultura y educación');
$drawing->setPath(ASSETS_PATH . '/images/excel/image.png');
$drawing->setHeight(60);
$drawing->setCoordinates('A1');

$drawing->setWorksheet($activeSheet);
$activeSheet->getRowDimension(1)->setRowHeight(50);
$activeSheet->getStyle('A1')->getAlignment()->setIndent(10);

$activeSheet->setCellValue("A2", "ACTA DE FINALIZACION DE CURSO Y EVALUACIÓN");
$spreadsheet->getActiveSheet()->mergeCells('A2:H2');
$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);

$activeSheet->setCellValue("B3", "Nombre de curso:");
$activeSheet->setCellValue("C3", $curso->getNombreCurso());
$spreadsheet->getActiveSheet()->mergeCells('C3:E3');

$activeSheet->setCellValue("B4", "Resolución: " . $curso->getResolucion());
$spreadsheet->getActiveSheet()->mergeCells('B4:C4');

$activeSheet->setCellValue("D4", "Dictamen: " . $curso->getDictamen());

$activeSheet->setCellValue("B5", "Nro. proyecto: " . $curso->getNroProyecto());
$spreadsheet->getActiveSheet()->mergeCells('B5:C5');

$activeSheet->setCellValue("D5", "Puntaje: " . $curso->getPuntaje());

$activeSheet->setCellValue("B6", "Carga horaria: " . $curso->getCargaHoraria());
$spreadsheet->getActiveSheet()->mergeCells('B6:C6');

$activeSheet->setCellValue("A7", "Desde");
$activeSheet->setCellValue("C7", $curso->getFechaInicio());
$activeSheet->setCellValue("D7", "Hasta");
$activeSheet->setCellValue("E7", $curso->getFechaFinal());

$activeSheet->setCellValue("B8", "Capacitador: " . $curso->getProfesor());
$spreadsheet->getActiveSheet()->mergeCells('B8:C8');

$activeSheet->setCellValue("A9", "En la cuidad de Escobar; a los dias del mes de septiembre de 2022 se labra la presenteacta destinada a registrar la condicion final de los alumnos que han participado del curso: " . $curso->getNombreCurso());
$spreadsheet->getActiveSheet()->mergeCells('A9:R9');

// encabezados
$activeSheet->setCellValue("A" . $filaActiva, "N°");
$activeSheet->setCellValue("B" . $filaActiva, "Apellido/s");
$activeSheet->setCellValue("C" . $filaActiva, "Nombre/s");
$activeSheet->setCellValue("D" . $filaActiva, "DNI");
$activeSheet->setCellValue("E" . $filaActiva, "Email");

$activeSheet->setCellValue("F" . $filaActiva, "Escuela");
$activeSheet->setCellValue("G" . $filaActiva, "Distrito");
$activeSheet->setCellValue("H" . $filaActiva, "Calificación");

$fechas = $cursoDAL->getDates($idCurso);

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
    $spreadsheet->getActiveSheet()->getStyle('D' . $filaActiva)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    $activeSheet->setCellValue("E" . $filaActiva, $alumno->getCorreo());
    $activeSheet->setCellValue("F" . $filaActiva, "Escuela");
    $activeSheet->setCellValue("G" . $filaActiva, "Distrito");
    $activeSheet->setCellValue("H" . $filaActiva, $cursoDAL->getGrades($alumno->getDni(), $idCurso));

    $activeSheet->getStyle("H$filaActiva")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);

    if ($cursoDAL->getGrades($alumno->getDni(), $idCurso) == 'Aprobado')
        $activeSheet->getStyle("H$filaActiva")->getFill()->getStartColor()->setARGB('FFB6E1CD');

    if ($cursoDAL->getGrades($alumno->getDni(), $idCurso) == 'Desaprobado')
        $activeSheet->getStyle("H$filaActiva")->getFill()->getStartColor()->setARGB('FFEB7F62');

    $lastRow = '';
    $lastCol = '';

    // asistencia
    if (count($fechas) > 0) {
        foreach ($fechas as $pos => $fecha) {
            $activeSheet->setCellValue($pos . $filaActiva, $cursoDAL->getAttendance($fecha, $alumno->getDni(), $idCurso));
            $lastCol = $pos;
            $lastRow = $filaActiva;
        }
    }
}

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
];

$activeSheet->getStyle('A12:H' . $lastRow)->applyFromArray($styleArray);

if (count($fechas) > 0) {
    $activeSheet->setCellValue("I11", "Asistencia");
    $spreadsheet->getActiveSheet()->mergeCells('I11:' . $lastCol . '11');
    $spreadsheet->getActiveSheet()->getStyle('I11')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle("I11")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $activeSheet->getStyle("i11")->getFill()->getStartColor()->setARGB('FFFE9900');
}

setInfo('Cod11');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Nómina.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');