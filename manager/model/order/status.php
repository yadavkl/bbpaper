<?php
class ModelOrderStatus extends Model{
    private $ORDER_PER_SLOT_LIMIT=5;
    
    public function getOrderStatus(){
        
        $sql = "SELECT * FROM rdw_customerinfo rc INNER JOIN rdw_orderstatus ro ON rc.customerid=ro.customerid ORDER BY firstname ASC";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
            
            return json_encode($result->rows);
        }
        
        
    }
    
    public function getCustomerStatus(){
        
        $sql = "SELECT * FROM rdw_customerinfo rc INNER JOIN rdw_orderstatus ro ON rc.customerid=ro.customerid ORDER BY firstname ASC";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
            
            return json_encode($result->rows);
        }
    }

    public function getHistory($cust){
        
        $sql = "SELECT * FROM rdw_orderstatus WHERE customerid='$cust'";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
            
            return json_encode($result->rows);
        }
        
        
    }
     public function getTotalStatus(){
        
        $sql = "SELECT * FROM rdw_orderstatus rc INNER JOIN rdw_customerinfo ro ON rc.customerid=ro.customerid ORDER BY firstname ASC";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
            
            return json_encode($result->rows);
        }
        
        
    }
    public function getBookingStatus(){
        
        $sql = "SELECT * FROM rdw_slot rc INNER JOIN rdw_order ro ON rc.areaid=ro.areaid INNER JOIN rdw_area ra ON ro.areaid=ra.areaid";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
            
            return json_encode($result->rows);
        }
        
        
    }

    
    public function getMessageStatus(){
        
        $sql = "SELECT * FROM rdw_customerinfo rc INNER JOIN rdw_orderstatus ro ON rc.customerid=ro.customerid GROUP BY rc.customerid, ro.customerid
HAVING count( * ) > 1";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
            
            return json_encode($result->rows);
        }
        
        
    }
    function update_agent_approval($data){
      		$count=count($data['decode_data']);
    
      		for($i=0;$i<$count;$i++)
      		{
      		    $agentid= $data['decode_data'][$i]['agentid'];
      		    $status= $data['decode_data'][$i]['status'];
      		    	
      		    echo 	$update_permisssion=
      		    "update `".DB_PREFIX."agent`  set
					`status`= '".$status."'
					 where `agentid`='".$agentid."';";
    
      		    $db=	   $this->db->query($update_permisssion);
    
      		}
      		echo "permissions updated";//alert box
    }
    public function getAgentInfo(){
        $sql = "SELECT * FROM rdw_agent ORDER BY name ASC";
        $result = $this->db->query($sql);
    
        if($result->num_rows > 0){
    
            return json_encode($result->rows);
        }
    
    
    }
    public function getrole(){
        $sql = "SELECT * FROM rdw_role where status='1' ORDER BY role_id ASC ";
        $result = $this->db->query($sql);
    
        if($result->num_rows > 0){
    
            return json_encode($result->rows);
        }
    
    
    }
    public function getpage(){
        $sql = "SELECT * FROM `rdw_page` ORDER BY Page_id ASC";
        $result = $this->db->query($sql);
    
        if($result->num_rows > 0){
    
            return json_encode($result->rows);
        }
    }
    public function getpagevalue(){
        $sql = "UPDATE rdw_page SET Edit='0'";
        $result = $this->db->query($sql);
    
        if($result->num_rows > 0){
    
            return json_encode($result->rows);
        }
    }
     public function getAvailableSlots($data) {

        $result = $this->db->query("SELECT * FROM rdw_slot WHERE slotdate='" . $data['date'] . "' AND areaid='" . $data['areaid'] . "'");

        if ($result->num_rows > 0) {
            $slots=array();
            $limit = $this->ORDER_PER_SLOT_LIMIT;

            if ($result->row['10-12AM'] < $limit){
                $slots[] = array('slot' => '10-12AM');
            }

            if ($result->row['12-02PM'] < $limit){
                $slots[] = array('slot' => '12-02PM');
            }

            if ($result->row['02-04PM'] < $limit){
                $slots[] = array('slot' => '02-04PM');
            }

            if ($result->row['04-06PM'] < $limit){
                $slots[] = array('slot' => '04-06PM');
            }

            if ($result->row['06-08PM'] < $limit){
                $slots[] = array('slot' => '06-08PM');
            }
        }

        return json_encode($slots);
    }

    
    
    
}