<?php
include 'common.php';
include 'data.php';

function submit() {
    // $_POST['classified'] = nl2br($_POST['classified']);

    $_POST['addressHome'] = s_obfuscateAddress($_POST['addressHome'] );
    $_POST['addressWork'] = s_obfuscateAddress($_POST['addressWork'] );
    $_POST['addressOther'] = s_obfuscateAddress($_POST['addressOther'] );


    $_POST['cityHome'] =  ucfirst(strtolower($_POST['cityHome'] ));
    $_POST['cityWork'] =  ucfirst(strtolower($_POST['cityWork'] ));
    $_POST['cityOther'] =  ucfirst(strtolower($_POST['cityOther'] ));


    $json = json_encode($_POST);
    $decoded_resp = json_decode($json);

    $collection = get_collection(ROUTES_COLLECTION);
    $collection->insert($decoded_resp);
    header('Location: results2.php?success');    
}

?>
