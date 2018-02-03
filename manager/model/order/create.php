<?php
class ModelOrderCreate extends Model{
	
	
    
    public function createorder($data){

		$sqla="INSERT INTO rdw_customer SET email='".$data['email']."'";
		$conn= $this->db->query($sqla);
	$customerid = $this->db->getLastId();
   $sql="INSERT INTO rdw_customerinfo SET 
    customerid='" . $customerid. "',
    firstname='".$data['firstname']."',
    lastname='".$data['lastname']."',
    mobile='".$data['mobile']."',
    email='".$data['email']."',
    houseno='".$data['houseno']."',
    street='".$data['street']."',
    location='".$data['location']."',
    area='".$data['area']."'"; 

    $this->db->query($sql);
    $customerinfoid = $this->db->getLastId();




 	$this->db->query("INSERT INTO " . DB_PREFIX . "order SET customerid='$customerid', customerinfoid='$customerinfoid', bookeddate='" . $data['date'] . "', 
            bookedslot='" . $data['bookedslot'] . "', areaid='" . $data['areaid'] . "', orderdate='" . date("Y-m-d") . "'");

        $orderid = $this->db->getLastId();
        //<update order status table
        $this->db->query("INSERT INTO " . DB_PREFIX . "orderstatus 
            SET customerid='$customerid', orderid='$orderid',
            status='0', cdate='" . date("Y-m-d") . "'");
        //<update slot order count
        $this->db->query("UPDATE " . DB_PREFIX . "slot 
            SET `" . $data['bookedslot'] . "`=`" . $data['bookedslot'] . "`+ 1 WHERE slotdate='" . $data['date'] . "' AND areaid='" . $data['areaid'] . "'");


 
 }  
 

 
}
 