<!DOCTYPE html>
<html>

<?php include 'process.php';

$name = $childFirstname = $telephone = $email = $addressHome =  $cityHome = $cityZip = $classified = "";

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
    $errors  = array();
    
    $result = validateMandatory('name');
    $name = $result['value']; 
    $errors['name'] = $result['error'];
    
    $result = validateMandatory('childFirstname'); 
    $childFirstname = $result['value'];
    $errors['childFirstname'] = $result['error'];
    
    $result = validateMandatory('telephone');
    $telephone = $result['value'];
    $errors['telephone'] = $result['error'];

    $result = validateMandatory('email');
    $email = $result['value'];
    $errors['email'] = $result['error'];

    $result = validateMandatory('addressHome');
    $addressHome = $result['value'];
    $errors['addressHome'] = $result['error'];

    $result = validateMandatory('zipHome');
    $zipHome = $result['value'];
    $errors['zipHome'] = $result['error'];

    $result = validateMandatory('cityHome');
    $cityHome = $result['value'];
    $errors['cityHome'] = $result['error'];

    $result = validateMandatory('classified');
    $classified = $result['value'];
    $errors['classified'] = $result['error'];

    $result = validateMandatory('childrenGrades');
    $childrenGrades = $result['value'];
    $errors['childrenGrades'] = $result['error'];

    $errors = array_filter($errors);
    if (empty($errors)) {
      submit();
    }
}
?>
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
      <br>
      <div class="formLayout">
        <div id="title"><h1>Entraide Ecole</h1></div>
        <div id="intro">
            السلام عليكم 
            <br/>
            Besoin d'aide pour emmener ou récupérer vos enfants à l'école ? Personne pour s'en occuper le mercredi ou pendant les vacances scolaires? Vous avez besoin d'un coup de main pour le repas de midi quelques jours par semaine? Vous avez peut-être besoin d'aide pour les devoirs? D'autres parents sont certainement dans le même cas que vous! Pourquoi ne pas s'entraider entre parents de l'école? Ce formulaire à pour but de vous aider à vous mettre en relation des parents proches de votre lieu de résidence ou de travail, et vous aider à trouver des solutions pour le myapp, la garde, la cantine et les devoirs de vos enfants.
        </div>
      </div>
    </div>

     <div id="content" class="container">
      <div id="form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <div class="formLayout">
            <h2>Remplir le formulaire et accéder aux annonces des parents près de chez vous</h2>
            <br>
            <a href="results.php"><h3>Accéder directement aux résultats</h3></a>
            <br>
            <label for="name">Vos nom et prénoms</label>
            <input id="name" name="name" class="<?php echo $errors['name'] ?>" value="<?php echo $name ?>" placeholder="Obligatoire" />
            <label for="parente">Lien de parenté</label>
            <select id="parente" name="parente">
                <option>Mère</option><option>Père</option><option>Grand-Mère</option><option>Grand-Père</option>
                <option>Tante maternelle</option><option>Oncle maternel</option><option>Tante paternelle</option><option>Oncle paternel</option>
                <option>Voisine ou amie des parents</option><option>Voisin ou amie des parents</option>
            </select>
            <br>
            <label for="email">Adresse e-mail</label>
            <input  id="email" name="email" class="<?php echo $errors['email'] ?>" 
                    value="<?php echo $email ?>" placeholder="Obligatoire" />

            <label for="telephone">N° téléphone</label>
            <input id="telephone" name="telephone" class="<?php echo $errors['telephone'] ?>" 
                    value="<?php echo $telephone ?>" placeholder="Obligatoire" />
            <br>
            <label for="childFirstname">Noms et prénoms des enfants</label>
            <input id="childFirstname" name="childFirstname" class="<?php echo $errors['childFirstname'] ?>" 
                   value="<?php echo $childFirstname ?>" placeholder="Obligatoire" />

            <label for="childrenNumber">Nombre d'enfants</label>
            <select id="childrenNumber" name="childrenNumber">
                <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option>
            </select>
            <br>
            <label for="childrenGrades">Classes des enfants</label>
            <label for="PS">PS</label><input   type="checkbox" name="childrenGrades[]" id="PS"  <?php checkbox('childrenGrades', 'PS'); ?> 
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="MS">MS</label><input   type="checkbox" name="childrenGrades[]" id="MS"  <?php checkbox('childrenGrades', 'MS'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="GS">GS</label><input   type="checkbox" name="childrenGrades[]" id="GS"  <?php checkbox('childrenGrades', 'GS'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CP">CP</label><input   type="checkbox" name="childrenGrades[]" id="CP"  <?php checkbox('childrenGrades', 'CP'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CE1">CE1</label><input type="checkbox" name="childrenGrades[]" id="CE1" <?php checkbox('childrenGrades', 'CE1'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CE2">CE2</label><input type="checkbox" name="childrenGrades[]" id="CE2" <?php checkbox('childrenGrades', 'CE2'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CM1">CM1</label><input type="checkbox" name="childrenGrades[]" id="CM1" <?php checkbox('childrenGrades', 'CM1'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CM2">CM2</label><input type="checkbox" name="childrenGrades[]" id="CM2" <?php checkbox('childrenGrades', 'CM2'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <br>
            <br>
            <br>
            <label for="addressHome">Adresse résidence</label>
            <input id="addressHome" name="addressHome" placeholder="Adresse approchée sans n° de rue" 
                      value="<?php echo $addressHome ?>" class="<?php echo $errors['addressHome'] ?>"  />

            <label for="zipHome">CP</label>
            <input id="zipHome" name="zipHome" 
                    value="<?php echo $zipHome ?>" class="<?php echo $errors['zipHome'] ?>"  />
            
            <label for="cityHome">Ville</label>
            <input id="cityHome" name="cityHome"
                   value="<?php echo $cityHome ?>" class="<?php echo $errors['cityHome'] ?>"  />
            <br>

            <label for="addressWork">Adresse travail</label>
            <input id="addressWork" name="addressWork" placeholder="Adresse approchée sans n° de rue"/>
            <label for="zipWork">CP</label><input id="zipWork" name="zipWork" />
            <label for="cityWork">Ville</label><input id="cityWork" name="cityWork" /><br>

            <label for="addressOther">Autre Adresse</label>
            <input id="addressOther" name="addressOther" placeholder="Adresse approchée sans n° de rue"/>
            <label for="zipOther">CP</label><input id="zipOther" name="zipOther" />
            <label for="cityOther">Ville</label><input id="cityOther" name="cityOther" /><br>
            <br>
            <br>
            <br>

            <label class="generalAction">Cherche de l'aide pour : </label>
            <label for="Lu" onClick="toggleAll(this);">Lu</label>
            <label for="Ma" onClick="toggleAll(this);">Ma</label>
            <label for="Me" onClick="toggleAll(this);">Me</label>
            <label for="Je" onClick="toggleAll(this);">Je</label>
            <label for="Ve" onClick="toggleAll(this);">Ve</label>
            
            <label class="generalAction">Propose de l'aide pour : </label>
            <label for="Lu" onClick="toggleAll(this);">Lu</label>
            <label for="Ma" onClick="toggleAll(this);">Ma</label>
            <label for="Me" onClick="toggleAll(this);">Me</label>
            <label for="Je" onClick="toggleAll(this);">Je</label>
            <label for="Ve" onClick="toggleAll(this);">Ve</label>
            <br>
            <label id="chercheCovoiturage" for="chercheCovoiturage[]" onClick="toggleAll(this);">Covoiturage/pedibus</label>
            <input type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Lu'); ?>/>
            <input type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Ma'); ?>/>
            <input type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Me'); ?>/>
            <input type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Je'); ?>/>
            <input type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Ve'); ?>/>

            <label id="proposeCovoiturage" for="proposeCovoiturage[]" onClick="toggleAll(this);">Covoiturage/pedibus</label>
            <input type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Lu'); ?> />
            <input type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Ma'); ?> />
            <input type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Me'); ?> />
            <input type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Je'); ?> />
            <input type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Ve'); ?> />
            <br>
            <label id="chercheCantine" for="chercheCantine[]" onClick="toggleAll(this);">Cantine</label>
            <input type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Lu'); ?> />
            <input type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Ma'); ?> />
            <input type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Me'); ?> />
            <input type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Je'); ?> />
            <input type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Ve'); ?> />

            <label id="proposeCantine" for="proposeCantine[]" onClick="toggleAll(this);">Cantine</label>
            <input type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Lu'); ?> />
            <input type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Ma'); ?> />
            <input type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Me'); ?> />
            <input type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Je'); ?> />
            <input type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Ve'); ?> />
            <br>
            <label id="chercheGarderie" for="chercheGarderie[]" onClick="toggleAll(this);">Garderie</label>
            <input type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Lu'); ?> />
            <input type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Ma'); ?> />
            <input type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Me'); ?> />
            <input type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Je'); ?> />
            <input type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Ve'); ?> />

            <label id="proposeGarderie" for="proposeGarderie[]" onClick="toggleAll(this);">Garderie</label>
            <input type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Lu'); ?> />
            <input type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Ma'); ?> />
            <input type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Me'); ?> />
            <input type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Je'); ?> />
            <input type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Ve'); ?> />
            <br>
            <label id="chercheDevoirs" for="chercheDevoirs[]" onClick="toggleAll(this);">Devoirs</label>
            <input type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Lu'); ?> />
            <input type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Ma'); ?> />
            <input type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Me'); ?> />
            <input type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Je'); ?> />
            <input type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Ve'); ?> />

            <label id="proposeDevoirs" for="proposeDevoirs[]" onClick="toggleAll(this);">Devoirs</label>
            <input type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Lu'); ?> />
            <input type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Ma'); ?> />
            <input type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Me'); ?> />
            <input type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Je'); ?> />
            <input type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Ve'); ?> />
            <br>
            <label id="chercheGardeVacances" for="chercheGardeVacances[]" onClick="toggleAll(this);">Vacances</label>
            <input type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Lu'); ?> />
            <input type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Ma'); ?> />
            <input type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Me'); ?> />
            <input type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Je'); ?> />
            <input type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Ve'); ?> />

            <label id="proposeGardeVacances" for="proposeGardeVacances[]" onClick="toggleAll(this);">Vacances</label>
            <input type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Lu'); ?> />
            <input type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Ma'); ?> />
            <input type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Me'); ?> />
            <input type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Je'); ?> />
            <input type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Ve'); ?> />
            <br>
            <br>
            <label for="classified">Votre annonce</label>
            <textarea id="classified" name="classified" cols="80" class="<?php echo $errors['classified'] ?>" 
                      placeholder="Entrer ici des détails de l'annonce: Par exemple: J'ai une voiture 4 places. Je travaille à Villemomble"><?php echo $classified ?></textarea>
            <br>
            <br>
            <br>
            
            <br>
            <label></label><label></label>
            <label for="submit"></label><input type="submit" id="submit" name="submit" value="Envoyer" id="ss-submit" class="jfk-button jfk-button-action "><br>
           </div>
         </form>
     </div>
     <div id="footer">
     </div>
    </div>
  </body>

</html>
