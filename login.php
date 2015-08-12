<!DOCTYPE html>
<html>
<?php include 'process.php';

session_start();
if ( $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo get_user($username,$password);

  if(  get_user($username,$password) != "" ) {
  // Authentication successful - Set session
     $_SESSION['auth'] = 1;
      $url = isset($_GET['url']) ? $_GET['url'] : isset($_POST['url']) ? $_POST['url'] : 'results2.php';
     setcookie("username", $username, time()+(84600*30));
     header('Location: ' . $url);
     exit();
  } else {
    $error = "Utilisateur inconnu ou mot de passe incorrect.";
  }
}

?>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>myapp</title>
        <link rel="stylesheet" type="text/css" href="styles/styles.css" />
        <link rel="stylesheet" type="text/css" href="styles/tables.css" />
        <link rel="stylesheet" type="text/css" href="styles/forms.css" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Play" />
    </head>
    <body>
      <div id="container">
        <div id="header">
         <div id="banner"></div>
         <div class="message">
          <div id="title">
            <h1>Entraide Ecole</h1>
          </div>
          <div id="intro">
              <b>En cas de problème de connexion, envoyez un mail à : <a href="mailto:<?php echo get_config('email')?>"><?php echo get_config('email')?></a></b>
              <br>
              Accès protégé: Vous devez vous connecter pour accéder aux détails de l'annonce:
              Utilisez l'adresse e-mail que vous avez entré dans le formulaire et le mot de passe qui vous a été envoyé par email.
          </div>
          </div>
          <div id="form">
            <?php echo $error; ?>
            <br>
          </div>
          <div>
                 <div id="content" class="container">
      <div id="form">

            <div class="formLayout">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                  <h2>Connexion:</h2>
                  <br>
                  <br>
                  <label class="my myForm" for="username">Adresse e-mail:</label><input name="username" id="username" type="text" />
                  <br>
                  <label class="my myForm" for="password">Mot de passe:</label><input name="password" id="password" type="password" />
                  <br>
                  <br>
                  <br>
                  <input type="submit" name="submit" value="Envoyer" id="ss-submit" class="jfk-button jfk-button-action ">
                </form>
                <form id="form2" method="get" action="index.php">
                  <input type="submit" name="submit" value="Annuler" id="ss-submit" class="jfk-button jfk-button-action ">
                </form>
                <a href="lost-password.php"><input type="button" name="lost" value="Mot de passe perdu?" id="ss-submit-map" class="jfk-button jfk-button-action" ></a>
                <br>
                <br>
           <br>
              </div>
         </div>
          </div>
          <div id="footer"></div>
     </div>
     <script type="text/javascript" src="scripts/events.js"></script>
    </body>
</html>
