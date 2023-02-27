<?php
//a utiliser avec   voir PHPmailer
$to = "admin@gmail.com";
$subject = "sujet messaggge0";
$message = "message";
//max 70 charact par ligne donc
$message = wordwrap($message, 70, "\r\n");
$header = [
    "From" => "no-reply@monsite.fr",
    "Reply-To" => "admin@gmail.com"
];



mail($to, $subject, $message, $header);