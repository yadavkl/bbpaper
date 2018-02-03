<?php  
class ModelAreaShow extends Model{
    public function getShowArea(){
        
        $sql = "SELECT * FROM rdw_area ORDER BY areaname ASC";
        $result = $this->db->query($sql);
        
        if($result->num_rows > 0){
         
            
            return json_encode($result->rows);
        }
        
        
    }
    public function getChangeStatus($area){

        
        $sql = "UPDATE rdw_area SET working = CASE
    WHEN working = 1 THEN 0
    WHEN working = 0 THEN 1
    ELSE working
    END
    WHERE areaid='$area'";
        $result = $this->db->query($sql);
      
    }
}