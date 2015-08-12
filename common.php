<?php

  define("OPENSHIFT_DB",      "covoiturage");
  define("ROUTES_COLLECTION", "routes");
  define("CONFIG_COLLECTION", "config");
  define("USERS_COLLECTION", "users");

  function is_option_set($opts) {
     foreach ($opts as $k => $v) {
        if (true == isset($_GET[$v]) ) {
           return true;
        }
     }

     return false;
  }

  function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }

  function get_option_value($opts) {
     foreach ($opts as $k => $v) {
        if (true == isset($_GET[$v]) ) {
           return $_GET[$v];
        }
     }

     return NULL;
  }

  function convertToArray($zobject) {
     if (is_object($zobject) )
        return get_object_vars($zobject);
     else if (is_array($zobject) )
        /* Convert to object using __FUNCTION__ for recursive call.  */
        return array_map(__FUNCTION__, $zobject);
     else
        return $zobject;
  }


  function get_db_connection() {
     $host   = $_ENV["OPENSHIFT_MONGODB_DB_HOST"];
     $user   = $_ENV["OPENSHIFT_MONGODB_DB_USERNAME"];
     $passwd = $_ENV["OPENSHIFT_MONGODB_DB_PASSWORD"];
     $port   = $_ENV["OPENSHIFT_MONGODB_DB_PORT"];

     $uri = "mongodb://" . $user . ":" . $passwd . "@" . $host . ":" . $port;
     $mongo = new Mongo($uri);
     return $mongo;
  }

  function get_database($dbname) {
     $conn = get_db_connection();
     return $conn->$dbname;
  }

  function get_collection($collection) {
     $db = get_database(OPENSHIFT_DB);
     return $db->$collection;
  }

?>


