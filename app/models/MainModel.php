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
}