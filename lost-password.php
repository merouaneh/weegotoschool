<!DOCTYPE html>
<html>
<?php include 'process.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  reset_password($username);
  $message = "Votre nouveau mot de passe vient de vous être envoyé à l'adresse " . $username;
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
                  <?php echo $message; ?>
                  <br>
                  <br>
                  <label class="my myForm" for="username">Adresse e-mail:</label><input name="username" id="username" type="text" />
                  <br>
                  <br>
                  <input type="submit" name="submit" value="Nouveau mot de passe" id="ss-submit" class="jfk-button jfk-button-action ">
                </form>
                <form id="form2" method="get" action="login.php">
                  <input type="submit" name="submit" value="Annuler" id="ss-submit" class="jfk-button jfk-button-action ">
                </form>
                <br>
                <br>
           <br>
              </div>
         </div>
          </div>
          <div id="footer"></div>
     </div>
    </body>
</html>
