<?php

class ControllerRegisterAgent extends Controller {

    function index() {

        $data['areaid'] = $this->request->post['areaid'];
        $data['name'] = $this->request->post['name'];
        $data['email'] = $this->request->post['email'];
        $data['phone'] = $this->request->post['phone'];
        $data['image'] = $this->request->files['image']['name'];

        move_uploaded_file($this->request->files['image']['tmp_name'], UPLOAD_DIR . $this->request->files['image']['name']);

        $this->load->model('register/agent');
        $this->model_register_agent->setagent($data);
        $this->model_register_agent->getrole();

        $this->response->redirect("?route=dashboard/home#/registeragent");
    }

    public function getagentinfo() {

        $this->load->model('register/agent');

        $result = $this->model_register_agent->getAgentInfo();
        $this->response->setOutput($result);
    }

    public function getareaid() {

        $this->load->model('register/agent');

        $result = $this->model_register_agent->getAreaId();
        $this->response->setOutput($result);
    }

    public function agentapprove() {

        $this->load->model('register/agent');

        $result = $this->model_register_agent->AgentApprove();
        $this->response->setOutput($result);
    }

    public function removeagent() {
        $agent = $this->request->get["agentid"];
        $this->load->model('register/agent');

        $result = $this->model_register_agent->agentRemoveRequest($agent);
        $this->response->setOutput($result);
    }

}
