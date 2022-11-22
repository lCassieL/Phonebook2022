<?php
class MainModel extends Model {

    public function isRegistered($username, $password) {
        if($this->db->connect_errno === 0) {
            $username = mysqli_real_escape_string($this->db, $username);
            $password = mysqli_real_escape_string($this->db, $password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $res = $this->db->query($query);
            if($res && $res->num_rows) {
                return $res->fetch_all(MYSQLI_ASSOC);
            } else {
                return false;
            }
        }
    }

    public function getUsers() {
        if($this->db->connect_errno === 0) {
            $query = "SELECT * FROM users WHERE publish=1";
            $res = $this->db->query($query);
            if($res) {
                return $res->fetch_all(MYSQLI_ASSOC);
            } else {
                return false;
            }
        }
    }

    public function getUser($id, $only_publish = false) {
        if($this->db->connect_errno === 0) {
            $id = (int)$id;
            $query = "SELECT users.*, countries.name AS country FROM users, countries WHERE users.country_id=countries.id AND users.id=$id" . ($only_publish ? " AND publish=1" : "");
            $res = $this->db->query($query);
            if($res) {
                return $res->fetch_all(MYSQLI_ASSOC);
            } else {
                return false;
            }
        }
    }

    public function getPhones($id, $only_publish = false) {
        if($this->db->connect_errno === 0) {
            $id = (int)$id;
            $query = "SELECT * FROM phones WHERE user_id=$id" . ($only_publish ? " AND publish=1" : "");
            $res = $this->db->query($query);
            if($res) {
                return $res->fetch_all(MYSQLI_ASSOC);
            } else {
                return false;
            }
        }
    }

    public function getEmails($id, $only_publish = false) {
        if($this->db->connect_errno === 0) {
            $id = (int)$id;
            $query = "SELECT * FROM emails WHERE user_id=$id" . ($only_publish ? " AND publish=1" : "");
            $res = $this->db->query($query);
            if($res) {
                return $res->fetch_all(MYSQLI_ASSOC);
            } else {
                return false;
            }
        }
    }

    public function getCountries() {
        if($this->db->connect_errno === 0) {
            $query = "SELECT * FROM countries";
            $res = $this->db->query($query);
            if($res) {
                return $res->fetch_all(MYSQLI_ASSOC);
            } else {
                return false;
            }
        }
    }

    public function updateUser($id, $publish_user, $firstname, $lastname, $address, $city, $country_id) {
        $firstname = mysqli_real_escape_string($this->db, $firstname);
        $lastname = mysqli_real_escape_string($this->db, $lastname);
        $address = mysqli_real_escape_string($this->db, $address);
        $city = mysqli_real_escape_string($this->db, $city);
        $id = (int)$id;
        $publish_user = (int)$publish_user;
        $country_id = (int)$country_id;
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', address='$address', city='$city', publish=$publish_user, country_id=$country_id WHERE id=".$id;
        $res = $this->db->query($query);
        return mysqli_affected_rows($this->db);
    }

    public function multiUpdateCreatePhones($phones, $phones_id, $phones_checkbox, $new_phones, $new_phones_checkbox, $user_id) {
        if($this->db->connect_errno === 0) {
            $query = "";
            $phones = $phones == null ? [] : $phones;
            foreach($phones as $key=>$phone) {
                $number = mysqli_real_escape_string($this->db, $phone);
                $id = (int)$phones_id[$key];
                $publish = (int)$phones_checkbox[$key];
                $user_id = (int)$user_id;
                $query = "UPDATE phones SET number='$number', publish=$publish WHERE id=$id AND user_id=$user_id;";
                $this->db->query($query);
            }
            $new_phones = $new_phones == null ? [] : $new_phones;
            foreach($new_phones as $key=>$new_phone) {
                $number = mysqli_real_escape_string($this->db, $new_phone);
                $publish = (int)$new_phones_checkbox[$key];
                $user_id = (int)$user_id;
                $check = $this->db->query("SELECT * FROM phones WHERE number='$number'");
                if(mysqli_num_rows($check) != 0) continue;
                $query = "INSERT INTO phones(number, publish, user_id) VALUES('$number','$publish','$user_id');";
                $this->db->query($query);
            }
            return mysqli_affected_rows($this->db);
        }
    }

    public function multiUpdateCreateEmails($emails, $emails_id, $emails_checkbox, $new_emails, $new_emails_checkbox, $user_id) {
        if($this->db->connect_errno === 0) {
            $query = "";
            $emails = $emails == null ? [] : $emails;
            foreach($emails as $key=>$email) {
                $email = mysqli_real_escape_string($this->db, $email);
                $id = (int)$emails_id[$key];
                $publish = (int)$emails_checkbox[$key];
                $user_id = (int)$user_id;
                $query = "UPDATE emails SET email='$email', publish=$publish WHERE id=$id AND user_id=$user_id;";
                $this->db->query($query);
            }
            $new_emails = $new_emails == null ? [] : $new_emails;
            foreach($new_emails as $key=>$new_email) {
                $email = mysqli_real_escape_string($this->db, $new_email);
                $publish = (int)$new_emails_checkbox[$key];
                $user_id = (int)$user_id;
                $check = $this->db->query("SELECT * FROM emails WHERE email='$email'");
                if(mysqli_num_rows($check) != 0) continue;
                $query = "INSERT INTO emails(email, publish, user_id) VALUES('$email','$publish','$user_id');";
                $this->db->query($query);
            }
            return mysqli_affected_rows($this->db);
        }
    }
}