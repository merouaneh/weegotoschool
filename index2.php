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

    $result = validateMandatory('childrenNumber'); 
    $childrenNumber = $result['value'];
    $errors['childrenNumber'] = $result['error'];

    $result = validateMandatory('parente');
    $parente = $result['value'];
    $errors['parente'] = $result['error'];
    
    $result = validateMandatory('telephone');
    $telephone = $result['value'];
    $errors['telephone'] = $result['error'];

    $result = validateMandatory('email');
    $email = $result['value'];
    $errors['email'] = $result['error'];

    // Home
    $result = validateMandatory('addressHome');
    $addressHome = $result['value'];
    $errors['addressHome'] = $result['error'];

    $result = validateMandatory('zipHome');
    $zipHome = $result['value'];
    $errors['zipHome'] = $result['error'];

    $result = validateMandatory('cityHome');
    $cityHome = $result['value'];
    $errors['cityHome'] = $result['error'];

    // Work
    $result = validateMandatory('addressWork');
    $addressWork = $result['value'];
    $errors['addressWork'] = $result['error'];

    $result = validateMandatory('zipWork');
    $zipWork = $result['value'];
    $errors['zipWork'] = $result['error'];

    $result = validateMandatory('cityWork');
    $cityWork = $result['value'];
    $errors['cityWork'] = $result['error'];

    // Other
    $result = validateMandatory('addressOther');
    $addressOther = $result['value'];
    $errors['addressOther'] = $result['error'];

    $result = validateMandatory('zipOther');
    $zipOther = $result['value'];
    $errors['zipOther'] = $result['error'];

    $result = validateMandatory('cityOther');
    $cityOther = $result['value'];
    $errors['cityOther'] = $result['error'];


    // Announce
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
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Play" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style2.css" />

</head>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" src="events.js"></script>

<body>
  <div id="container" class="container">
    <div id="header">
      <div id="banner"></div>
      <div id="title"><h1 class="text-center">Entraide Ecole</h1></div>
      <div id="intro" class="well">
        <p>
         <span class="slm text-center"> <strong>السلام عليكم </strong> </span>        
         <br/>
         Besoin d'aide pour emmener ou récupérer vos enfants à l'école ? Personne pour s'en occuper le mercredi ou pendant les vacances scolaires? Vous avez besoin d'un coup de main pour le repas de midi quelques jours par semaine? Vous avez peut-être besoin d'aide pour les devoirs? D'autres parents sont certainement dans le même cas que vous! Pourquoi ne pas s'entraider entre parents de l'école? Ce formulaire à pour but de vous aider à vous mettre en relation des parents proches de votre lieu de résidence ou de travail, et vous aider à trouver des solutions pour le myapp, la garde, la cantine et les devoirs de vos enfants.

       </p>

     </div>
   </div>
   <div id="content" class="">
     <div class="text-center"> 
      <a href="results.php" class=" ">
        <button type="button" class="btn btn-primary btn-lg">Accéder directement aux résultats
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>

        </button>

      </a></div>
      <div class="text-center"> <strong class="or">ou</strong></div>
      <h4 class="text-center">Remplir le formulaire et accéder aux annonces des parents près de chez vous:</h4>

      <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <div class="">

       <div class="container well">
         <div class="col-sm-12">
            <h4>Information générale</h4>
            <div class="panel panel-default">
              <div class="panel-body form-horizontal aide-form">
                <div class="form-group">
                  <label for="concept" class="col-sm-3 control-label">Nom et prénom</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Adress email</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                  </div>
                </div> 
                <div class="form-group">
                  <label for="status" class="col-sm-3 control-label">Lien de parenté</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="parente" name="parente">
                      <option></option>
                      <option value="M"  <?php echo ($parente == 'M'  ? selected : '') ?>>Mère</option>
                      <option value="P"  <?php echo ($parente == 'P'  ? selected : '') ?>>Père</option>
                      <option value="GP" <?php echo ($parente == 'GP' ? selected : '') ?>>Grand-père</option>
                      <option value="GM" <?php echo ($parente == 'GM' ? selected : '') ?>>Grand-mère</option>
                      <option value="O"  <?php echo ($parente == 'O'  ? selected : '') ?>>Oncle</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="amount" class="col-sm-3 control-label">Nombre d'enfant</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control"  min=1 max=6 id="childrenNumber" name="childrenNumber" value="<?php echo $childrenNumber ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Enfants informations</label>
                  <div class="col-sm-9">
                    <textarea placeholder="noms, age..." class="form-control" rows="3" 
                              id="childFirstname" name="childFirstname" ><?php echo $childFirstname ?></textarea>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="status" class="col-sm-3 control-label">Classes des enfants</label>
                  <div class="col-sm-9">
                    <div class="btn-group" data-toggle="buttons" id="childrenGrades">
                      <label class="btn btn-success <?php active('childrenGrades', 'PS'); ?>">
                        <input type="checkbox" name="childrenGrades[]" autocomplete="off" <?php checkbox('childrenGrades', 'PS'); ?> >
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="">PS</span>
                      </label>

                      <label class="btn btn-success <?php active('childrenGrades', 'MS'); ?>">
                        <input type="checkbox" name="childrenGrades[]" autocomplete="off" <?php checkbox('childrenGrades', 'MS'); ?> >
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="">MS</span>
                      </label>
                      <label class="btn btn-success <?php active('childrenGrades', 'GS'); ?>">
                        <input type="checkbox" name="childrenGrades[]" autocomplete="off" <?php checkbox('childrenGrades', 'GS'); ?> >
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="">GS</span>
                      </label>
                      <label class="btn btn-primary <?php active('childrenGrades', 'CP'); ?>">
                        <input type="checkbox" name="childrenGrades[]" autocomplete="off" <?php checkbox('childrenGrades', 'CP'); ?> >
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="">CP</span>
                      </label>      

                      <label class="btn btn-primary <?php active('childrenGrades', 'CE1'); ?>">
                        <input type="checkbox" name="childrenGrades[]" autocomplete="off" <?php checkbox('childrenGrades', 'CE1'); ?> >
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="">CE1</span>
                      </label>      

                      <label class="btn btn-primary <?php active('childrenGrades', 'CE2'); ?>">
                        <input type="checkbox" name="childrenGrades[]" autocomplete="off" <?php checkbox('childrenGrades', 'CE2'); ?> >
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="">CE2</span>
                      </label>      

                      <label class="btn btn-info <?php active('childrenGrades', 'CM1'); ?>">
                        <input type="checkbox" name="childrenGrades[]" autocomplete="off" <?php checkbox('childrenGrades', 'CM1'); ?> >
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="">CM1</span>
                      </label>      

                      <label class="btn btn-info <?php active('childrenGrades', 'CM2'); ?>">
                        <input type="checkbox" name="childrenGrades[]" autocomplete="off" <?php checkbox('childrenGrades', 'CM2'); ?>>
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="">CM2</span>
                      </label>      
                    </div>

                  </div>
                </div> 
                <div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Votre annonce</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" rows="3" 
                              id="classified" name="classified" placeholder="Entrer ici des détails de l'annonce: Par exemple: J'ai une voiture 4 places. Je travaille à Villemomble"><?php echo $classified ?></textarea>
                  </div>
                </div> 
              </div>
            </div>            
        </div>

        <div class="col-sm-12">
            <h4>Adress</h4>
            <div class="panel panel-default">
              <div class="panel-body form-horizontal ">
                <div class="form-group">
                  <label for="concept" class="col-sm-2 control-label">Adress1</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="addressHome" name="addressHome" value=<?php echo $addressHome ?> >
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="zipHome" name="zipHome" value=<?php echo $zipHome ?> >
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="cityHome" name="cityHome" value=<?php echo $cityHome ?> >
                  </div>

                </div>
                <div class="form-group">
                  <label for="concept" class="col-sm-2 control-label">Adress2</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="addressWork" name="addressWork" value=<?php echo $addressWork ?> >
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control"  name="zipWork" id="zipWork" value=<?php echo $zipWork ?> >
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control"  name="cityWork" id="cityWork" value=<?php echo $cityWork ?> >
                  </div>

                </div>
                <div class="form-group">
                  <label for="concept" class="col-sm-2 control-label">Adress3</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="addressOther" id="addressOther" value=<?php echo $addressOther ?> >
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control"  name="zipOther" id="zipOther" value=<?php echo $zipOther ?> >
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control"  name="cityOther" id="cityOther" value=<?php echo $cityOther ?> >
                  </div>

                </div>

              </div>
            </div>            
        </div>

          <div class="col-sm-12">
            <h4>Information sur l'aide</h4>
            <div class="panel panel-default">
              <div class="panel-body form-horizontal aide-form">
                <!-- panel preview -->
                <div class="col-sm-5">
                  <h4>ajouter une demande ou une proposition:</h4>
                  <div class="panel panel-default">
                    <div class="panel-body form-horizontal aide-form">

                      <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">Type de demande</label>
                        <div class="col-sm-9">
                          <select class="form-control" id="status" name="type">
                            <option>Demande</option>
                            <option>Proposition</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">Type d'aide</label>
                        <div class="col-sm-9">
                          <select class="form-control" id="status" name="aide">
                            <option>Covoiturage</option>
                            <option>Aide aux devoirs</option>
                            <option>Garderie</option>
                            <option>Cantine</option>
                            <option>Garde vacances</option>
                          </select>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label for="days" class="col-sm-3 control-label">Jours</label>
                        <div class="col-sm-9 btn-group" data-toggle="buttons" id="days">
                            <label class="btn btn-sm btn-success <?php active('days', 'L'); ?>">
                                <input type="checkbox" name="days[]" autocomplete="off" <?php checkbox('days', 'L'); ?> >
                                <span class="glyphicon glyphicon-ok"></span>
                                <span class="">L</span>
                            </label>
                            <label class="btn btn-sm btn-primary <?php active('days', 'M'); ?>">
                                <input type="checkbox" name="days[]" autocomplete="off" <?php checkbox('days', 'M'); ?> >
                                <span class="glyphicon glyphicon-ok"></span>
                                <span class="">M</span>
                            </label>
                            <label class="btn btn-sm btn-info <?php active('days', 'Me'); ?>">
                                <input type="checkbox" name="days[]" autocomplete="off" <?php checkbox('days', 'Me'); ?> >
                                <span class="glyphicon glyphicon-ok"></span>
                                <span class="">Me</span>
                            </label>
                            <label class="btn btn-sm btn-primary <?php active('days', 'J'); ?>">
                                <input type="checkbox" name="days[]" autocomplete="off" <?php checkbox('days', 'J'); ?> >
                                <span class="glyphicon glyphicon-ok"></span>
                                <span class="">J</span>
                            </label>
                            <label class="btn btn-sm btn-success <?php active('days', 'V'); ?>">
                                <input type="checkbox" name="days[]" autocomplete="off" <?php checkbox('days', 'V'); ?> >
                                <span class="glyphicon glyphicon-ok"></span>
                                <span class="">V</span>
                            </label>
                        </div>   
                      <div class="form-group">
                        <div class="col-sm-12 text-right">
                          <button type="button" class="btn btn-default preview-add-button">
                            <span class="glyphicon glyphicon-plus">Add</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>            
                </div> <!-- / panel preview -->
                <div class="col-sm-7">
                  <h4>Preview:</h4>
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="table-responsive">
                        <table class="table preview-table">
                          <thead>
                            <tr>
                              <th>Type</th>
                              <th>Aide</th>
                              <th>Jours</th>
                            </tr>
                            <tr>
                              <td class="input-type">Demande</td>
                              <td class="input-class">Covoiturage</td>
                              <td class="input-days">Lu Ma Me Je Ve</td>
                              <td class="input-remove-row"><span class="glyphicon glyphicon-remove"></span></td>
                            </tr>
                          </thead>
                          <tbody></tbody> <!-- preview content goes here-->
                        </table>
                      </div>                            
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <hr style="border:1px dashed #dddddd;">
                <input type="submit" class="btn btn-primary btn-block" value="Envoyer" >
              </div>                
            </div>
        </div>
      </div>

    </div>
   </form>

  </div>
  <div id="footer">
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
  function calc_total(){
    var sum = 0;
    $('.input-amount').each(function(){
      sum += parseFloat($(this).text());
    });
    $(".preview-total").text(sum);    
  }
  $(document).on('click', '.input-remove-row', function(){ 
    var tr = $(this).closest('tr');
    tr.fadeOut(200, function(){
      tr.remove();
      calc_total()
    });
  });

  $(function(){
    $('.preview-add-button').click(function(){
      var form_data = {};
      form_data["type"] = $('.aide-form select[name="type"]').val();
      form_data["aide"] = $('.aide-form select[name="aide"]').val();
      form_data["days"] =  $('.aide-form input[name="days"]').val();
        form_data["remove-row"] = '<span class="glyphicon glyphicon-remove"></span>';
      console.log(form_data);
      var row = $('<tr></tr>');
      $.each(form_data, function( type, value ) {
        $('<td class="input-'+type+'"></td>').html(value).appendTo(row);
      });
      $('.preview-table > tbody:last').append(row); 
      calc_total();
    });  
  });

    $('#childrenGrades label').eq(n).button('toggle');


</script>
</body>

</html>