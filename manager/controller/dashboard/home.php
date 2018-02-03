<?php
class ControllerDashboardHome extends Controller{
    
    function index(){
        
        if($this->user->isLogged()){
            
            $this->response->setOutput($this->load->view('dashboard.tpl'));
        }else{
            
            $this->response->setOutput($this->load->view('login.tpl'));
        }
    }
    
    function login(){
        
       if($this->request->post['username']){
            
            $username = $this->request->post['username'];
        }
        
        if($this->request->post['password']){
            
            $password = $this->request->post['password'];
        }
        
        if(!$this->user->isLogged()){
               
           $this->user->login($username,$password); 
        }
        $this->response->redirect("?route=dashboard/home");
        
    }
    
    function logout(){
        
        $this->user->logout();
        $this->response->redirect("?route=dashboard/home"/*$this->load->view('login.tpl')*/);
    }


}