<!DOCTYPE html>
<html>

<?php include 'process.php';

if ( $_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $result = get_route($id);
    $name = $result['name'];
    $childFirstname =  $result['childFirstname'];
    $telephone =  $result['telephone'];
    $email =  $result['email'];
    $addressHome =   $result['addressHome'];
    $cityHome =  $result['cityHome'];
    $cityZip =  $result['cityZip'];
    $classified = $result['classified'];

}
$url = htmlspecialchars(get_config('url'));
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <title>myapp</title>
      <link rel="stylesheet" type="text/css" href="styles/styles.css" />
      <link rel="stylesheet" type="text/css" href="styles/forms.css" />
      <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Play" />
  </head>

  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
  <script type="text/javascript" src="scripts/events.js"></script>

  <body>
    <div id="container">
      <div id="header">
      <div id="banner"></div>
      <br>
      <div class="message">
        <div id="title">
            <h1><a href="<?php echo $url ?>"><?php echo $url ?></a></h1>
            <h1>Entraide Ecole</h1>
            <b>En cas de problème de connexion, envoyez un mail à : <a href="mailto:<?php echo get_config('email')?>"><?php echo get_config('email')?></a></b>
        </div>
        <div id="intro">
            السلام عليكم 
            <br/>
            Besoin d'aide pour emmener ou récupérer vos enfants à l'école ? Personne pour s'en occuper le mercredi ou pendant les vacances scolaires? Vous avez besoin d'un coup de main pour le repas de midi quelques jours par semaine? Vous avez peut-être besoin d'aide pour les devoirs? D'autres parents sont certainement dans le même cas que vous! Pourquoi ne pas s'entraider entre parents de l'école? Ce formulaire à pour but de vous aider à vous mettre en relation des parents proches de votre lieu de résidence ou de travail, et vous aider à trouver des solutions pour le myapp, la garde, la cantine et les devoirs de vos enfants.
            <h2>Remplir le formulaire et accéder aux annonces des parents près de chez vous</h2>
        </div>
      </div>
    </div>

     <div id="content" class="container">
      <div id="form">
        <form action="results2.php" method="get">
          <div class="formLayout">
            <h2>Remplir le formulaire et accéder aux annonces des parents près de chez vous</h2>
            <?php if (!empty($errors)) { ?>
            <h2><div class="error">Complétez tous champs afin de valider votre annonce</div></h2>
            <?php } ?>
            <br>
            <h3><a href="results2.php">Retourner aux résultats</a></h3>
            <br>
            <label  class="my myForm" for="name">Vos nom et prénoms</label>
            <input disabled="disabled" id="name" name="name" class="<?php echo $errors['name'] ?>" value="<?php echo $name ?>" placeholder="Obligatoire" />
            <label class="my myForm" for="parente">Lien de parenté</label>
            <select id="parente" name="parente" disabled="disabled" >
                <option>Mère</option><option>Père</option><option>Grand-Mère</option><option>Grand-Père</option>
                <option>Tante maternelle</option><option>Oncle maternel</option><option>Tante paternelle</option><option>Oncle paternel</option>
                <option>Voisine ou amie des parents</option><option>Voisin ou amie des parents</option>
            </select>
            <br>
            <label  class="my myForm" for="email">Adresse e-mail</label>
            <input disabled="disabled"  id="email" name="email" class="<?php echo $errors['email'] ?>" 
                    value="<?php echo $email ?>" placeholder="Obligatoire" />

            <label  class="my myForm" for="telephone">N° téléphone</label>
            <input disabled="disabled" id="telephone" name="telephone" class="<?php echo $errors['telephone'] ?>" 
                    value="<?php echo $telephone ?>" placeholder="Obligatoire" />
            <br>
            <label  class="my myForm" for="childFirstname">Noms et prénoms des enfants</label>
            <input disabled="disabled" id="childFirstname" name="childFirstname" class="<?php echo $errors['childFirstname'] ?>" 
                   value="<?php echo $childFirstname ?>" placeholder="Obligatoire" />

            <label  class="my myForm" for="childrenNumber">Nombre d'enfants</label>
            <select id="childrenNumber" name="childrenNumber" disabled="disabled">
                <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option>
            </select>
            <br>
            <label for="childrenGrades">Classes des enfants</label>
            <label for="PS">PS</label><input disabled="disabled"   type="checkbox" name="childrenGrades[]" id="PS"  <?php checkbox('childrenGrades', 'PS'); ?> 
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="MS">MS</label><input disabled="disabled"   type="checkbox" name="childrenGrades[]" id="MS"  <?php checkbox('childrenGrades', 'MS'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="GS">GS</label><input disabled="disabled"   type="checkbox" name="childrenGrades[]" id="GS"  <?php checkbox('childrenGrades', 'GS'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CP">CP</label><input disabled="disabled"   type="checkbox" name="childrenGrades[]" id="CP"  <?php checkbox('childrenGrades', 'CP'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CE1">CE1</label><input disabled="disabled" type="checkbox" name="childrenGrades[]" id="CE1" <?php checkbox('childrenGrades', 'CE1'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CE2">CE2</label><input disabled="disabled" type="checkbox" name="childrenGrades[]" id="CE2" <?php checkbox('childrenGrades', 'CE2'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CM1">CM1</label><input disabled="disabled" type="checkbox" name="childrenGrades[]" id="CM1" <?php checkbox('childrenGrades', 'CM1'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <label for="CM2">CM2</label><input disabled="disabled" type="checkbox" name="childrenGrades[]" id="CM2" <?php checkbox('childrenGrades', 'CM2'); ?>  
                                               class="<?php echo $errors['childrenGrades'] ?>" />
            <br>
            <br>
            <br>
            <label  class="my myForm" for="addressHome">Adresse résidence</label>
            <input disabled="disabled" id="addressHome" name="addressHome" placeholder="Adresse approchée sans n° de rue" 
                      value="<?php echo $addressHome ?>" class="<?php echo $errors['addressHome'] ?>"  />

            <label for="zipHome">CP</label>
            <input disabled="disabled" id="zipHome" name="zipHome" 
                    value="<?php echo $zipHome ?>" class="<?php echo $errors['zipHome'] ?>"  />
            
            <label for="cityHome">Ville</label>
            <input disabled="disabled" id="cityHome" name="cityHome"
                   value="<?php echo $cityHome ?>" class="<?php echo $errors['cityHome'] ?>"  />
            <br>

            <label  class="my myForm" for="addressWork">Adresse travail</label>
            <input disabled="disabled" id="addressWork" name="addressWork" placeholder="Adresse approchée sans n° de rue"/>
            <label for="zipWork">CP</label><input disabled="disabled" id="zipWork" name="zipWork" />
            <label for="cityWork">Ville</label><input disabled="disabled" id="cityWork" name="cityWork" /><br>

            <label  class="my myForm" for="addressOther">Autre Adresse</label>
            <input disabled="disabled" id="addressOther" name="addressOther" placeholder="Adresse approchée sans n° de rue"/>
            <label for="zipOther">CP</label><input disabled="disabled" id="zipOther" name="zipOther" />
            <label for="cityOther">Ville</label><input disabled="disabled" id="cityOther" name="cityOther" /><br>
            <br>
            <br>
            <br>

            <label  class="my myForm" class="generalAction">Cherche de l'aide pour : </label>
            <label for="Lu" >Lu</label>
            <label for="Ma" >Ma</label>
            <label for="Me" >Me</label>
            <label for="Je" >Je</label>
            <label for="Ve" >Ve</label>
            
            <label  class="my myForm" class="generalAction">Propose de l'aide pour : </label>
            <label for="Lu" >Lu</label>
            <label for="Ma" >Ma</label>
            <label for="Me" >Me</label>
            <label for="Je" >Je</label>
            <label for="Ve" >Ve</label>
            <br>
            <label id="chercheCovoiturage" for="chercheCovoiturage[]" >Covoiturage/pedibus</label>
            <input disabled="disabled" type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Lu'); ?>/>
            <input disabled="disabled" type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Ma'); ?>/>
            <input disabled="disabled" type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Me'); ?>/>
            <input disabled="disabled" type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Je'); ?>/>
            <input disabled="disabled" type="checkbox" id="chercheCovoiturage[]" name="chercheCovoiturage[]" <?php checkbox('chercheCovoiturage', 'Ve'); ?>/>

            <label id="proposeCovoiturage" for="proposeCovoiturage[]" >Covoiturage/pedibus</label>
            <input disabled="disabled" type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Lu'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Ma'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Me'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Je'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeCovoiturage[]" name="proposeCovoiturage[]" <?php checkbox('proposeCovoiturage', 'Ve'); ?> />
            <br>
            <label id="chercheCantine" for="chercheCantine[]" >Cantine</label>
            <input disabled="disabled" type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Lu'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Ma'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Me'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Je'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheCantine[]" name="chercheCantine[]" <?php checkbox('chercheCantine', 'Ve'); ?> />

            <label id="proposeCantine" for="proposeCantine[]" >Cantine</label>
            <input disabled="disabled" type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Lu'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Ma'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Me'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Je'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeCantine[]" name="proposeCantine[]" <?php checkbox('proposeCantine', 'Ve'); ?> />
            <br>
            <label id="chercheGarderie" for="chercheGarderie[]" >Garderie</label>
            <input disabled="disabled" type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Lu'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Ma'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Me'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Je'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheGarderie[]" name="chercheGarderie[]" <?php checkbox('chercheGarderie', 'Ve'); ?> />

            <label id="proposeGarderie" for="proposeGarderie[]" >Garderie</label>
            <input disabled="disabled" type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Lu'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Ma'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Me'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Je'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeGarderie[]" name="proposeGarderie[]" <?php checkbox('proposeGarderie', 'Ve'); ?> />
            <br>
            <label id="chercheDevoirs" for="chercheDevoirs[]" >Devoirs</label>
            <input disabled="disabled" type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Lu'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Ma'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Me'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Je'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheDevoirs[]" name="chercheDevoirs[]" <?php checkbox('chercheDevoirs', 'Ve'); ?> />

            <label id="proposeDevoirs" for="proposeDevoirs[]" >Devoirs</label>
            <input disabled="disabled" type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Lu'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Ma'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Me'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Je'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeDevoirs[]" name="proposeDevoirs[]" <?php checkbox('proposeDevoirs', 'Ve'); ?> />
            <br>
            <label id="chercheGardeVacances" for="chercheGardeVacances[]" >Vacances</label>
            <input disabled="disabled" type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Lu'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Ma'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Me'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Je'); ?> />
            <input disabled="disabled" type="checkbox" id="chercheGardeVacances[]" name="chercheGardeVacances[]" <?php checkbox('chercheGardeVacances', 'Ve'); ?> />

            <label id="proposeGardeVacances" for="proposeGardeVacances[]" >Vacances</label>
            <input disabled="disabled" type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Lu'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Ma'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Me'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Je'); ?> />
            <input disabled="disabled" type="checkbox" id="proposeGardeVacances[]" name="proposeGardeVacances[]" <?php checkbox('proposeGardeVacances', 'Ve'); ?> />
            <br>
            <br>
            <label class="my myForm" for="classified">Annonce</label>
            <textarea disabled="disabled" id="classified" name="classified" cols="80"><?php echo $classified ?></textarea>            
            <br>
            <br>
            <br>
            </div>
           
            <br>
            <label></label><label></label>
            <input type="submit" name="submit" value="Retour" id="ss-submit" class="jfk-button jfk-button-action ">
            <br>
         </form>
        </div>
     </div>
     <div id="footer">
     </div>
    </div>
  </body>

</html>
