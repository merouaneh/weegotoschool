<!DOCTYPE html>
<html>
<?php include 'process.php'; 
$cities = "";
if ( $_SERVER["REQUEST_METHOD"] == "POST") {
    $cities = $_POST['cities'];
}
?>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>myapp</title>
        <link rel="stylesheet" type="text/css" href="styles/styles.css" />
        <link rel="stylesheet" type="text/css" href="styles/tables.css" />
        <link rel="stylesheet" type="text/css" href="styles/forms.css" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Play" />
         <link rel="stylesheet" type="text/css" href="styles/sumoselect.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="scripts/jquery.sumoselect.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function () {
              $('.cityselect').SumoSelect({ selectAll: true, placeholder: 'Selectionner ville(s)'});
              $('.childrenGrades').SumoSelect({ selectAll: true, placeholder: 'Selectionner classes'});
              $('.services').SumoSelect({ selectAll: true, placeholder: 'Selectionner services'});
          });
        </script>
    </head>
    <body>
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
      <div id="container">
        <div id="header">
        <div id="banner"></div>
        <div class="message">
          <div id="title">
            <h1>Entraide Ecole</h1>
          </div>
          <div id="intro">
             Retrouvez ici les parents des camarades de classes de vos enfants et proposez-leur votre aide. السلام عليكم
          </div>
          <div id="form">
            <div class="formLayout">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                  <h2>Filtrer les résultats de la recherche:</h2>
                  <br>
                  <br>
                  <div class="SumoSelect">
                    <select id="cities[]" name="cities[]" multiple="multiple" class="cityselect">
                      <? get_select_options_for_fiels('cities', array('cityHome', 'cityWork', 'cityOther'));?>
                    </select>
                  </div>
                  <div class="SumoSelect">
                    <select id="childrenGrades[]" name="childrenGrades[]" multiple="multiple" class="childrenGrades"><? get_select_options('childrenGrades', 'childrenGrades');?></select>
                  </div>
                  <div class="SumoSelect">
                    <select id="services[]" name="services[]" multiple="multiple" class="services">
                      <option value="chercheCovoiturage"><label for="chercheCovoiturage[]">Covoiturage</label></option>
                    </select>
                  </div>
                  <br>
                  <br>
                  <br>
                  <input type="submit" name="submit" value="Rechercher" id="ss-submit" class="jfk-button jfk-button-action ">
                </form>
                <form id="form2" method="get" action="index.php">
                  <input type="submit" name="submit" value="Retour" id="ss-submit" class="jfk-button jfk-button-action ">
                  <a href="results.php"><input type="button" name="carte" value="Carte (Expérimental)" id="ss-submit-map" class="jfk-button jfk-button-action" ></a>
                </form>
                <br>
                <br>
              </div>
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
            <?php
            $cursor = get_routes($cities);
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
                      data-content="<?php echo str_replace(array("\n","\r"), '', nl2br($value['classified'])); ?>" />
              </div>
              <div class="mycell"><label for="<?php echo $route; ?>"><label><b><a href="details.php?id=<?php echo $value['_id']; ?>"><?php echo $value['name']; ?></a></b></label></label></div>
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
