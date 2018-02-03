<?php
class ControllerOrderCreate extends Controller{
    
      function index(){
        

         //print_r($this->request->post);
           $data['firstname'] = $this->request->post['firstname'];
           $data['lastname'] = $this->request->post['lastname'];
           $data['mobile'] = $this->request->post['mobile'];
           $data['email'] = $this->request->post['email'];
           $data['houseno'] = $this->request->post['houseno'];
           $data['street'] = $this->request->post['street'];
           $data['location'] = $this->request->post['location'];  
           $areaarr = explode(":",$this->request->post['areaid']);         
           $data['areaid'] = $areaarr[0];
           $data['area'] = $areaarr[1];  
           $data['date'] = $this->request->post['date'];
           $data['bookedslot'] = $this->request->post['slot'];
           $this->load->model('order/create');
           $json = $this->model_order_create->createorder($data);  
           $this->response->addHeader('Content-Type: application/json');
           $this->response->setOutput($json);
      
         //   $this->response->redirect("?route=dashboard/home#/createorder");
    
    }
  }