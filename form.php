<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>myapp</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="stylesheet" type="text/css" href="forms.css" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Play" />
    </head>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
    <script type="text/javascript" src="events.js"></script>

    <body>
      <div id="container">
        <div id="header">
        <div id="banner"></div>
        <div id="title"><h1>Entraide Ecole</h1></div>
        <div id="intro">
            السلام عليكم 
            <br/>
            Besoin d'aide pour emmener ou récupérer vos enfants à l'école ? Personne pour s'en occuper le mercredi ou pendant les vacances scolaires? Vous avez besoin d'un coup de main pour le repas de midi quelques jours par semaine? Vous avez peut-être besoin d'aide pour les devoirs? D'autres parents sont certainement dans le même cas que vous! Pourquoi ne pas s'entraider entre parents de l'école? Ce formulaire à pour but de vous aider à vous mettre en relation des parents proches de votre lieu de résidence ou de travail, et vous aider à trouver des solutions pour le myapp, la garde, la cantine et les devoirs de vos enfants.
        </div>
      </div>

       <div id="content" class="container">
        <div id="form">

        <div class="formLayout">
          <label for="name">Vos nom et prénoms</label><input id="name" name="name">
          <label for"parente">Lien de parenté</label>
          <select id="parente">
              <option>Mère</option><option>Père</option><option>Grand-Mère</option><option>Grand-Père</option>
              <option>Tante maternelle</option><option>Oncle maternel</option><option>Tante paternelle</option><option>Oncle paternel</option>
              <option>Voisine ou amie des parents</option><option>Voisin ou amie des parents</option>
          </select>
          <br>
          <label for="childFirstname">Noms et prénoms des enfants</label><input id="childFirstname" name="childFirstname">
          <label for"childrenNumber">Nombre d'enfants</label>
          <select id="childrenNumber">
              <option>1</option><option>2</option><option>3</option><option>4</option>
              <option>5</option><option>6</option>
          </select>
          <br>
          <label for="childrenGrades">Classes des enfants</label>
          <label for="PS">PS</label><input id="PS" name="childrenGrades" type="checkbox">
          <label for="MS">MS</label><input id="PS" name="childrenGrades" type="checkbox">
          <label for="GS">GS</label><input id="PS" name="childrenGrades" type="checkbox">
          <label for="CP">CP</label><input id="PS" name="childrenGrades" type="checkbox">
          <label for="CE1">CE1</label><input id="PS" name="childrenGrades" type="checkbox">
          <label for="CE2">CE2</label><input id="PS" name="childrenGrades" type="checkbox">
          <label for="CM1">CM1</label><input id="PS" name="childrenGrades" type="checkbox">
          <label for="CM2">CM2</label><input id="PS" name="childrenGrades" type="checkbox">

          <br>
          <label for="address">Adresse (approximative)</label><input id="address"><br>
          <label for="zip">Code postal</label><input id="zip"><br>
          <label for="city">Ville</label><input id="city"><br>
          <label for="email">Adresse e-mail</label><input id="email"><br>
          <label for="submit"></label><input type="submit" id="submit" name="submit" value="Envoyer" id="ss-submit" class="jfk-button jfk-button-action "><br>
         </div>
       </div>
       <div id="footer">
       </div>
      </div>
    </body>

</html>
