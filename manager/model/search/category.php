<?php
class ModelSearchCategory extends Model{
    private $category;
    public function getCategory($data){

       $keyword = $data['key'];
       $result = $this->db->query("SELECT * FROM applmind_search WHERE keyword LIKE '%$keyword%'" );
       if( $result->num_rows > 0 ){       
       		return $result->row['category'];
       	}
       	$tempdata = explode(" ",$keyword);
       	$len = count($tempdata);   	
       	
       	if( $len > 0 ){
       		$keyword = $tempdata[0];
       		$result = $this->db->query("SELECT * FROM applmind_search WHERE keyword LIKE '%$keyword%'" );
       		if( $result->num_rows > 0){
       			return $result->row['category'];
       		}
       	}
       	if( $len > 1 ){
       		
       		$keyword = $tempdata[1];       		
       		$result = $this->db->query("SELECT * FROM applmind_search WHERE keyword LIKE '%$keyword%'" );
       		if( $result->num_rows > 0){
       			return $result->row['category'];
       		}	
       	}
       	if( $len > 2 ){
       		
       		$keyword = $tempdata[2];       		
       		$result = $this->db->query("SELECT * FROM applmind_search WHERE keyword LIKE '%$keyword%'" );
       		if( $result->num_rows > 0){
       			return $result->row['category'];
       		}	
       	}
       	return NULL;
    }
    
    public function setUnknownKeyword($keyword){
    	$result = $this->db->query("INSERT INTO applmind_unknown SET keyword='$keyword'");    
    }
} //<class