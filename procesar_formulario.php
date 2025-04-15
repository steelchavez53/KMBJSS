<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clave secreta de reCAPTCHA
    $recaptcha_secret_key = "6LchE_8pAAAAAHd0NNv-qaLeac5dqops4J_5_e-4";
    
    // Respuesta reCAPTCHA enviada desde el formulario
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verificación de reCAPTCHA con cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        'secret' => $recaptcha_secret_key,
        'response' => $recaptcha_response
    )));
    $recaptcha_result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo json_encode(["success" => false, "error" => 'Error connecting to Google reCAPTCHA: ' . curl_error($ch)]);
        curl_close($ch);
        exit();
    }
    curl_close($ch);
    $recaptcha_result = json_decode($recaptcha_result, true);

    if (!$recaptcha_result['success']) {
        echo json_encode(["success" => false, "error" => "Failed to verify reCAPTCHA."]);
        exit();
    }

    // Datos del formulario
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address1 = $_POST['address1'];
    $city = $_POST['city'];
    $stateprovince = $_POST['stateprovince'];
    $postal = $_POST['postal'];
    $message = $_POST['message'];

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor de correo
        $mail->isSMTP();
        $mail->Host = 'mail.kmbjironworks.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'sales@kmbjironworks.com'; 
        $mail->Password = 'Fo+Os&e6Op*E'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remitente y destinatarios
        $mail->setFrom('yefferson@kmbjironworks.com', 'kmbjironworks');
        $mail->addAddress('sales@kmbjironworks.com');
         $mail->addCC($email); 
        $mail->addCC('estimatingdepartment@kmbj.info');
        $mail->addCC('ulises@kmbj.info');
        $mail->addCC('office@kmbj.info');
   

        // Adjuntar el archivo si se ha subido
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $mail->addAttachment($file_tmp, $file_name);
        }

        // Contenido del correo
        $mail->isHTML(false);
        $mail->Subject = 'New contact form';
        $mail->Body = "Name: $firstname\n" .
                      "Lastname:  $lastname\n" .
                      "Company: $company\n" .
                      "E-mail: $email\n" .
                      "Phone: $phone\n" .
                      "Address: $address1\n" .
                      "City: $city\n" .
                      "State: $stateprovince\n" .
                      "Postal Code: $postal\n" .
                      "Message: $message\n";

        // Enviar el correo
        $mail->send();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => "Failed to send email. Mailer Error: {$mail->ErrorInfo}"]);
    }
}
?>


