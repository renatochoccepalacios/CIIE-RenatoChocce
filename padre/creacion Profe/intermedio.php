<?php 

require_once("../models/DAL/profesorDAL.php");
require_once("../models/DAL/main.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-profesor"])) {

    $nombreProfe = $_POST["nombre_profe"];
    $dni = $_POST["dni"];
    $cuil = $_POST["cuil"];
    $foto = $_POST["foto"];

    $profesor = new ProfesorDAL ($nombreProfe,
                                $dni,
                                $cuil,
                                $foto

    );

    $profesorDAL = new ProfesorDAL();

    $profesorDAL->insertarProfesor($profesor);

}else{
    echo "error";
}

?>