<?php  
class ModelRegisterAgentrating extends Model{
    public function getAgentRating(){
        
        $sql = "SELECT * FROM rdw_agent rg JOIN rdw_rating rr ON rg.agentid=rr.agentid JOIN rdw_customerinfo ci ON rr.customerid=ci.customerid";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
         
            
            return json_encode($result->rows);
        }
    }
}