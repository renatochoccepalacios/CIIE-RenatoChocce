<?php

require_once '../../dirs.php';
require_once MODELS_PATH . '/DAL/UsuarioDAL.php';
require_once APP_PATH . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$correo = $_POST['mail'];

$usuarioDAL = new UsuarioDAL();
$dniUsuario = $usuarioDAL->getPerMail($correo);

$nombreUsuario = $usuarioDAL->getPerId($dniUsuario)->getNombre();

$arr = $usuarioDAL->generatePin($dniUsuario);
$id = $arr[0];
$pin = $arr[1];

$mail = new PHPMailer(true);

// empezamos a "recolectar" la informacion html que venga
ob_start();
mb_internal_encoding('UTF-8');
?>

<main id="mail" style="max-width: 500px;margin:auto;">
    <section class="row-1"
        style="padding: 60px 20px 2px 20px;background-color: #4C8B9F;color: white; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
        <h1 style="font-size:25px; margin-bottom: 10px">Código de verificación del CIIE</h1>
    </section>

    <section class="row-2" style="margin-top:40px;font-size: 18px;color:#000;background: white">
        <p style="margin:15px 0 0 0;margin-left: 20px">Hola, <b>
                <?= $nombreUsuario ?>
            </b>.</p>
        <p style="margin:15px 0 0 0;margin-left: 20px">Hemos recibido una solicitud para reestablecer la contraseña de
            tu cuenta del
            CIIE. El código de verificación
            es: </p>

        <p style="font-size:30px;font-weight:600;border-radius:8px;margin-left:20px; letter-spacing: 3px">
            <?= $pin ?>
        </p>

        <p style="margin:15px 0 0 0;margin-left: 20px">Si no solicitaste este pin, es posible que otra persona esté
            intentando acceder a
            tu cuenta. <b>No reenvíes
                ni proporciones este código a nadie</b>.</p>

        <p style="margin:15px 0 0 0;margin-left: 20px">Atentamente,<br>El equipo de cuentas del CIIE de Escobar.</p>

    </section>
</main>

<?php

// dejamos de "recolectar" la informacion y almacenamos lo obtenido
$html = ob_get_clean();

// exit();
try {
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
    $mail->Subject = 'Reestablecimiento de contraseña';
    $mail->Body = $html;

    $mail->send();

    // header('Location: ../curso/?id=' . $idCurso);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// exit();]

header("Location: ingresarPin.php?id=$id")
    // header("Location: ../recover/")
    ?>