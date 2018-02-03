<?php
class Constant{
    
    private $ORDER_PER_SLOT_LIMIT=0;
    private $message="";
    
    function __construct($registry) { 
        
        $this->ORDER_PER_SLOT_LIMIT=10;
    }

    public function setMessage($msg){
        $this->message=$msg;
    }
    
     public function getMessage(){
        return $this->message;
    }

    public function getOrderLimitPerSlot(){
        return $this->ORDER_PER_SLOT_LIMIT;
    }
}