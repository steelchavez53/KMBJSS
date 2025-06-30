<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error connecting to Google reCAPTCHA: ' . curl_error($ch);
} else {
    echo 'Connection successful: ' . $response;
}
curl_close($ch);
?>
