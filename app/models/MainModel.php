<?php
class MainModel extends Model {
    public function getAllTodos() {
        if($this->db->connect_errno === 0) {
            $query = "SELECT * FROM todos WHERE user_id=".(int)$_SESSION['user_id'];
            $res = $this->db->query($query);
            if($res) {
                return $res->fetch_all(MYSQLI_ASSOC);
            } else {
                return false;
            }
        }
    }

    public function isRegistered($username, $password) {
        if($this->db->connect_errno === 0) {
            $username = mysqli_real_escape_string($this->db, $username);
            $password = mysqli_real_escape_string($this->db, $password);
            //$query = "SELECT * FROM users WHERE username=".$username." AND password=".$password;
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $res = $this->db->query($query);
            if($res && $res->num_rows) {
                return $res->fetch_all(MYSQLI_ASSOC);
            } else {
                return false;
            }
        }
    }
}