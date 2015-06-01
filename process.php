<?php
$json = json_encode($_POST);

echo $json

include 'common.php';
$collection = get_collection(ROUTES_COLLECTION);
$collection->insert($json);




?>
