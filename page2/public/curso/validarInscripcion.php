<?php
//incluir los directorios
include_once($_SERVER['DOCUMENT_ROOT'] . "/CIIE/page/dirs.php");
require_once(MODELS_PATH . "/DAL/UsuarioDAL.php");
require_once(MODELS_PATH . "/Magia.php");
require_once("../../app/errors/getError.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// use PHPMailer\PHPMailer\SMTP;

require_once(__DIR__ . '/../../app/vendor/autoload.php');

session_start();

if (!isset($_SESSION['user'])) {

  header('Location: ../login/');
}

$magia = new Magia();

$dni = isset($_POST["dni"]) ? $_POST['dni'] : "";
$idCurso = isset($_POST["idCurso"]) ? $_POST['idCurso'] : "";
$accion = isset($_POST['accion']) ? $_POST['accion'] : "";

if ($accion == 'inscribirse') {

  if ($dni != "" && $idCurso != "") {
    $dal = new UsuarioDAL();

    if ($dal->verificarAlumno($dni, $idCurso) == 1) {
      echo getError("Cod7.4");
      exit;
    }

    if ($magia->verifyVigencia($idCurso) == 0) {
      //@generar el error
      echo "no esta vigente el curso";
      exit;
    }

    if ($magia->vacantesCurso($idCurso) > 0) {
      $dal->inscripcionCursante($dni, $idCurso);

      $usuario = $dal->getPerId($dni);
      $curso = $magia->getPerId($idCurso);

      $correo = $usuario->getCorreo();

      $nombreCurso = $curso[0]->nombre;

      $mail = new PHPMailer(true);

      try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'gruponro3@eest3savio.edu.ar'; //SMTP username
        $mail->Password = 'jazjgfdzfdmrdbpd'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('gruponro3@eest3savio.edu.ar', 'CIIE Escobar');
        $mail->addAddress($correo);

        //Attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Inscripción exitosa.';
        $mail->Body = 'Inscripción exitosa al curso de ' . $nombreCurso;

        $mail->send();

        header('Location: ../curso/?id=' . $idCurso);
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    } else {
      //@todo generar el error
      echo "No hay vacantes disponibles";
    }
  }
}