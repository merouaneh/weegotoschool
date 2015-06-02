<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>myapp</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="stylesheet" type="text/css" href="tables.css" />
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
          <div id="title">
            <h1>Entraide Ecole</h1>
          </div>
          <div id="intro">
              السلام عليكم 
              <br/>
             Retrouvez ici les parents des camarades de classes de vos enfants et proposez-leur votre aide.
          </div>
          <br>
          <div id="form">
            <?php if( isset($_GET['success'] )) { ?> 
             <h2>Félicitations votre annonce a été correctement ajoutée</h2>
            <?php } ?>
              <form id="form2" method="get" action="index.php">
              <input type="submit" name="submit" value="Retour" id="ss-submit" class="jfk-button jfk-button-action ">
           </form>
           <br>
          </div>
        </div>
      </div>

       <div id="content" class="container">
        <div id="right" class="column">
          <div name="addresses" class="mytable">
            <div class="column1"></div>
            <div class="column2"></div>
            <div class="column3"></div>
            <div class="column3"></div>
            <div class="column3"></div>
            <div class="column3"></div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input name="route" type="checkbox" checked="true" disabled="true" 
                       value="0" id="route_0"
                       address="113 avenue Louis Breguet, Villepinte" 
                       label="&lt;b&gt;Ecole&lt;/b&gt;"/>
              </div>
              <div class="mycell"><label for="route_0">Ecole</label></div>
              <div class="mycell cov-icon" name="covoiturage"><label for="route_0" class="cov"></label></div>
              <div class="mycell gar-icon" name="garderie"><label for="route_0" class="gar"></label></div>
              <div class="mycell dev-icon" name="devoirs"><label for="route_0" class="dev"></label></div>
              <div class="mycell vac-icon" name="vacances"><label for="route_0" class="vac"></label></div>
              <div class="mycell can-icon" name="cantine"><label for="route_0" class="can"></label></div>
            </div>

            <div class="myrow">
              <div class="mycell" name="address" >
                <input  name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                      value="1" id="route_1"
                      address="avenue Maurice Utrillo, Montmagny" 
                      label="&lt;b&gt;Oum Esra&lt;/b&gt;"
                      content = "&lt;i&gt;&lt;br/&gt;Salamalikoum,Je propose d'enmener vos enfants le matin à 8h15 les lundi, mardi, jeudi et vendredi et de recuperer le vendredi à 16h30.&lt;br/&gt;&lt;br/&gt;J'habite montmagny et je peux m'arrêter pour prendre vos enfants sur les villes de Pierrefitte sur seine et de Saint denis (lycée Paul Eluard ou  hopital  de la fontaine. &lt;br/&gt;&lt;br/&gt;J'ai 2 places de disponible à l'arrière et une place à l'avant. Je suis à la recherche d'un co voiturage pour récuperer ma fille à l'ecole à 16h30 et me la ramener à Aulnay (lieu ou je travaille) les lundi, mardi et jeudi et éventuellement me la garder jusqu'a 17H45&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_1">Oum Esra</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
              <div class="mycell" name="cantine"><label for="route_1" class="activity can-ask">cC</label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="2" id="route_2"
                          address="avenue Maurice Utrillo, Argenteuil" 
                          label="&lt;b&gt;Oum Aissé&lt;/b&gt;"
                          content = "Je peux emmenener 3 enfants, j'ai une voiture 4 places" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_2">Oum Amine</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>

            <?php include 'common.php';
            $collection = get_collection(ROUTES_COLLECTION);
            $cursor = $collection->find();
            $i = 1;
            foreach ( $cursor as $id => $value ) {
              $route = 'route_'.$i;
              $address = $value['addressHome'] . ', ' . $value['zipHome'] . ' ' . $value['cityHome'];
              $vac = 'vac' . (isset( $value['chercheGardeVacances']) ? '-ask' : '') . (isset( $value['proposeGardeVacances'])    ? '-give' : '' );
              $cov = 'cov' . (isset( $value['chercheCovoiturage']) ? '-ask' : '') . (isset( $value['proposeCovoiturage']) ? '-give' : '' );
              $gar = 'gar' . (isset( $value['chercheGarderie'])    ? '-ask' : '') . (isset( $value['proposeGarderie'])    ? '-give' : '' );
              $dev = 'dev' . (isset( $value['chercheDevoirs'])     ? '-ask' : '') . (isset( $value['proposeDevoirs'])     ? '-give' : '' );
              $can = 'can' . (isset( $value['chercheCantine'])     ? '-ask' : '') . (isset( $value['proposeCantine'])     ? '-give' : '' );
            ?>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input  name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                      value="<?php echo $i; ?>" id="<?php echo $route; ?>" 
                      address="<?php echo $address; ?>" 
                      label="<b><?php echo $value['name']; ?></b>"
                      content="<?php echo $value['classified']; ?>" />
              </div>
              <div class="mycell" name="nameLabel"><label for="<?php echo $route; ?>"><?php echo $value['name'] ?></label></div>
              <div class="mycell" name="covoiturage"><label for="<?php echo $route; ?>" class="activity <?php echo $cov; ?>">cC</label></div>
              <div class="mycell" name="garderie"><label for="<?php echo $route; ?>" class="activity <?php echo $gar; ?>">gG</label></div>
              <div class="mycell" name="devoirs"><label for="<?php echo $route; ?>" class="activity <?php echo $dev; ?>">dD</label></div>
              <div class="mycell" name="vacances"><label for="<?php echo $route; ?>" class="activity <?php echo $vac; ?>">vV</label></div>
              <div class="mycell" name="cantine"><label for="<?php echo $route; ?>" class="activity <?php echo $can; ?>">cC</label></div>
            </div>
            <?php $i++; } ?>
          </div>
         </div>

        <div id="left" class="column">
          <div id="map"></div>
        </div>
      </div>
      <div id="footer"></div>
     </div>
    </body>
    <script type="text/javascript" src="maps.js"></script>
    <script type="text/javascript" src="init.js"></script>
    <script type="text/javascript" src="events.js"></script>
</html>
