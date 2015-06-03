<!DOCTYPE html>
<html>
<?php include 'process.php';

$cities = "";
if ( $_SERVER["REQUEST_METHOD"] == "POST") {
    $cities = $_POST['cities'];
}
$services = "";
if ( $_SERVER["REQUEST_METHOD"] == "POST") {
    $services = $_POST['services'];
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
             Retrouvez ici les parents des camarades de classes de vos enfants et proposez-leur votre aide. السلام عليكم
          </div>
          <div id="form">
            <?php if( isset($_GET['success'] )) { ?> 
             <h2>Félicitations votre annonce a été correctement ajoutée</h2>
            <?php } ?>
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
           <br>
          </div>
        </div>
      </div>
       <div id="content" class="container">
          <div class="formLayout">
            <h3>Légende</h3>
            <br>
            <label id="covoiturage" for="covoiturage" class="cov-icon">Covoiturage</label>
            <label id="cantine" for="cantine" class="can-icon">Cantine</label>
            <label id="garderie" for="garderie" class="gar-icon">Garderie</label>
            <label id="devoirs" for="devoirs" class="dev-icon">Devoirs</label>
            <label id="gardeVacances" for="gardeVacances" class="vac-icon">Vacances</label>
            <br>
            <label for="propose" id="" class="giv-icon">Propositions</label>
            <label for="recherche" class="ask-icon">Recherches</label>
            <label> </label>
            <label> </label>
            <label> </label>
            <br>
          </div>
          <br>
          <div id="addresses" class="mytable">
            <div class="column2"></div>
            <div class="column2"></div>
            <div class="column3"></div>
            <div class="column1"></div>
            <div class="column4"></div>
            <div class="column1"></div>
            <div class="column1"></div>
            <div class="myrow">
              <div class="mycell"><label>Nom</label></div>
              <div class="mycell"><label>Ville</label></div>
              <div class="mycell"><label>Adresse</label></div>
              <div class="mycell"><label>e-mail</label></div>
              <div class="mycell"><label>Annonce</label></div>
              <div class="mycell cov-icon"><label for="route_0" class="cov"  title="Covoiturage"></label></div>
              <div class="mycell gar-icon" ><label for="route_0" class="gar" title="Garderie"></label></div>
              <div class="mycell dev-icon"><label for="route_0" class="dev"  title="Aide aux devoirs"></label></div>
              <div class="mycell vac-icon"><label for="route_0" class="vac"  title="Vacances"></label></div>
              <div class="mycell can-icon"><label for="route_0" class="can"  title="Cantine	"></label></div>
            </div>
            <?php 
            $collection = get_collection(ROUTES_COLLECTION);
            $submitted_cities = $_POST['cities'];
            $empty = empty($submitted_cities);
            $posted = ( isset($submitted_cities) && !$empty );
            $cities_array = implode("','", $cities);
            $cursor = "";
            if( $posted ) {
            // $query = array ( '$or' => array ( 'cityHome' =>  array (  '$in' =>  $cities,  ), ) ;
             $query = array ( '$or' => array ( 0 => array ( 'cityWork'  => array ( '$in' => $cities, ),  ),
                                               1 => array ( 'cityHome'  => array ( '$in' => $cities, ),  ),
                                               2 => array ( 'cityOther' => array ( '$in' => $cities, ),  ),
                                             ),
                            ); 
             $cursor = $collection->find($query);
            } else {
             $cursor = $collection->find();
            }
            $i = 1;
            $c = true;
            foreach ( $cursor as $id => $value ) {
              $row_class = (($c = !$c) ? " even " : " odd");
              $route = 'route_'.$i;
              $address = $value['addressHome'] . '<br/> ' . $value['zipHome'] . ' ' . $value['cityHome'];
              $city =  $value['cityHome'];
              if ( $value['addressWork'] != "" ) {
                $address = $address . "<br>" . $value['addressWork'] . '<br/> ' . $value['zipWork'] . ' ' . $value['cityWork'];
                $city =  $city ."<br><br>" . $value['cityWork'];
              }
              if ( $value['addressOther'] != "" ) {
                $address = $address . "<br>" . $value['addressOther'] . '<br/> ' . $value['zipOther'] . ' ' . $value['cityOther'];
                $city =  $city ."<br><br>" . $value['cityOther'];
              }

              $cov = 'cov' . (isset( $value['chercheCovoiturage'])   ? '-ask' : '') . (isset( $value['proposeCovoiturage'])      ? '-give' : '' );
              $gar = 'gar' . (isset( $value['chercheGarderie'])      ? '-ask' : '') . (isset( $value['proposeGarderie'])         ? '-give' : '' );
              $dev = 'dev' . (isset( $value['chercheDevoirs'])       ? '-ask' : '') . (isset( $value['proposeDevoirs'])          ? '-give' : '' );
              $vac = 'vac' . (isset( $value['chercheGardeVacances']) ? '-ask' : '') . (isset( $value['proposeGardeVacances'])    ? '-give' : '' );
              $can = 'can' . (isset( $value['chercheCantine'])       ? '-ask' : '') . (isset( $value['proposeCantine'])          ? '-give' : '' );
            ?>
            <div class="myrow <?php echo $row_class ?>">
              <div class="mycell"><label><b><a href="details.php?id=<?php echo $value['_id']; ?>"><?php echo $value['name']; ?></a></b></label></div>
              <div class="mycell"><label><b><?php echo $city; ?></b></label></div>
              <div class="mycell"><label><b><?php echo $address; ?></b></label></div>
              <div class="mycell"><label><b><?php echo $value['email']; ?></b></label></div>
              <div class="mycell"><label><b><?php echo nl2br($value['classified']); ?></b></label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $cov; ?>">cC</label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $gar; ?>">gG</label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $dev; ?>">dD</label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $vac; ?>">vV</label></div>
              <div class="mycell"><label for="<?php echo $route; ?>" class="activity <?php echo $can; ?>">cC</label></div>
            </div>
            <?php $i++; } ?>
         </div>
      </div>
      <div id="footer"></div>
     </div>
     <script type="text/javascript" src="scripts/events.js"></script>
    </body>
</html>
