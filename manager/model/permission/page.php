<?php
//coded by krithe
class ModelPermissionPage extends Model{
    
	function updatePermissions($data){
		
	     $role=$data['role'];
		 $count=count($data['decode_data']);		
	    for($i=0;$i<$count;$i++) 
		 {
			$page_id= $data['decode_data'][$i]['Page_id'];
			$edit= $data['decode_data'][$i]['Edit'];
			$view= $data['decode_data'][$i]['View'];
			$delete= $data['decode_data'][$i]['sDelete'];
			 $update_permisssion=
					"update  ".DB_PREFIX."page  set 
					`Edit`='".$edit."' ,
					`View`='".$view."' ,
					`Sdelete`= '".$delete."',				
					`role_id`='".$role."'
					 where `Page_Id`='".$page_id."'";					
				   $this->db->query($update_permisssion);  				
		 }   
		 
					echo "permissions updated";//alert box	
	}	
	
	public function getrole(){
        $sql = "SELECT * FROM  ".DB_PREFIX."role where status='1' ORDER BY id ASC ";
        $result = $this->db->query($sql);        
        if($result->num_rows > 0){            
            return json_encode($result->rows);
		}
}
// get data by role in grid @22 dec15//
   function get_role_data($data)
    {	
        $role=$data['role'];
	    $role_data_query = "SELECT * FROM  ".DB_PREFIX."page where role_id='".$role."' ORDER By Page_id ASC";
		$result = $this->db->query($role_data_query);		
		if($result->num_rows > 0)
			{
			 return json_encode($result->rows);
			}	
     }

// ge url data //

 public function pages_url($data){
	//pagePermission
	echo $url=$data['url'];
  
	// $url_query="select Page_name from ".DB_PREFIX." where Page_name=".$last."";
	// $url_result=$this>db->query($url_query);
  } 
}



