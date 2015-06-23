<?php

/**
 * Removes the first characters of a String until the space char, if the first caracter is a digit.
 * The string is then replaced in $map under the key $key.
 */

function get_routes( $cities) {

    $collection = get_collection(ROUTES_COLLECTION);
    $submitted_cities = $_POST['cities'];
    $empty = empty($submitted_cities);
    $posted = ( isset($submitted_cities) && !$empty );
    $cities_array = implode("','", $cities);
    $cursor = "";
    if( $posted ) {
    // $query = array ( '$or' => array ( 'cityHome' =>  array (  '$in' =>  $cities,  ), ) ;
     $query = array ( '$or' => array ( 0 => array ( 'cityWork'  => array ( '$in' => $cities, ),  ),
                                       1 => array ( 'cityHome'  => array ( '$in' => $cities, ),  ),
                                       2 => array ( 'cityOther' => array ( '$in' => $cities, ),  ),
                                     ),
                    ); 
     $cursor = $collection->find($query);
    } else {
     $cursor = $collection->find();
    }
    return $cursor;
} 


function user_exists($username) {
    $collection = get_collection(USERS_COLLECTION);
    $object = $collection->findOne( array('username' =>  $username ));
    return $object['username'];
}

function get_user($username, $password) {
    $collection = get_collection(USERS_COLLECTION);
    $object = $collection->findOne( array('username' =>  $username ,  'password' => $password,));
    return $object['username'];
}

function get_route($id) {
    $collection = get_collection(ROUTES_COLLECTION);
    $object = $collection->findOne(array('_id' =>  new MongoId($id) ));
    return $object;
}


function isChecked($checkboxes,$value)  {
    if(!empty($_POST[$checkboxes])) {
        foreach($_POST[$checkboxes] as $chkval) {
            if($chkval == $value) {
                return true;
            }
        }
    }
    return false;
}

function checkbox($checkboxes,$value)  {
    $checked = isChecked($checkboxes,$value) ? "\" checked" : "\"" ;
    echo "value=\"" . $value . $checked;
}

function active($checkboxes,$value)  {
    echo  isChecked($checkboxes,$value)  ? "active" : "";
}

function get_config($param) {
    $collection = get_collection(CONFIG_COLLECTION);
    $cursor = $collection->distinct($param);
    $result = "";
    foreach ( $cursor as $value ) {
        if($result != "" ) {
            $result = $result . ',';
        }
        $result = $result . $value;
    }
    return $result;
}


function get_select_options_for_fiels($input, $fields) {
    $collection = get_collection(ROUTES_COLLECTION);
    $submitted_values = $_POST[$input];
    $empty = empty($submitted_values);
    $posted = ( isset($submitted_values) && !$empty );
    $search = array();
    foreach ( $fields as $field ) {
        $cursor = $collection->distinct($field);
        foreach ( $cursor as $value ) {
            $value = ucfirst(strtolower($value));
            $selected = ( !$posted || $empty || ( $posted && (in_array($value, $submitted_values) )) ? ' selected="selected" ' : ''); 
            if( $value != '' && !array_search(strtolower($value), array_map('strtolower', $search)) ) {
                array_push($search, $value);
                echo '<option' . $selected. ' value="' .$value. '">' .$value. '</option>';
            }
        }
    }
}

function get_select_options($input, $field) {
    $collection = get_collection(ROUTES_COLLECTION);
    $cursor = $collection->distinct($field);
 
    $submitted_values = $_POST[$input];
    $empty = empty($submitted_values);
    $posted = ( isset($submitted_values) && !$empty );
    foreach ( $cursor as $value ) {
        $selected = ( !$posted || $empty || ( $posted && (in_array($value, $submitted_values) )) ? ' selected="selected" ' : ''); 
        if( $value != '' ) {
         echo '<option' . $selected. ' value="' .$value. '">' .$value. '</option>';
        }
    }
}

function obfuscateAddress($map, $key) {
    $map[$key] = s_obfuscateAddress($map[$key]);
}

function s_obfuscateAddress($address) {
    return preg_replace("/[0-9]\w+/", "$1", $address);
}


function cleanup($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


function validateMandatory($key) {
    $value = $_POST[$key];
    $error = "";
    if (empty($value)) {
        $error= "mandatory-missing";
    }   
    return array('value' => cleanup($value), 'error' => $error );

}

function validateEmail($key) {
    $value = $_POST[$key];
    $error = "";
    if( !filter_var($value, FILTER_VALIDATE_EMAIL) ) {
        $error = "invalid-email";
    }
    return array('value' => cleanup($value), 'error' => $error );
}

function validateEmailMandatory($key) {
    $result = validateMandatory($key);
    if( $result['error'] == "" ) {
        return validateEmail($key);
    }
    return $result;
}

?>