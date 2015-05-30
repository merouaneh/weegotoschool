<html>
  <head>
    <title>Data Loader</title>
  </head>
<?php
  include 'common.php';
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

//  Set the search term.
$search_term = "openshift";
$q_opts = array('q', 'query');
if (true == is_option_set($q_opts) ) {
   $search_term = get_option_value($q_opts);
}

$data_uri = "https://docs.google.com/spreadsheets/d/1sA5KuDSkBm486sZXiC-YPlZDKOSGAr6-CZ_6SF7zApM/export?format=tsv&id=1sA5KuDSkBm486sZXiC-YPlZDKOSGAr6-CZ_6SF7zApM&gid=202053106";

$zeecurl = curl_init($data_uri);
curl_setopt($zeecurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($zeecurl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
$resp = curl_exec($zeecurl);
curl_close($zeecurl);

$array = array_map("str_getcsv", explode("\n", $resp));
$json = json_encode($array);


$decoded_resp = json_decode($json);
//  Insert each line into the MongoDB collection. 
$beancounter = 0;
foreach ($decoded_resp as $k => $v) {
   if ($k == "results") {
      foreach($v as $idx => $tweet) {
         // echo "<br><p>loading item #" . $idx . " : " . print_r($tweet) . "...\n";
         $entry = convertToArray($tweet);
         $entry["search_term"] =  $search_term;
         $collection->insert($entry);
         $beancounter++;
      }
   }
}

echo "<p><b>Search URI: </b><font size='-1'>" . $twitter_uri . "</font>\n";
echo "<br/>\n";
echo "<p><b>Lines Loaded: " . $beancounter . "</b>\n";

?>

    <br><br/>
    You will soon be automatically redirected back to the home page ...
  </body>
</html>