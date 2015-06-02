<?php

/**
 * Removes the first characters of a String until the space char, if the first caracter is a digit.
 * The string is then replaced in $map under the key $key.
 */


function get_html_ask_table($map, $key) {

}

function get_html_give_table($map, $key) {
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