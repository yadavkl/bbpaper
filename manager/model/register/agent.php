<?php
class ModelRegisterAgent extends Model{
    
    public function setagent($data){
        
        $sql="INSERT INTO rdw_agent SET areaid='".$data['areaid']."',name='".$data['name']."',email='".$data['email']."',phone='".$data['phone']."',image='".$data['image']."'"; 
 
        $this->db->query($sql);
    }

        public function getrole(){
        $sql = "SELECT * FROM rdw_role where status='1' ORDER BY id ASC ";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
            
            return json_encode($result->rows);
        }
}
     public function getAgentInfo(){
        $sql = "SELECT * FROM rdw_agent ORDER BY name ASC";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
            
            return json_encode($result->rows);
        }
        
        
    }
       public function getAreaId(){
        
        $sql = "SELECT * FROM rdw_area";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
         
            
            return json_encode($result->rows);
        }
        
        
    }
     public function AgentApprove(){
        
        $sql = "SELECT * FROM rdw_agent ORDER BY name ASC";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
         
            
            return json_encode($result->rows);
        }
        
        
    }
    public function agentRemoveRequest($agent){

        
        $sql = "UPDATE rdw_agent SET status = CASE
    WHEN status = 1 THEN 0
    WHEN status = 0 THEN 1
    ELSE status
    END
    WHERE agentid='$agent'";
        $result = $this->db->query($sql);
      
    }

}
    
    