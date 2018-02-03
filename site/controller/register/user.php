<?php

class ControllerRegisterUser extends Controller {

    function index() {
        
        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        }
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        }
        if (isset($this->request->post['pass'])) {
            $data['pass'] = $this->request->post['pass'];
        }
        if (isset($this->request->post['phone'])) {
            $data['phone'] = $this->request->post['phone'];
        }
        if (isset($this->request->post['address'])) {
            $data['address'] = $this->request->post['address'];
        }
        if (isset($this->request->post['area'])) {
            $data['area'] = $this->request->post['area'];
        }
        $this->load->model('register/user');
        
        if( !$this->model_register_user->isUserExist( $data) ){
                
            $this->model_register_user->registerUser( $data);            
        }
    }

}
