<?php

class ControllerRegisterAgent extends Controller {

    public function index() {

        $this->load->model("register/agent");

        if (isset($this->request->get['email'])) {
            $data['email'] = $this->request->get['email'];
            $this->session->data['email'] = $data['email'];
        }

        $data['header'] = $this->load->view('agent/header.tpl');
        $data['footer'] = $this->load->view('agent/footer.tpl');

        if (isset($data['email']) || isset($this->session->data['email'])) {
            $data['email'] = $this->session->data['email'];

            if (!$this->model_register_agent->isRegisteredAgent($data)) {
                $this->response->setOutput($this->load->view('agent/error.tpl', $data));
                return;
            }
        } else {
            $this->response->setOutput($this->load->view('agent/error.tpl', $data));
            return;
        }
        $data['orders'] = $this->model_register_agent->getAgentOrder($data);
        if ($data['orders'] == null) {

            $this->response->setOutput($this->load->view('agent/noorder.tpl', $data));
            return;
        }
        $this->response->setOutput($this->load->view('agent/body.tpl', $data));
    }

    public function orderbydate() {

        if (isset($this->request->get['date']))
            $data['date'] = $this->request->get['date'];

        if (isset($this->request->get['email']))
            $data['email'] = $this->request->get['email'];

        $this->load->model("register/agent");

        $data['header'] = $this->load->view('agent/header.tpl');
        $data['footer'] = $this->load->view('agent/footer.tpl');

        $data['orders'] = $this->model_register_agent->getAgentOrderByDate($data);

        if ($data['orders'] == null) {

            $this->response->setOutput($this->load->view('agent/noorder.tpl', $data));
            return;
        }

        $this->response->setOutput($this->load->view('agent/body.tpl', $data));
    }

    public function complete() {

        $this->load->model("register/agent");

        if (isset($this->request->post['weight']))
            $data['weight'] = $this->request->post['weight'];

        if (isset($this->request->post['statusid']))
            $data['statusid'] = $this->request->post['statusid'];

        $customer = $this->model_register_agent->closeorder($data);
        
        if (isset($this->request->post['promotionamount'])){
            $data['amount'] = $this->request->post['promotionamount'];
            $data['customerid'] = $customer['customerid'];
            $this-> $this->model_register_agent->updateRedemAmount($data);            
        }
        
        $args = array(
            'username' => USER,
            'pass' => PASSWORD,
            'senderid' => SENDERID,
            'message' => "Dear, " . $customer['firstname'] . " " . $customer['lastname'] . " Thank You, You have received Rs. " . $customer['cost'] . " for " . $data['weight'] . "  Kg paper. And Promotional amount Rs.".$data['amount']."For Any issue, contact support team.",
            'dest_mobileno' => "91" . $customer['mobile'],
            'response' => 'Y'
        );

        $ret = $this->send_message_to_customer(MESSAGE_SERVICE_URL . http_build_query($args));

        $this->response->redirect($this->url->link('register/agent'));
    }

    public function redemamount() {
        if (isset($this->request->post['statusid'])) {
            $data['statusid'] = $this->request->post['statusid'];
        }
        if (isset($this->request->post['amount'])) {
            $data['amount'] = $this->request->post['amount'];
        }
        $this->load->model('register/user');
        $this->model_register_user->updateRedemAmount();
    }

    public function useramount() {
        
        if (isset($this->request->get['statusid'])) {
            $this->load->model('register/agent');
            $data['statusid'] = $this->request->get['statusid'];
        }
        $result = $this->model_register_agent->getUserExtraAmount($data);
        $this->response->setOutput($result);
    }

    public function cancel() {
        $this->load->model("register/agent");

        if (isset($this->request->post['reason']))
            $data['reason'] = $this->request->post['reason'];
        if (isset($this->request->post['statusid']))
            $data['statusid'] = $this->request->post['statusid'];

        $this->model_register_agent->cancelorder($data);
        $this->response->redirect($this->url->link('register/agent'));
    }

    public function sendmessage() {
        $this->load->model("register/agent");
        $data['email'] = $this->session->data['email'];

        $customers = $this->model_register_agent->getCustomerPhoneNumbers($data);

        foreach ($customers as $customer) {
            $args = array(
                'username' => USER,
                'pass' => PASSWORD,
                'senderid' => SENDERID,
                'message' => "Dear, " . $customer['firstname'] . " " . $customer['lastname'] . " your order will be collected today between " . $customer['bookedslot'] . " Regards, Buy Bye Paper",
                'dest_mobileno' => "91" . $customer['mobile'],
                'response' => 'Y'
            );

            $ret = $this->send_message_to_customer(MESSAGE_SERVICE_URL . http_build_query($args));
        }
        $this->response->redirect($this->url->link('register/agent'));
    }

    public function noorder() {
        $this->response->setOutput($this->load->view('agent/noorder.tpl'));
    }

    private function send_message_to_customer($url) {
        echo $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

}

//Class