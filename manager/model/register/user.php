<?php

class ModelRegisterUser extends Model{
    
    public function register($data){
       
        $this->db->query("INSERT INTO ".DB_PREFIX."user SET user_group_id='4', "
                . "username='".$this->db->escape($data['username'])."', "
                . "salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "',"
                . "password='" .sha1($salt . sha1($salt . sha1( $this->db->escape($data['password'])))) . "',"
                . "firstname='".$this->db->escape($data['firstname'])."',"
                . "lastname='".$this->db->escape($data['lastname'])."',"
                . "email='".$this->db->escape($data['email'])."',"
                . "phone='".$data['phone']."'");
        
    }
    
}

