<?php
include 'common.php';

$json = json_encode($_POST);
echo $json;
?>

/*
//  Check if we need to recreate the collection.
$r_opts = array('r', 'recreate');
if (true == is_option_set($r_opts) ) {
   $collection = get_collection(ROUTES_COLLECTION);
   $collection->drop();
}
//  Get tweets collection in MongoDB and last tweet ID.
$collection = get_collection(ROUTES_COLLECTION);
$lastobj    = $collection->findOne();
$lastid     = $lastobj["id"];


$collection = get_collection(ROUTES_COLLECTION);
$collection->insert($json);

echo $collection;
?>
<br>
<br>
<?php 
echo "Collection inseree";
$collection = get_collection(ROUTES_COLLECTION);
echo $collection;



?>
*/