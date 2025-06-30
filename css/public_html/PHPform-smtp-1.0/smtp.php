<?php

$Nombre = $_POST['Nombre'];
$Correo = $_POST['Correo'];
$Mensaje = $_POST['Mensaje'];

if ($Nombre=='' || $Correo=='' || $Mensaje==''){

echo "<script>alert('Los campos marcados con * son obligatorios');location.href ='javascript:history.back()';</script>";

}else{

    require("src/PHPMailer.php");
    require("src/SMTP.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->SMTPDebug = 2;
    $mail->setFrom('yefferson@kmbjironworks.com'); // Dirección de la que llegan los mensajes. Debe ser igual a la configurada para envíos.
    $mail->FromName = $Nombre;
    $mail->AddAddress("sales@kmbjironworks.com"); // Dirección a la que llegaran los mensajes.

    // Aquí van los datos que apareceran en el correo que reciba

    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject  =  "Contacto";
    $mail->Body =  "Nombre: $Nombre \n<br />".
    "Email: $Correo \n<br />".
    "Mensaje: $Mensaje \n<br />";

    // Datos del servidor SMTP
//
    $mail->IsSMTP();
    $mail->Host = "mail.kmbjironworks.com";  // Servidor de Salida.
    $mail->SMTPAuth = true; // Autenticación SMTP activada
    $mail->SMTPSecure = 'tls'; // Seguridad SMTP
    $mail->Port = 587; // Puerto de autenticación
    $mail->Username = "yoselin@kmbjironworks.com";  // Correo Electrónico que envía correo
    $mail->Password = "S[UYu[]Ysb(v"; // Contraseña de cuenta de correo

    if ($mail->Send())
    echo "<script>alert('Formulario Enviado');location.href ='enviado.html';</script>"; // Respuesta en caso de ser correcto el envío, redireccionará a enviado.html
    else
    echo "<script>alert('Error al enviar el formulario');location.href ='javascript:history.back()';</script>"; // Respuesta en caso de ser incorrecto el envío, regresará al formulario

}
?>
