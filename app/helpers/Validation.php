<?php
class Validation {
    public static function validate_field($param, $type) {
        switch($type) {
            case 'email':
                if(filter_var($param, FILTER_VALIDATE_EMAIL)) {
                    return true;
                } else {
                    $_SESSION['message'] = "wrong field ".$type;
                    return false;
                }
                break;
            case 'username':
                if( (strlen($param) < 20) && (strlen($param) > 4) && (preg_match('/^[a-zA-Z0-9]/', $param) == 1) ) {
                    return true;
                } else {
                    $_SESSION['message'] = "wrong field ".$type;
                    return false;
                }
                break;
            case 'password':
                if (preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $param)) {
                    return true;
                } else {
                    $_SESSION['message'] = "wrong field ".$type;
                    return false;
                }
                break;

        }
        return true;
    }

    public static function validate_fields($fields) {
        foreach($fields as $key => $value) {
            if(!Validation::validate_field($value, $key)) return false;
        }
        return true;
    }
}