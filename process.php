<?php
include 'common.php';
include 'mail.php';
include 'data.php';

function reset_password($username) {
  if( user_exists($username) != "" ) {
    $password = randomPassword();
    $message = get_password_message($username, $password);
    update_password($username, $password);
    $admin = get_config('email');
    $headers = 'From: ' . $admin . "\r\n" . 'Reply-To: ' . $admin .  "\r\n" . 'X-Mailer: PHP/' . phpversion();
    $subject = "Votre nouveau mot de passe sur Entraide Ecole" ;
    $mail = send_mail($username, $subject, $message);
  } 
}

function submit() {

    $_POST['addressHome'] = s_obfuscateAddress($_POST['addressHome'] );
    $_POST['addressWork'] = s_obfuscateAddress($_POST['addressWork'] );
    $_POST['addressOther'] = s_obfuscateAddress($_POST['addressOther'] );


    $_POST['cityHome'] =  ucfirst(strtolower($_POST['cityHome'] ));
    $_POST['cityWork'] =  ucfirst(strtolower($_POST['cityWork'] ));
    $_POST['cityOther'] =  ucfirst(strtolower($_POST['cityOther'] ));


    $json = json_encode($_POST);
    $decoded_resp = json_decode($json);

    $collection = get_collection(ROUTES_COLLECTION);
    $collection->insert($decoded_resp);
    $to      =  $_POST['email'];
    $subject = "Votre annonce sur Entraide Ecole a été ajoutee." ;
    $message = "Vous pouvez consulter votre annonce sur le site avec votre mot de passe actuel.\r\n" ;
    $message .= "Utilisateur: " . $to . "\r\n" ;
    $message .= "Rendez-vous sur : " . get_config('url') . " pour voir les resultats\r\n\r\n\r\n" ;
    if( user_exists($to) == "" ) {
        $password = randomPassword();
        $collection = get_collection(USERS_COLLECTION);
        $collection->insert( array('username' =>  $to ,  'password' => $password,));
        $message = get_password_message($to, $password);
    } 

    $admin = get_config('email');
    $headers = 'From: ' . $admin . "\r\n" . 'Reply-To: ' . $admin .  "\r\n" . 'X-Mailer: PHP/' . phpversion();
    $mail = send_mail($to, $subject, $message);
    header('Location: results2.php?success&mail='.$mail);    
}


function get_password_message($to, $password) {
    $subject = "Votre mot de passe pour Entraide Ecole" ;
    $message = "Bonjour, voici votre mot de passe pour le site Entraide Ecole. Il vous permettra de consulter les details des annonces\r\n" ;
    $message .= "Utilisateur: " . $to . "\r\n" ;
    $message .= "Mot de passe: " . $password. "\r\n\r\n\r\n\r\n" ;
    $message .= "Rendez-vous sur : " . get_config('url') . " pour voir les resultats\r\n\r\n\r\n" ;
    return $message;
}

?>
