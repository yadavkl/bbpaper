<?php

class ModelRegisterAgent extends Model {

    public function isRegisteredAgent($data) {

        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "agent WHERE email='" . $data['email'] . "' LIMIT 1");

        if ($result->num_rows > 0) {

            $this->session->data['agentid'] = $result->row['agentid'];
            $this->session->data['areaid'] = $result->row['areaid'];

            return true;
        }
        return false;
    }

    public function getAgentOrder($data) {

        $result = $this->db->query("SELECT ra.agentid,ra.areaid,rc.firstname,rc.lastname,
                                rc.houseno,rc.street,rc.location,rc.area,rc.mobile,
                                rc.customerid,ro.bookeddate,ro.bookedslot,ros.statusid
                                FROM " . DB_PREFIX . "agent ra 
                                LEFT JOIN " . DB_PREFIX . "order ro ON ra.areaid=ro.areaid 
                                LEFT JOIN " . DB_PREFIX . "customerinfo rc ON ro.customerinfoid=rc.customerinfoid
                                LEFT JOIN " . DB_PREFIX . "orderstatus ros ON ro.orderid=ros.orderid
                                WHERE ra.email='" . $data['email'] . "' AND ros.status='0' AND ro.bookeddate='" . date('Y-m-d') . "'");

        if ($result->num_rows > 0) {

            foreach ($result->rows as $row) {

                $order[] = array(
                    'customer' => $row['firstname'] . " " . $row['lastname'] . "</br>" . $row['houseno'] . $row['street'] . "</br>" . $row['location'] . " " . $row['area'] . "</br>phone:" . $row['mobile'],
                    'date' => $row['bookeddate'],
                    'time' => $row['bookedslot'],
                    'customerid' => $row['customerid'],
                    'statusid' => $row['statusid'],
                    'areaid' => $row['areaid']
                );
            }
            return $order;
        }
        return null;
    }

    public function getAgentOrderByDate($data) {

        $result = $this->db->query("SELECT ra.agentid,ra.areaid,rc.firstname,rc.lastname,
                                rc.houseno,rc.street,rc.location,rc.area,rc.mobile,
                                rc.customerid,ro.bookeddate,ro.bookedslot,ros.statusid
                                FROM " . DB_PREFIX . "agent ra 
                                LEFT JOIN " . DB_PREFIX . "order ro ON ra.areaid=ro.areaid 
                                LEFT JOIN " . DB_PREFIX . "customerinfo rc ON ro.customerinfoid=rc.customerinfoid
                                LEFT JOIN " . DB_PREFIX . "orderstatus ros ON ro.orderid=ros.orderid
                                WHERE ra.email='" . $data['email'] . "' AND ros.status='0' AND ro.bookeddate='" . $data['date'] . "'");

        if ($result->num_rows > 0) {

            foreach ($result->rows as $row) {

                $order[] = array(
                    'customer' => $row['firstname'] . " " . $row['lastname'] . "</br>" . $row['houseno'] . $row['street'] . "</br>" . $row['location'] . " " . $row['area'] . "</br>phone:" . $row['mobile'],
                    'date' => $row['bookeddate'],
                    'time' => $row['bookedslot'],
                    'customerid' => $row['customerid'],
                    'statusid' => $row['statusid'],
                    'areaid' => $row['areaid']
                );
            }

            return $order;
        }
        return null;
    }

    public function closeorder($data) {

        $rate = $this->db->query("SELECT rate FROM " . DB_PREFIX . "ordertype WHERE typeid='0'");
        $cpu = $rate->row['rate'];
        $ret['cost'] = $data['weight'] * $cpu;

        $result = $this->db->query("UPDATE " . DB_PREFIX . "orderstatus SET status='1', quantity='" . $data['weight'] . "', payment='" . $ret['cost'] . "', cdate='" . date('Y-m-d H:i:s') . "' WHERE statusid='" . $data['statusid'] . "' ");

        $result = $this->db->query("SELECT firstname,lastname,mobile,customerid FROM " . DB_PREFIX . "customerinfo 
            WHERE customerinfoid=(SELECT customerinfoid FROM " . DB_PREFIX . "order 
            WHERE orderid=(SELECT orderid FROM " . DB_PREFIX . "orderstatus 
            WHERE statusid='" . $data['statusid'] . "'))");

        if ($result->num_rows > 0) {

            $ret['firstname'] = $result->row['firstname'];
            $ret['lastname'] = $result->row['lastname'];
            $ret['mobile'] = $result->row['mobile'];
            $ret['customerid']= $result->row['customerid'];
            $customerid = $result->row['customerid'];
            //IF user booked more than 20KG
            //Then this offer will be valid
            //<otherwise will not add amount
            $amount = 0;
            if ($data['weight'] > 20) {
                $amount = 10;
            }
            if ($data['weight'] > 50) {
                $amount = 25;
            }
            if ($data['weight'] > 100) {
                $amount = 50;
            }
            if ($amount) {
                $this->db->query("UPDATE " . DB_PREFIX . "user_extra_amount SET referamount=(referamount+$amount), totalamount=(referamount+otheramount-redemamount) "
                        . "WHERE customerid=(SELECT customerid FROM " . DB_PREFIX . "customer "
                        . "WHERE referedbyid=(SELECT referedbyid FROM " . DB_PREFIX . "customer "
                        . "WHERE customerid='$customerid' ))");
            }
        }
        return $ret;
    }

    public function updateRedemAmount($data) {
        
            $amount = $data['amount'];

            $this->db->query("UPDATE " . DB_PREFIX . "user_extra_amount SET redemamount=(redemamount+$amount), totalamount=(referamount+otheramount-redemamount) ,status='0'"
                    . "WHERE customerid='" . $data['customerid'] . "'))) ))");        
    }

    public function getUserExtraAmount($data) {
        
        $result = $this->db->query("SELECT totalamount FROM  " . DB_PREFIX . "user_extra_amount "
                    . "WHERE customerid=(SELECT customerid FROM " . DB_PREFIX . "orderstatus "
                    . "WHERE statusid='" . $data['statusid'] . "') AND status='1'"); 

        if ($result->num_rows) {
            return $result->row['totalamount'];
        }
        return 0;
    }

    public function cancelorder($data) {

        $arr = explode("::", $data['statusid']);

        $statusid = $arr[0];
        $slot = $arr[1];
        $date = $arr[2];
        $areaid = $arr[3];

        $result = $this->db->query("UPDATE " . DB_PREFIX . "orderstatus SET status='2', comment='" . $data['reason'] . "', cdate='" . date('Y-m-d H:i:s') . "' WHERE statusid='" . $statusid . "' ");

        $slot = $this->db->query("UPDATE " . DB_PREFIX . "slot SET `" . $slot . "`=`" . $slot . "`- 1 WHERE slotdate='" . $date . "' AND areaid='" . $areaid . "'");
    }

    public function getCustomerPhoneNumbers($data) {
        $result = $this->db->query("SELECT rc.firstname,rc.lastname,rc.mobile,ro.bookeddate,ro.bookedslot                              
                                FROM " . DB_PREFIX . "agent ra 
                                LEFT JOIN " . DB_PREFIX . "order ro ON ra.areaid=ro.areaid 
                                LEFT JOIN " . DB_PREFIX . "customerinfo rc ON ro.customerinfoid=rc.customerinfoid
                                LEFT JOIN " . DB_PREFIX . "orderstatus ros ON ro.orderid=ros.orderid
                                WHERE ra.email='" . $data['email'] . "' AND ros.status='0' AND ro.bookeddate='" . date('Y-m-d') . "' ");

        if ($result->num_rows > 0) {

            foreach ($result->rows as $row) {

                $customers[] = array(
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'mobile' => $row['mobile'],
                    'bookeddate' => $row['bookeddate'],
                    'bookedslot' => $row['bookedslot']
                );
            }
            return $customers;
        }
        return null;
    }

}

//<class   