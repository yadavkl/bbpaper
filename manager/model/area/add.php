<?php
class ModelAreaAdd extends Model{
    
    public function setarea($data){
        
        $date = date('Y-m-d');
        $sql="INSERT INTO rdw_area SET areaid='".$data['areaid']."', areaname='".$data['areaname']."', areadate='$date' ";
        $this->db->query($sql);
    }
}
    
    