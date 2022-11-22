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
            case 'phone':
                if( (strlen($param) == 13) && (preg_match('/^[+][0-9]/', $param) == 1) ) {
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
                    $_SESSION['message'] = "wrong field ".$type.". must be more 4 symbols, less then 20, contain at least 1 letter or 1 digit.";
                    return false;
                }
                break;
            case 'password':
                if (preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $param)) {
                    return true;
                } else {
                    $_SESSION['message'] = "wrong field ".$type.". must be more 7 symbols, contain at least 1 capital letter and 1 digit.";
                    return false;
                }
                break;
            case 'firstname':
            case 'lastname':
            case 'address':
            case 'city':
                if( strlen($param) > 0) {
                    return true;
                } else {
                    $_SESSION['message'] = "empty field ".$type;
                    return false;
                }

        }
        return true;
    }

    public static function validate_fields($fields) {
        foreach($fields as $key => $value) {
            if(!Validation::validate_field($value, $key)) return false;
        }
        return true;
    }

    public static function validate_fields_type($fields, $type) {
        foreach($fields as $key => $value) {
            if(!Validation::validate_field($value, $type)) return false;
        }
        return true;
    }

    public static function check_contacts() {
        $publish_user = filter_input(INPUT_POST, 'publish_contact');
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $country_id = filter_input(INPUT_POST, 'country');
        $fields = ['firstname' => $firstname, 
                   'lastname' => $lastname,
                   'address' => $address, 
                   'city' => $city,
                   'publish_user' => $publish_user,
                   'country_id' => $country_id,
                   ];
        $validation = Validation::validate_fields($fields);
        if(!$validation) {
            return false;
        } else {
            return $fields;
        }
    }

    public static function check_phones() {
        $phones = filter_input(INPUT_POST, 'phones', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $phones_id = filter_input(INPUT_POST, 'phones_id', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $phones_checkbox = filter_input(INPUT_POST, 'phones_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $new_phones = filter_input(INPUT_POST, 'new_phones', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $new_phones_checkbox = filter_input(INPUT_POST, 'new_phones_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $validation = Validation::validate_fields_type($phones, "phone");
        if(!$validation) {
            return false;
        }
        $validation = Validation::validate_fields_type($new_phones, "phone");
        if(!$validation) {
            return false;
        }
        return ['phones' => $phones, 'phones_id' => $phones_id, 'phones_checkbox' => $phones_checkbox, 'new_phones' => $new_phones, 'new_phones_checkbox' => $new_phones_checkbox];
    }

    public static function check_emails() {
        $emails = filter_input(INPUT_POST, 'emails', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $emails_id = filter_input(INPUT_POST, 'emails_id', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $emails_checkbox = filter_input(INPUT_POST, 'emails_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $new_emails = filter_input(INPUT_POST, 'new_emails', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $new_emails_checkbox = filter_input(INPUT_POST, 'new_emails_checkbox', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $validation = Validation::validate_fields_type($emails, "email");
        if(!$validation) {
            return false;
        }
        $validation = Validation::validate_fields_type($new_emails, "email");
        if(!$validation) {
            return false;
        }
        return ['emails' => $emails, 'emails_id' => $emails_id, 'emails_checkbox' => $emails_checkbox, 'new_emails' => $new_emails, 'new_emails_checkbox' => $new_emails_checkbox];
    }
}