<?php
require_once("../../../app/models/DAL/CursoDAL.php");
require_once("../../../app/models/DAL/UsuarioDAL.php");
require_once("../../../app/models/curso.php");
require_once("../../../app/models/DAL/SedeDAL.php");
require_once("../../../app/models/DAL/nivelDAL.php");
require_once("../../../app/models/DAL/cronogramaDAL.php");


require_once("../../../app/models/main.php");

//En la primera línea, estamos verificando si la solicitud se hizo mediante el método POST y si el botón 'guardar' del formulario fue presionado

$guardarExitoso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])){

    $idCurso = $_POST["idCurso"];
    $cursoDAL = new CursoDAL();
    
    $cronogramaDAL = new CronogramaDAL();


    //verificamos si el curso con el ID seleccionado existe en la base
    //Si la condicion es verdadera y el curso existe, todo el bloque de codigo dentro del if se ejecutara 
    if (is_object($cursoDAL->getCursoPorId($idCurso))){

        $nombreCurso = $_POST["nombreCurso"];
        $idSedeSeleccionada = $_POST["idSede"];
        $destinatarios = $_POST["destinatarios"];
        $estado = $_POST["estado"];
        $idNivelSeleccionado = $_POST["idNivel"];
        
        $idAreaSeleccionada = $_POST["idArea"];
        
        $profesor = $_POST["profesor"];
        $fechaInicio = $_POST["fechaInicio"];
        $fechaFinal = $_POST["fechaFinal"];
        $resolucion = $_POST["resolucion"];
        $dictamen = $_POST["dictamen"];
        $nroProyecto = $_POST["nroProyecto"];
        $puntaje = $_POST["puntaje"];
        $cargaHoraria = $_POST["cargaHoraria"];
        $vacantes = $_POST["vacantes"];
            
        $descripcion = $_POST["descripcion"];
        $imagen = $_POST["imagen"];

        //Creamos un objeto Curso con los datos del formulario
        $curso = new Curso($nombreCurso, $destinatarios,
        $estado, $profesor, $fechaInicio, $fechaFinal,
        $resolucion, $dictamen, $nroProyecto, $puntaje, 
        $cargaHoraria, $vacantes, $descripcion, $imagen,
        $idCurso
    );

        
        //llamamos a los metodos para que modifiquen la base de datos 
        $cursoDAL->modificarCurso($curso, $idCurso);

        $sedeDAL->asignarSedeACurso($idSedeSeleccionada, $idCurso);

        $nivelDAL->asignarNivelACurso($idNivelSeleccionado, $idCurso);

        $areaDAL->asignarAreaACurso($idAreaSeleccionada, $idCurso);

        $cronogramaDAL->eliminarCronogramaPorid($idCurso);       
    
        $guardarExitoso = true;

    
    }else {
        echo "<p>Curso no encontrado</p>";
    }   
}else if (isset($_GET['idCurso'])) {
            $idCurso = $_GET['idCurso'];
            $cursoDAL = new CursoDAL();
            $curso = $cursoDAL->getCursoPorId($idCurso);
            
            
         }
        
        
         
            //instancias
            $sede = new SedeDAL;
            $sedeDAL = new SedeDAL();
            $nivel = new NivelDAL;
            $nivelDAL = new NivelDAL();
            $area = new AreaDAL; 
            $areaDAL = new AreaDAL(); 
           
            $cronogramaDAL = new CronogramaDAL();
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
        
        
/*                     echo "<br>".$dia."<br>".$horario."<br>".$presencialidad."<br>".$fecha."<br>".$idCurso;
 */        
                    
            }  
            }
        
            $cronogramaDAL = new CronogramaDAL();
            $eventosJSON = isset($_POST["eventosJSON"]) ? $_POST["eventosJSON"] : "";
        
            $eventos = json_decode($eventosJSON, true);
            
            $cronogramaDAL = new CronogramaDAL();
            
            if ($eventos && is_array($eventos)) {
                foreach ($eventos as $idCronograma) {
                    // Elimina el cronograma según su ID
                    $cronogramaDAL->eliminarCronograma($idCronograma);
                }
                
            }

           
if ($guardarExitoso) {
    // Redirigir solo si los datos se cambiaron correctamente
    header("Location: ../../../admin/curso/?id=$idCurso");
    exit(); // Asegúrate de salir después de la redirección para evitar ejecución adicional del código
}
        
?>


