<?php

class ControllerDashboardRegister extends Controller {

    public function index() {
        $this->response->setOutput($this->load->view('register/user.tpl'));
    }

    public function user() {

        if (isset($this->request->post['username'])) {
            $data['username'] = $this->request->post['username'];
        }

        if (isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        }
        
        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        }
        
        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        }  

        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        }     
        
        if (isset($this->request->post['phone'])) {
            $data['phone'] = $this->request->post['phone'];
        }             
        
        $this->load->model('register/user');
        $this->model_register_user->register($data);
    }

}
