<?php

// add_filter('acf/validate_value/name=cellphone', 'validateCTPRONumber', 10, 4);
// function validateCTPRONumber( $valid, $value, $field, $input ){
//     // bail early if value is already invalid
//     if( !$valid ) {
//         return $valid;
//     }
    
//     $mobile = $_POST['acf']['field_61cd2c4ef010b'];
        
//     $charcount      = strlen($mobile);
//     $firstletter    = substr($mobile, 0, 2); 
    
//     if ($charcount > 12 || $charcount < 12) {
//         $valid = 'Please input your 11-digit mobile number. Mobile Number should be in Philippine Format! 63917XXXX00';
//     } elseif($firstletter !=  63) {
//         $valid = 'Mobile should be in Philippine Format! 63917XXXX';
//     } elseif(preg_match('/[a-zA-Z]/', $mobile)) {
//         $valid = 'This is not a mobile number.';
//     } else {
    
//     }
//     return $valid;
// }

// add_filter('acf/validate_value/name=cellphone', 'validateCEANumber', 10, 4);
// function validateCEANumber( $valid, $value, $field, $input ){
//     // bail early if value is already invalid
//     if( !$valid ) {
//         return $valid;
//     }
    
//     $mobile = $_POST['acf']['field_61c96d686b2bb'];
        
//     $charcount      = strlen($mobile);
//     $firstletter    = substr($mobile, 0, 2); 
    
//     if ($charcount > 12 || $charcount < 12) {
//         $valid = 'Please input your 11-digit mobile number. Mobile Number should be in Philippine Format! 63917XXXX00';
//     } elseif($firstletter !=  63) {
//         $valid = 'Mobile should be in Philippine Format! 63917XXXX';
//     } elseif(preg_match('/[a-zA-Z]/', $mobile)) {
//         $valid = 'This is not a mobile number.';
//     } else {
    
//     }
//     return $valid;
// }

add_filter('acf/validate_value/name=email', 'validateCTPROEmail', 10, 4);
function validateCTPROEmail( $valid, $value, $field, $input ){
    // bail early if value is already invalid
    if( !$valid ) {
        return $valid;
    }
    
    $email = $_POST['acf']['field_61cd2c4eeffb0'];   // email
    
    $user_data = get_user_by( 'email', $email );
    if ( empty( $user_data ) ) {
    } else {
        $valid = "Email Address already exists. Please enter new email.";
    }
    
    return $valid;
}

add_filter('acf/validate_value/name=email', 'validateCEAEmail', 10, 4);
function validateCEAEmail( $valid, $value, $field, $input ){
    // bail early if value is already invalid
    if( !$valid ) {
        return $valid;
    }
    
    $email = $_POST['acf']['field_61c96d486b2b9'];   // email
    
    $user_data = get_user_by( 'email', $email );
    if ( empty( $user_data ) ) {
    } else {
        $valid = "Email Address already exists. Please enter new email.";
    }
    
    return $valid;
}







?>