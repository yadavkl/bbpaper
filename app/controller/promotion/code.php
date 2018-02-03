<?php

class ControllerPromotionCode extends Controller{
    
    function index(){
        
        $data['header'] = $this->load->view('page/header.tpl');
        $data['footer'] = $this->load->view('page/footer.tpl');
        $data['home'] = $this->url->link('register/user');
        $data['error'] = isset($this->session->data['error'] ) ? $this->session->data['error']:"";
        unset($this->session->data['error']);
        $this->response->setOutput($this->load->view('page/promotion.tpl',$data));
    }
}

