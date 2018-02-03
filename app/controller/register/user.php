<?php

class ControllerRegisterUser extends Controller {

    public function index() {

        $this->load->model("register/user");

        if (isset($this->request->get['email']))
            $data['email'] = $this->request->get['email'];

        if (isset($data['email'])) {
            $this->session->data['email'] = $data['email'];

            if (!$this->isUserRegistered($data)) {
                $this->model_register_user->registerUser($data);
            }
        }

        $rates = $this->model_register_user->getRates();

        $data['rates'] = $rates;
        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $order = $this->model_register_user->getUserOrder();

        $data['order'] = $order;
        $data['orderinfo'] = "";

        if ($order != NULL) {

            $this->session->data['statusid'] = $order[0]['statusid'];
            $this->session->data['order'] = $order[0];

            $data['cancelurl'] = $this->url->link("register/user/cancelorder");
            $data['button'] = $this->load->view('page/cancelbutton.tpl', $data);
            $data['orderinfo'] = $this->load->view('page/orderpanel.tpl', $data);
        } else {
            $data['customer'] = $order = $this->model_register_user->getCustomerSpeak();
            $data['orderinfo'] = $this->load->view('page/infopanel.tpl', $data);
            $data['pickuplaterurl'] = $this->url->link("register/user/checkout");
            $data['pickupnowurl'] = $this->url->link("register/user/checkoutnow");
            $data['button'] = $this->load->view('page/proceedbutton.tpl', $data);
        }
        $data['url'] = "https://play.google.com/store/apps/details?id=com.byebuypaper";
        $data['rbid'] = $this->model_register_user->getReferalId();
        $data['referapp'] = $this->load->view('page/referpanel.tpl', $data);
        $data['promotionurl'] = "";
        if ($this->model_register_user->isSelfReferedUser()) {
            $data['promotionurl'] = $this->url->link("promotion/code");
        }
        $this->response->setOutput($this->load->view('page/first.tpl', $data));
    }

    //<Proceed further from first page if user do not have
    //<placed any order which is pending

    public function checkout() {

        $data['email'] = $this->session->data['email'];
        $data['customerid'] = $this->session->data['customerid'];

        if (!$this->isUserInfoExist($data)) {

            $this->response->redirect($this->url->link('register/user/userinfo'));
        } else {

            $this->user->login();
            $this->response->redirect($this->url->link('register/user/address'));
        }
    }

    public function refer() {

        if (isset($this->request->post['rbid'])) {
            $data['referedbyid'] = $this->request->post['rbid'];
        }
        $this->load->model('register/user');
        $result = $this->model_register_user->updateReferalCode($data);
        if ($result) {
            $this->response->redirect($this->url->link('register/user'));
        } else {
            $this->session->data['error'] = "Wrong Promotion Code, Insert again !";
            $this->response->redirect($this->url->link('promotion/code'));
        }
    }

    public function requestredem() {
        $this->load->model('register/user');
        $this->model_register_user->updateRedemRequest();
    }

    public function getextraamount() {
        $this->load->model('register/user');
        $this->model_register_user->getAmount();
    }

    public function checkoutnow() {

        $data['email'] = $this->session->data['email'];
        $data['customerid'] = $this->session->data['customerid'];

        if (!$this->isUserInfoExist($data)) {

            $this->response->redirect($this->url->link('register/user/userinfo'));
        } else {

            $this->user->login();
            $this->response->redirect($this->url->link('register/user/addressnow'));
        }
    }

    //<TO display Address of the user on screen
    //<if user already registered

    public function address() {

        $info = $this->user->getUserInfo();

        $data['info'] = $info;
        $data['email'] = $this->session->data['email'];

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $data['button'] = $this->load->view('page/schedulelaterbutton.tpl');
        $data['formid'] = "schedulelater";
        $this->response->setOutput($this->load->view('page/address.tpl', $data));
    }

    public function addressnow() {

        $info = $this->user->getUserInfo();

        $data['info'] = $info;
        $data['email'] = $this->session->data['email'];

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $data['button'] = $this->load->view('page/schedulenowbutton.tpl');
        $data['formid'] = "pickupnow";
        $this->response->setOutput($this->load->view('page/address.tpl', $data));
    }

    //<This will show form on screen for registering user
    //<or add new address for user

    public function userinfo() {

        $this->load->model("register/user");

        $list = $this->model_register_user->getArealist();
        $data['arealist'] = $list;

        $data['email'] = $this->session->data['email'];

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $data['isrefered'] = $this->model_register_user->isReferalCodeExist();

        $this->response->setOutput($this->load->view('page/register.tpl', $data));
    }

    public function removeinfo() {

        $this->load->model("register/user");

        $data['customerinfoid'] = $this->request->get['address'];
        $this->model_register_user->removeaddress($data);

        $this->response->redirect($this->url->link('register/user/address'));
    }

    //<This will show the booking date and time
    //<availability

    public function book() {
        $data['message'] = "";
        if (isset($this->request->get['address'])) {
            $data['address'] = $this->request->get['address'];
            $this->session->data['address'] = $data['address'];
        } else if (isset($this->session->data['address'])) {

            $data['address'] = $this->session->data['address'];
        }
        if (isset($this->request->get['message'])) {
            $data['message'] = $this->request->get['message'];
        }
        $this->load->model("register/user");

        $day = date('N');

        //<Tuesday is holiday
        //<Need to change in case holiday day chnages

        switch ($day) {
            case 1: //<Monday
                $data['tomorrow'] = date("Y-m-d", time() + 2 * 86400);
                $data['nextday'] = date("Y-m-d", time() + 3 * 86400);
                $data['nexttonext'] = date("Y-m-d", time() + 4 * 86400);
                break;
            case 2: //<Tuesday
            case 3: //<Wednesday
            case 4: //<Thirsday
            case 5: //<Friday
                $data['tomorrow'] = date("Y-m-d", time() + 86400);
                $data['nextday'] = date("Y-m-d", time() + 2 * 86400);
                $data['nexttonext'] = date("Y-m-d", time() + 3 * 86400);
                break;
            case 6: //<Saturday
                $data['tomorrow'] = date("Y-m-d", time() + 86400);
                $data['nextday'] = date("Y-m-d", time() + 2 * 86400);
                $data['nexttonext'] = date("Y-m-d", time() + 4 * 86400);
                break;
            case 7: //Sunday
                $data['tomorrow'] = date("Y-m-d", time() + 86400);
                $data['nextday'] = date("Y-m-d", time() + 3 * 86400);
                $data['nexttonext'] = date("Y-m-d", time() + 4 * 86400);
                break;
            default:
                break;
        }
        $data['today'] = "";
        if (date('N') != 2)
            $data['today'] = date("Y-m-d");

        $data['areaid'] = $this->model_register_user->getAreaId($data['address']);
        $this->session->data['areaid'] = $data['areaid'];

        //<INITOALIZE SLOT TABLE
        $list = $this->model_register_user->getArealist();
        $data['arealist'] = $list;
        $this->model_register_user->slotTableInit($data);

        $data['email'] = $this->session->data['email'];
        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $data['homepageurl'] = $this->url->link('register/user');
        $data['amount']=$this->model_register_user->getAmount();
        $this->response->setOutput($this->load->view('page/dates.tpl', $data));
    }

    public function booknow() {

        if (isset($this->request->get['address'])) {
            $data['address'] = $this->request->get['address'];
            $this->session->data['address'] = $data['address'];
        } else if (isset($this->session->data['address'])) {

            $data['address'] = $this->session->data['address'];
        }

        $this->load->model("register/user");

        if (date('N') == 2) {
            $args = "address=" . $data['address'] . "&message=Note: Tuesday is weekly off, please schedule for other day. Thank You!";
            $this->response->redirect($this->url->link('register/user/book', $args));
        }

        $data['areaid'] = $this->model_register_user->getAreaId($data['address']);
        $this->session->data['areaid'] = $data['areaid'];

        //<INITOALIZE SLOT TABLE
        $today = date("Y-m-d");
        $this->model_register_user->insertInSlot($today, $data['areaid']);
        $data['email'] = $this->session->data['email'];

        $slots = ["10-12AM", "12-02PM", "02-04PM", "04-06PM", "06-08PM", "08-10PM"];

        if (time() < strtotime("11:30:00")) {
            $data['slot'] = $slots[0];
        } else if ((time() > strtotime("11:30:00") ) && ( time() < strtotime("13:30:00") )) {
            $data['slot'] = $slots[1];
        } else if ((time() > strtotime("13:30:00") ) && ( time() < strtotime("15:30:00") )) {
            $data['slot'] = $slots[2];
        } else if ((time() > strtotime("15:30:00") ) && ( time() < strtotime("17:30:00") )) {
            $data['slot'] = $slots[3];
        } else if ((time() > strtotime("17:30:00") ) && ( time() < strtotime("19:30:00") )) {
            $data['slot'] = $slots[4];
        } else if ((time() > strtotime("19:30:00") ) && ( time() < strtotime("21:30:00") )) {
            $data['slot'] = $slots[5];
        } else {
            //<last order till 9:30
        }
        $data['date'] = $today;

        //<Book for other day....

        if (!isset($data['date']) || !isset($data['slot'])) {
            $args = "address=" . $data['address'] . "&message=Note: Last booking till- 9:30PM. \n Please schedule for other day. \n Thank You !";
            $this->response->redirect($this->url->link('register/user/book', $args));
        }
        $data['customerinfoid'] = $this->session->data['address'];
        $data['customerid'] = $this->session->data['customerid'];
        $this->model_register_user->placeorder($data);
        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $this->response->setOutput($this->load->view('page/thanx.tpl', $data));

        $mobile = $this->model_register_user->getCustomerMobile($data);

        //<Send SMS
        $args = array(
            'username' => USER,
            'pass' => PASSWORD,
            'senderid' => SENDERID,
            'message' => "Buy Bye Paper Thanks You, You have scheduled your collection date:" . $data['date'] . " and Time:" . $data['slot'],
            'dest_mobileno' => "91" . $mobile,
            'response' => 'Y'
        );

        // $ret = $this->send_message_to_customer(MESSAGE_SERVICE_URL . http_build_query($args));
    }

    //<Final request from user to placeorder
    //<Ater that orderr will be placed
    //<User will go on thank you page

    public function placeorder() {

        if (isset($this->request->post['date']))
            $data['date'] = $this->request->post['date'];

        if (isset($this->request->post['slot']))
            $data['slot'] = $this->request->post['slot'];

        if (!isset($data['date']) || !isset($data['slot'])) {
            $this->response->redirect($this->url->link('register/user/book'));
        }
        
        $data['customerinfoid'] = $this->session->data['address'];
        $data['customerid'] = $this->session->data['customerid'];

        $this->load->model("register/user");
        $data['areaid'] = $this->model_register_user->getAreaId($data['customerinfoid']);
        $this->model_register_user->placeorder($data);
        
        if(isset($this->request->post['redeme']) && $this->request->post['redeme'] == 'yes'){
            $this->model_register_user->updateRedemRequest();
        }

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $this->response->setOutput($this->load->view('page/thanx.tpl', $data));

        $mobile = $this->model_register_user->getCustomerMobile($data);

        //<Send SMS
        $args = array(
            'username' => USER,
            'pass' => PASSWORD,
            'senderid' => SENDERID,
            'message' => "Buy Bye Paper Thanks You, You have scheduled your collection date:" . $data['date'] . " and Time:" . $data['slot'],
            'dest_mobileno' => "91" . $mobile,
            'response' => 'Y'
        );

        //$ret = $this->send_message_to_customer(MESSAGE_SERVICE_URL . http_build_query($args));
    }

    public function thanx() {

        $this->load->model("register/user");

        $data['email'] = $this->session->data['email'];

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $this->response->setOutput($this->load->view('page/thanx.tpl', $data));
    }

    private function isUserRegistered($data) {

        $this->load->model("register/user");
        return $this->model_register_user->isRegisterUser($data);
    }

    private function isUserInfoExist($data) {

        $this->load->model("register/user");
        return $this->model_register_user->isUserInfoExist($data);
    }

    public function register() {

        $sessiondata['email'] = $this->session->data['email'];
        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        }
        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        }
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        }
        if (isset($this->request->post['mobile'])) {
            $data['mobile'] = $this->request->post['mobile'];
        }
        if (isset($this->request->post['house'])) {
            $data['house'] = $this->request->post['house'];
        }
        if (isset($this->request->post['street'])) {
            $data['street'] = $this->request->post['street'];
        }
        if (isset($this->request->post['loc'])) {
            $data['loc'] = $this->request->post['loc'];
        }
        if (isset($this->request->post['land'])) {
            $data['land'] = $this->request->post['land'];
        }
        if (isset($this->request->post['pin'])) {
            $data['pin'] = $this->request->post['pin'];
        }
        if (isset($this->request->post['area'])) {
            $data['area'] = $this->request->post['area'];
        }
        if (isset($this->request->post['referedby'])) {
            $data['referedbyid'] = $this->request->post['referedby'];
            $this->load->model('register/user');
            $result = $this->model_register_user->updateReferalCode($data);
        }


        if (!$data['mobile'] || !$data['house'] || !$data['street'] || !$data['area'] || $data['mobile'] == "" || $data['house'] == "" || $data['street'] == "" || $data['area'] == "") {
            $this->response->redirect($this->url->link('register/user/address'));
            return;
        }

        $this->load->model("register/user");
        $data['customerid'] = $this->model_register_user->updateUserInfo($data);

        if ($this->isUserInfoExist($data)) {
            $this->response->redirect($this->url->link('register/user/address'));
        } else {
            $this->response->setOutput("Error: Please Try Later!");
        }
    }

    public function slots() {

        if (isset($this->request->get['date']))
            $data['date'] = $this->request->get['date'];

        $data['areaid'] = $this->session->data['areaid'];

        $this->load->model("register/user");
        $json = $this->model_register_user->getAvailableSlots($data);
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput($json);
    }

    public function cancelorder() {

        $this->load->model("register/user");

        $data['order'] = $this->session->data['order'];
        $data['statusid'] = $this->session->data['statusid'];

        $this->model_register_user->cancelOrder($data);

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $this->response->setOutput($this->load->view('page/cancel.tpl', $data));
    }

    public function help() {

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $this->response->setOutput($this->load->view('page/help.tpl', $data));
    }

    public function why() {

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $this->response->setOutput($this->load->view('page/why.tpl', $data));
    }

    public function rate() {

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $this->response->setOutput($this->load->view('page/rate.tpl', $data));
    }

    public function rateagent() {

        $this->load->model("register/user");

        if (isset($this->request->get['rating']))
            $data['rating'] = $this->request->get['rating'];

        $data['customerid'] = $this->session->data['customerid'];

        $this->model_register_user->setAgnetRating($data);

        $this->response->redirect($this->url->link('register/user&email=' . $this->session->data['email']));
    }

    private function send_message_to_customer($url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function history() {

        $data['history'] = "";
        $data['reason'] = array('0' => 'Pending',
            '1' => 'Completed',
            '2' => 'Cancelled',
            '3' => 'Cancelled'
        );
        $this->load->model("register/user");

        $result = $this->model_register_user->userHistory();

        if ($result != null)
            $data['history'] = $result;

        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $this->response->setOutput($this->load->view('page/history.tpl', $data));
    }

    public function receipt() {

        if (isset($this->request->get['id']))
            $data['orderid'] = $this->request->get['id'];

        $this->load->model("register/user");

        $data['reason'] = array('0' => 'Pending',
            '1' => 'Completed',
            '2' => 'Cancelled',
            '3' => 'Cancelled'
        );

        $data['details'] = $this->model_register_user->getOrderDetails($data);


        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $this->response->setOutput($this->load->view('page/receipt.tpl', $data));
    }

}
