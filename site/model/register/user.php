<?php

class ModelRegisterUser extends Model {

    public function isUserExist($data) {

        $result = $this->db->query("SELECT * FROM  " . DB_PREFIX . "customer WHERE email ='" . $data['email'] . "' ");
        if ($resul->_num_rows > 0) {
            return true;
        }
        return false;
    }
    
    public function regsiterUser($data){
       $this->db->query("INSERT INTO " . DB_PREFIX . "customer SET email='".$data['email']."', fdate='".date('Y-m-d')." ' ");
       $this->db->query("INSERT INTO " . DB_PREFIX . "customerinfo ");
        
    }

}
