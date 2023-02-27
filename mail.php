<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include_once "includes/phpmailer/PHPMailer.php";
include_once "includes/phpmailer/Exception.php";
include_once "includes/phpmailer/SMTP.php";
$mail = new PHPMailer(true);
try { //config
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //je vx les info de debug
    //config smtp
    $mail->isSMTP();
    $mail->Host = "localhost";
    $mail->Port = 1025;
    $mail->CharSet = "utf-8";

    //destinataire
    $mail->addAddress("test@gmail.fr");

    $mail->addCC("copie@gmail.fr");
    $mail->addBCC("copiecache@gmail.com");

    //expediteur
    $mail->setFrom("no-reply@monsite.fr");
    // Contenu

    $mail->Subject = "Message avec caractere accentué car utilisation utf-8";
    $mail->Body  = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam blanditiis explicabo praesentium culpa dolore, dignissimos accusamus. Voluptatibus exercitationem doloribus tempore! Esse dignissimos sed enim aliquam autem ad deserunt. Fugiat nihil dignissimos sapiente at quidem fugit. Tempora cumque ipsa atque eos corrupti, quidem ut numquam sed dolorum quod quam ad fugiat pariatur veniam repellendus voluptates. Cupiditate asperiores maxime minus suscipit veritatis adipisci facilis molestias, fuga ab voluptates, cumque debitis architecto. Perspiciatis voluptates nostrum molestiae similique nesciunt quia necessitatibus reprehenderit possimus magnam placeat, architecto suscipit commodi porro molestias iure ad, facere omnis enim velit cum alias dolores ab laboriosam quis! Quidem rerum atque est fugit a ipsum. Velit assumenda corrupti at praesentium voluptate? Aliquid dolorem beatae eveniet. Rem debitis necessitatibus accusantium itaque omnis neque nostrum ea rerum recusandae excepturi aspernatur ipsam eos aliquid laudantium id dignissimos vero nesciunt doloribus voluptatem molestias, pariatur laboriosam, nam cumque? Ut unde earum similique enim aliquid laboriosam nemo hic aperiam minima tempore rerum, ipsum itaque ratione ex. Deserunt odio incidunt iusto ex dicta voluptatibus voluptatum. Dignissimos aliquam laboriosam saepe tenetur nulla rem, et impedit corrupti sunt eius, vel laudantium est voluptatibus error, cumque eos nobis commodi nesciunt autem nostrum eaque veritatis consequatur? Quo voluptates eligendi iure nobis, deleniti, a aut molestiae eveniet ratione animi minus velit? Debitis aut, soluta qui aliquid consequatur exercitationem fuga dolorem nam tempore ex natus accusamus dolorum, voluptatibus recusandae aliquam et. Explicabo ab nisi ratione, sunt nesciunt ad";

    //on envoie
    $mail->Send();
    echo "mail envoyé avec succés";
} catch (Exception) {
    echo "Message non envoyé.Erreur: {$mail->ErrorInfo}";
}