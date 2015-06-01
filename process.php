<?php
include 'common.php';
$json = json_encode($_POST);
$decoded_resp = json_decode($json);
$collection = get_collection(ROUTES_COLLECTION);
$collection->insert($decoded_resp);
header('Location: results.php?success');
?>
