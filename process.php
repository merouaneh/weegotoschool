<?php
include 'common.php';

$json = json_encode($_POST);
//echo $json;

header('Location: results.php');
?>

