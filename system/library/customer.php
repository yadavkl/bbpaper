<?php

class Customer {

    private $customerid;
    private $customerinfo;
    private $referalid;
    private $referedbyid;

    public function __construct($registry) {
        $this->db = $registry->get('db');
        $this->request = $registry->get('request');
        $this->session = $registry->get('session');
        
        if (isset($this->session->data['customerid'])) {

            $user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customerinfo ci                    
                    WHERE customerid='" . $this->session->data['customerid'] . "'");
            if ($user_query->num_rows > 0) {
                foreach ($user_query->rows as $userinfo) {
                    $this->customerid = $userinfo['customerid'];

                    $this->customerinfo[] = array(
                        'customerinfoid' => $userinfo['customerinfoid'],
                        'email' => $userinfo['email'],
                        'firstname' => $userinfo['firstname'],
                        'lastname' => $userinfo['lastname'],
                        'email' => $userinfo['email'],
                        'mobile' => $userinfo['mobile'],
                        'house' => $userinfo['houseno'],
                        'street' => $userinfo['street'],
                        'location' => $userinfo['location'],
                        'area' => $userinfo['area'],
                        'landmark' => $userinfo['landmark'],
                        'pincode' => $userinfo['pincode']
                    );
                }
            }
        }
    }

    public function login() {

        // var_dump($this->session->data['customerid']);
        if (isset($this->session->data['customerid'])) {

            $user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customerinfo ci                    
                    WHERE customerid='" . $this->session->data['customerid'] . "'");
            if ($user_query->num_rows > 0) {
                foreach ($user_query->rows as $userinfo) {
                    $this->customerid = $userinfo['customerid'];

                    $this->customerinfo[] = array(
                        'customerinfoid' => $userinfo['customerinfoid'],
                        'email' => $userinfo['email'],
                        'firstname' => $userinfo['firstname'],
                        'lastname' => $userinfo['lastname'],
                        'email' => $userinfo['email'],
                        'mobile' => $userinfo['mobile'],
                        'house' => $userinfo['houseno'],
                        'street' => $userinfo['street'],
                        'location' => $userinfo['location'],
                        'area' => $userinfo['area'],
                        'landmark' => $userinfo['landmark'],
                        'pincode' => $userinfo['pincode']
                    );
                }
            }
        }
    }

    public function getUserId() {
        return $this->customerid;
    }

    public function getUserInfo() {
        return $this->customerinfo;
    }

}

//<class