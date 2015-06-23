<?php
// Include the Mail package
require "Mail.php";

function send_mail($recipent, $subject, $body) { 
   // Identify the sender, recipient, mail subject, and body
   $sender    = get_config('smtp_sender');
 
   // Identify the mail server, username, password, and port
   $server   = get_config('smtp_server');
   $username = get_config('smtp_username');
   $password = get_config('smtp_password');
   $port     = get_config('smtp_port');
 
   // Set up the mail headers
   $headers = array(
      "From"    => $sender,
      "To"      => $recipient,
      "Subject" => $subject
   );
 
   // Configure the mailer mechanism
   $smtp = Mail::factory("smtp", 
      array(
        "host"     => $server,
        "username" => $username,
        "password" => $password,
        "auth"     => true,
        "port"     => $port,
        "debug"    => true,
      )
   );
 
   // Send the message
   $mail = $smtp->send($recipient, $headers, $body);
   $mail->SMTPDebug  = 1;
 
   if (PEAR::isError($mail)) {
      echo ($mail->getMessage());
   }

}
?>