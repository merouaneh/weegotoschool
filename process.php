<?php
include 'common.php';

$_POST['classified'] = htmlspecialchars(nl2br($_POST['classified']));
$json = json_encode($_POST);
$decoded_resp = json_decode($json);

$collection = get_collection(ROUTES_COLLECTION);
$collection->insert($decoded_resp);
header('Location: results.php?success');
?>
