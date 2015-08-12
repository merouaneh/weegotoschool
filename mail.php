<?php
// Include the Mail package
require "Mail.php";



require("sendgrid-php/sendgrid-php.php");

function send_mail($recipient, $subject, $body) { 
    $sendgrid = new SendGrid(getenv('SENDGRID_USERNAME'), getenv('SENDGRID_PASSWORD'));
    $email    = new SendGrid\Email();

    $email->addTo($recipient)
          ->setFrom("no-reply@rhcloud.com")
          ->setSubject($subject)
          ->setText($body);

    $sendgrid->send($email);
}

?>