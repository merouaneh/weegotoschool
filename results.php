<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>myapp</title>
        <link rel="stylesheet" type="text/css" href="styles/styles.css" />
        <link rel="stylesheet" type="text/css" href="styles/tables.css" />
        <link rel="stylesheet" type="text/css" href="styles/forms.css" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Play" />
    </head>
    <body>
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
     <!-- <script type="text/javascript" src="scripts/events.js"></script> -->
      <div id="container">
        <div id="header">
        <div id="banner"></div>
        <div class="message">
          <div id="title">
            <h1>Entraide Ecole</h1>
          </div>
          <div id="intro">
             Retrouvez ici les parents des camarades de classes de vos enfants et proposez-leur votre aide. السلام عليكم
          	 <label for="route_0" class="cov">aaaa</label>
          </div>
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
        <div id="master" class="column">
          <div id="addresses" class="mytable">
            <div class="column1"></div>
            <div class="column2"></div>
            <div class="column3"></div>
            <div class="column3"></div>
            <div class="column3"></div>
            <div class="column3"></div>
            <div class="myrow">
              <div class="mycell" id="address[0]">
                <input name="route" type="checkbox" checked disabled
                       data-value="0" id="route_0"
                       data-address="113 avenue Louis Breguet, Villepinte" 
                       data-label="&lt;b&gt;Ecole&lt;/b&gt;"/>
              </div>
              <div class="mycell"><label for="route_0">Ecole</label></div>
              <div class="mycell cov-icon"><label for="route_0" class="cov"  title="Covoiturage"></label></div>
              <div class="mycell gar-icon" ><label for="route_0" class="gar" title="Garderie"></label></div>
              <div class="mycell dev-icon"><label for="route_0" class="dev"  title="Aide aux devoirs"></label></div>
              <div class="mycell vac-icon"><label for="route_0" class="vac"  title="Vacances"></label></div>
              <div class="mycell can-icon"><label for="route_0" class="can"  title="Cantine	"></label></div>
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
              <div class="mycell" id="address[<?php echo $i; ?>]" >
                <input  name="route" type="checkbox" checked onChange="handleChange(this)" 
                      value="<?php echo $i; ?>" id="<?php echo $route; ?>" 
                      data-address="<?php echo $address; ?>" 
                      data-label="<b><?php echo $value['name']; ?></b>"
                      data-content="<?php echo $value['classified']; ?>" />
              </div>
              <div class="mycell"><label for="<?php echo $route; ?>"><?php echo $value['name'] ?></label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $cov; ?>">cC</label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $gar; ?>">gG</label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $dev; ?>">dD</label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $vac; ?>">vV</label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $can; ?>">cC</label></div>
            </div>
            <?php $i++; } ?>
          </div>
         </div>

        <div id="detail" class="column">
          <div id="map"></div>
        </div>
      </div>
      <div id="footer"></div>
     </div>
      <script type="text/javascript" src="scripts/maps.js"></script>
      <script type="text/javascript" src="scripts/init.js"></script>
      <script type="text/javascript" src="scripts/events.js"></script>
    </body>
</html>
