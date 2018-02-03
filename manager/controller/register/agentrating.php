<?php
class ControllerRegisterAgentrating extends Controller{
   
	
    public function getagentrating(){
        
        $this->load->model('register/agentrating');
       
        $result = $this->model_register_agentrating->getAgentRating();
        $this->response->setOutput($result);
    
    }
}