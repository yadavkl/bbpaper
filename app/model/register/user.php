<?php

class ModelRegisterUser extends Model {

    public function updateUserInfo($data) {

        $result = $this->db->query("INSERT INTO " . DB_PREFIX . "customerinfo SET customerid='" . $this->session->data['customerid'] . "',
        firstname='" . $this->db->escape($data['firstname']) . "',lastname='" . $this->db->escape($data['lastname']) . "', email='" . $this->db->escape($data['email']) . "',
        houseno='" . $this->db->escape($data['house']) . "',street='" . $this->db->escape($data['street']) . "',location='" . $this->db->escape($data['loc']) . "',
        area='" . $this->db->escape($data['area']) . "', mobile='" . $data['mobile'] . "',landmark='" . $this->db->escape($data['land']) . "',
        pincode='" . $data['pin'] . "',rdate='" . date('Y-m-d H:i:s') . "'");
        return $this->session->data['customerid'];
    }

    public function registerUser($data) {

        $referid = $this->generateRandomString();
        $result = $this->db->query("INSERT INTO " . DB_PREFIX . "customer SET email='" . $data['email'] . "', referalid='$referid',referedbyid='other',fdate='" . date('Y-m-d H:i:s') . "'");
        $this->session->data['customerid'] = $this->db->getLastId();
        $this->db->query("INSERT INTO " . DB_PREFIX . "user_extra_amount SET customerid='" . $this->session->data['customerid'] . "'");
    }

    public function isSelfReferedUser() {

        $result = $this->db->query("SELECT referedbyid FROM " . DB_PREFIX . "customer WHERE customerid='" . $this->session->data['customerid'] . "' LIMIT 1");
        if ($result->num_rows > 0 && $result->row['referedbyid'] == 'other') {
            return true;
        }
        return false;
    }

    public function isReferalCodeExist() {

        $result = $this->db->query("SELECT referedbyid FROM " . DB_PREFIX . "customer WHERE customerid='" . $this->session->data['customerid'] . "' LIMIT 1");
        if ($result->num_rows > 0 && $result->row['referedbyid'] != 'other') {
            return true;
        }
        return false;
    }

    public function isRegisterUser($data) {

        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE email='" . $data['email'] . "' LIMIT 1");

        if ($result->num_rows > 0) {

            $this->session->data['customerid'] = $result->row['customerid'];

            if (!$result->row['referalid'] || $result->row['referalid'] == "") {
                $referid = $this->generateRandomString();
                $this->db->query("UPDATE  " . DB_PREFIX . "customer SET referalid='$referid', referedbyid='self' WHERE email='" . $data['email'] . "' LIMIT 1");
                $this->db->query("INSERT INTO " . DB_PREFIX . "user_extra_amount SET customerid='" . $this->session->data['customerid'] . "'");
            }
            return true;
        }

        return false;
    }

    public function updateReferalCode($data) {
        //<check if code exists
        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE referalid='" . $data['referedbyid'] . "' LIMIT 1");

        if ($result->num_rows > 0 && $result->row['customerid'] != $this->session->data['customerid']) {
            $this->db->query("UPDATE " . DB_PREFIX . "customer SET referedbyid='" . $data['referedbyid'] . "' WHERE customerid='" . $this->session->data['customerid'] . "'");
            return true;
        }
        return false;
    }

    public function updateRedemRequest() {

        $this->db->query("UPDATE " . DB_PREFIX . "user_extra_amount SET status='1' WHERE customerid='" . $this->session->data['customerid'] . "'");
    }

    public function getAmount() {

        $result = $this->db->query("SELECT totalamount FROM " . DB_PREFIX . "user_extra_amount WHERE customerid='" . $this->session->data['customerid'] . "'");
        if ($result->num_rows) {
            return $result->row['totalamount'];
        }
        return 0;
    }

    public function getReferalId() {

        $result = $this->db->query("SELECT referalid FROM " . DB_PREFIX . "customer WHERE customerid='" . $this->session->data['customerid'] . "' LIMIT 1");

        if ($result->num_rows) {

            return $result->row['referalid'];
        }
        return "";
    }

    public function isUserInfoExist($data) {

        $result = $this->db->query("SELECT customerinfoid FROM " . DB_PREFIX . "customerinfo WHERE customerid='" . $data['customerid'] . "'");

        if ($result->num_rows > 0) {

            return true;
        }
        return false;
    }

    public function getRates() {

        $data = NULL;
        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "ordertype");

        if ($result->num_rows > 0) {

            foreach ($result->rows as $paper) {

                $data[] = array(
                    'id' => $paper['typeid'],
                    'name' => $paper['name'],
                    'rate' => $paper['rate']
                );
            }
        }
        return $data;
    }

    public function getUserOrder() {

        $data = "";
        $result = $this->db->query("SELECT o.orderid,o.customerid,o.bookeddate,o.bookedslot,o.areaid,
            a.name,a.phone,a.image,os.typeid,ot.name as ordertype,ci.area,os.statusid FROM " . DB_PREFIX . "order o 
            LEFT JOIN " . DB_PREFIX . "customerinfo ci ON ci.customerinfoid = o.customerinfoid            
            LEFT JOIN " . DB_PREFIX . "agent a ON o.areaid =a.areaid
            LEFT JOIN " . DB_PREFIX . "orderstatus os ON o.orderid = os.orderid
            LEFT JOIN " . DB_PREFIX . "ordertype ot ON ot.typeid=os.typeid            
            WHERE o.customerid='" . $this->session->data['customerid'] . "' AND os.status='0'");

        if ($result->num_rows > 0) {

            $data[] = array(
                'orderid' => $result->row['orderid'],
                'customerid' => $result->row['customerid'],
                'bookeddate' => $result->row['bookeddate'],
                'bookedslot' => $result->row['bookedslot'],
                'agentname' => $result->row['name'],
                'phone' => $result->row['phone'],
                'image' => $result->row['image'],
                'type' => $result->row['ordertype'],
                'area' => $result->row['area'],
                'areaid' => $result->row['areaid'],
                'statusid' => $result->row['statusid']
            );
        }

        return $data;
    }

    public function getArealist() {

        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "area WHERE working='1' ORDER BY areaname ASC ");

        if ($result->num_rows > 0) {

            return $result->rows;
        }
    }

    public function getAreaId($customerinfoid) {

        $result = $this->db->query("SELECT a.areaid FROM " . DB_PREFIX . "area a
                LEFT JOIN " . DB_PREFIX . "customerinfo ci ON ci.area=a.areaname 
                WHERE ci.customerinfoid='" . $customerinfoid . "'");

        return $result->row['areaid'];
    }

    public function placeorder($data) {

        $result = $this->db->query("INSERT INTO " . DB_PREFIX . "order SET customerid='" . $data['customerid'] . "',                                                       customerinfoid='" . $data['customerinfoid'] . "', bookeddate='" . $data['date'] . "', 
            bookedslot='" . $data['slot'] . "', areaid='" . $data['areaid'] . "', orderdate='" . date("Y-m-d") . "'");

        $orderid = $this->db->getLastId();

        $status = $this->db->query("INSERT INTO " . DB_PREFIX . "orderstatus SET customerid='" . $data['customerid'] . "', orderid='$orderid',
            status='0', cdate='" . date("Y-m-d H:i:s") . "'");

        $slot = $this->db->query("UPDATE " . DB_PREFIX . "slot SET `" . $data['slot'] . "`=`" . $data['slot'] . "`+ 1 WHERE slotdate='" . $data['date'] . "' AND areaid='" . $data['areaid'] . "'");
    }

    public function getCustomerMobile($data) {

        $result = $this->db->query("SELECT mobile FROM " . DB_PREFIX . "customerinfo WHERE customerinfoid='" . $data['customerinfoid'] . "'");

        if ($result->num_rows > 0)
            return $result->row['mobile'];
    }

    public function slotTableInit($data) {

        $arealist = $data['arealist'];

        foreach ($arealist as $area) {

            $this->insertInSlot($data['tomorrow'], $area['areaid']);
            $this->insertInSlot($data['nextday'], $area['areaid']);
            $this->insertInSlot($data['nexttonext'], $area['areaid']);
        }
    }

    public function getAvailableSlots($data) {

        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "slot WHERE slotdate='" . $data['date'] . "' AND areaid='" . $data['areaid'] . "'");
        $slots[] = array();
        if ($result->num_rows > 0) {

            $limit = $this->value->getOrderLimitPerSlot();

            if ($result->row['10-12AM'] < $limit)
                $slots[] = array('slot' => '10-12AM');

            if ($result->row['12-02PM'] < $limit)
                $slots[] = array('slot' => '12-02PM');

            if ($result->row['02-04PM'] < $limit)
                $slots[] = array('slot' => '02-04PM');

            if ($result->row['04-06PM'] < $limit)
                $slots[] = array('slot' => '04-06PM');

            if ($result->row['06-08PM'] < $limit)
                $slots[] = array('slot' => '06-08PM');
        }

        return json_encode($slots);
    }

    public function cancelOrder($data) {

        $this->db->query("UPDATE " . DB_PREFIX . "orderstatus SET status='3',cdate='" . date('Y-m-d H:i:s') . "' WHERE statusid='" . $data['statusid'] . "'");

        $slot = $this->db->query("UPDATE " . DB_PREFIX . "slot SET `" . $data['order']['bookedslot'] . "`=`" . $data['order']['bookedslot'] . "`- 1 WHERE slotdate='" . $data['order']['bookeddate'] . "' AND areaid='" . $data['order']['areaid'] . "'");
    }

    public function removeaddress($data) {

        $this->db->query("DELETE FROM " . DB_PREFIX . "customerinfo WHERE customerinfoid='" . $data['customerinfoid'] . "'");
    }

    public function setAgnetRating($data) {

        $agents = $this->db->query("SELECT DISTINCT rat.agentid FROM rdw_customer rc 
                                LEFT JOIN rdw_customerinfo rci ON rc.customerid=rci.customerid
                                LEFT JOIN rdw_area ra ON rci.area=ra.areaname
                                LEFT JOIN rdw_agent rat ON ra.areaid = rat.areaid
                                WHERE rc.customerid='" . $data['customerid'] . "'");

        if ($agents->num_rows > 0) {

            foreach ($agents->rows as $agent) {

                $this->db->query("INSERT INTO " . DB_PREFIX . "rating SET agentid='" . $agent['agentid'] . "',  customerid='" . $data['customerid'] . "', value='" . $data['rating'] . "',rdate='" . date('Y-m-d') . "' ");
            }
        }
    }

    public function insertInSlot($date, $areaid) {

        $exist = $this->db->query("SELECT * FROM " . DB_PREFIX . "slot WHERE slotdate='$date' AND areaid='$areaid'");

        if ($exist->num_rows == 0) {

            $this->db->query("INSERT INTO " . DB_PREFIX . "slot SET slotdate='$date', areaid='$areaid'");
        }
    }

    public function userHistory() {

        $result = $this->db->query("SELECT payment,orderid,status,comment,cdate FROM " . DB_PREFIX . "orderstatus WHERE customerid='" . $this->session->data['customerid'] . "'");
        if ($result->num_rows > 0) {
            return $result->rows;
        }
        return null;
    }

    public function getOrderDetails($data) {

        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "orderstatus WHERE orderid='" . $data['orderid'] . "'");
        return $result->row;
    }

    public function getCustomerSpeak() {

        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_speak");
        return $result->rows;
    }

    private function generateRandomString($length = 6) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}

//<class   