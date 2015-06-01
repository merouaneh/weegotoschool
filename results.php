<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>myapp</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="stylesheet" type="text/css" href="tables.css" />
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
          <!--div id="coran" class="coran arabic"></div><br/><div class="arabic"></div-->
          <br/>
          Besoin d'aide pour emmener ou récupérer vos enfants à l'école ? Personne pour s'en occuper le mercredi ou pendant les vacances scolaires? Vous avez besoin d'un coup de main pour le repas de midi quelques jours par semaine? Vous avez peut-être besoin d'aide pour les devoirs? D'autres parents sont certainement dans le même cas que vous! Pourquoi ne pas s'entraider entre parents de l'école? Ce formulaire à pour but de vous aider à vous mettre en relation des parents proches de votre lieu de résidence ou de travail, et vous aider à trouver des solutions pour le myapp, la garde, la cantine et les devoirs de vos enfants.
      </div>
      <div id="form">
        <form id="form2" method="get" action="index.php">
          <input type="submit" name="submit" value="Retour" id="ss-submit" class="jfk-button jfk-button-action ">
       </form>
      </div>

       <div id="content" class="container">
        <div id="left" class="column">
          <div id="map"></div>
        </div>
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
              <div class="mycell cov" name="covoiturage"><label for="route_1" class="cov"></label></div>
              <div class="mycell gar" name="garderie"><label for="route_1" class="gar"></label></div>
              <div class="mycell dev" name="devoirs"><label for="route_1" class="dev"></label></div>
              <div class="mycell vac" name="vacances"><label for="route_1" class="vac"></label></div>
              <div class="mycell can" name="cantine"><label for="route_1" class="can"></label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input  name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                      value="1" id="route_1"
                      address="5 avenue Maurice Utrillo, Montmagny" 
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
                          address="5 avenue Maurice Utrillo, Argenteuil" 
                          label="&lt;b&gt;Oum Aisse&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_2">Oum Amine</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="3" id="route_3"
                          address="5 avenue Maurice Utrillo, Villepinte" 
                          label="&lt;b&gt;Oum Hajer&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_3">Abou Issa</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="4" id="route_4"
                          address="5 avenue Maurice Utrillo, Villetaneuse" 
                          label="&lt;b&gt;Abou Amel&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_4">Oum Hajer</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="5" id="route_5"
                          address="5 avenue Maurice Utrillo, Villetaneuse" 
                          label="&lt;b&gt;Abou Amel&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_5">Oum Salama</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="6" id="route_6"
                          address="5 avenue Maurice Utrillo, Villetaneuse" 
                          label="&lt;b&gt;Abou Amel&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_6">Oum Amel</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="7" id="route_7"
                          address="5 avenue Maurice Utrillo, Villetaneuse" 
                          label="&lt;b&gt;Abou Amel&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_7">Abou Houreira</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="8" id="route_8"
                          address="5 avenue Maurice Utrillo, Montreuil" 
                          label="&lt;b&gt;Abou Amel&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_8">Abou Anas</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
             
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="9" id="route_9"
                          address="5 avenue Maurice Utrillo, Paris" 
                          label="&lt;b&gt;Abou Amel&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_9">Oum Othman</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="10" id="route_10"
                          address="5 avenue Maurice Utrillo, Chantilly" 
                          label="&lt;b&gt;Abou Amel&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_10">Ibn Abbas</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
            <div class="myrow">
              <div class="mycell" name="address" >
                <input    name="route" type="checkbox" checked="true" onChange="handleChange(this)" 
                          value="11" id="route_11"
                          address="5 avenue Maurice Utrillo, Epinay" 
                          label="&lt;b&gt;Abou Amel&lt;/b&gt;"
                          content = "&lt;i&gt;Je peux emmenener 3 enfants, j'ai une voiture 4 places&lt;/i&gt;" />
              </div>
              <div class="mycell" name="addressLabel"><label for="route_11">Abou Esra</label></div>
              <div class="mycell" name="covoiturage"><label for="route_1" class="activity cov-ask-give">cC</label></div>
              <div class="mycell" name="garderie"><label for="route_1" class="activity gar-give">gG</label></div>
              <div class="mycell" name="devoirs"><label for="route_1" class="activity dev-ask activity">dD</label></div>
              <div class="mycell" name="vacances"><label for="route_1" class="activity vac-ask">vV</label></div>
            </div>
          </div>
        </div>
       </div>
       
       <div id="footer">
       </div>
      </div>
    </body>
    <script type="text/javascript" src="maps.js"></script>
    <script type="text/javascript" src="init.js"></script>
    <script type="text/javascript" src="events.js"></script>

</html>
