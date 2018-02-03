<?php
ini_set('max_execution_time', 300);
class ControllerOrderStatus extends Controller{
    
    public function update_agent_approval(){
        echo   $json=''.$this->request->get['agents'].'';
        $get_data= htmlspecialchars_decode($json);
        $data['decode_data']=json_decode($get_data,true);
        print_r($data);
        	
        $this->load->model('order/status');
        $this->model_order_status->update_agent_approval($data);
        //  $this->response->redirect("?route=dashboard/home/login#/pagepermission");
    }
    
    public function getorderstatus(){
        
        $this->load->model('order/status');
        
        $result = $this->model_order_status->getOrderStatus();
        $this->response->setOutput($result);
    
    }
     public function getcustomerstatus(){
        
        $this->load->model('order/status');
        
        $result = $this->model_order_status->getCustomerStatus();
        $this->response->setOutput($result);
    
    }
    public function getmessagestatus(){
        
        $this->load->model('order/status');
        
        $result = $this->model_order_status->getMessageStatus();
        $this->response->setOutput($result);
        
    }
    public function getagentinfo(){
    
        $this->load->model('order/status');
    
        $result = $this->model_order_status->getAgentInfo();
        $this->response->setOutput($result);
    
    }
    public function getrole(){
    
        $this->load->model('order/status');
        $result = $this->model_order_status->getrole();
        $this->response->setOutput($result);
    
    }
    public function getpage(){
    
        $this->load->model('order/status');
        $result = $this->model_order_status->getpage();
        $this->response->setOutput($result);
    
    }
    public function getpagevalue(){
    
        $this->load->model('order/status');
        $result = $this->model_order_status->getpage();
        $this->response->setOutput($result);
    
    }
      //public function getbookingstatus(){
        
     //   $this->load->model('order/status');
        
     //   $result = $this->model_order_status->getBookingStatus();
     //   $this->response->setOutput($result);
        
    //}

     public function gethistory(){

        $cust = $this->request->get['customerid'];
        
        $this->load->model('order/status');
        
        $result = $this->model_order_status->getHistory($cust);
        $this->response->setOutput($result);     
    
    }
    public function getavailableslots(){
        
        $this->load->model('order/status');
        $data['date'] = $this->request->get['date'];
        $data['areaid'] = $this->request->get['areaid'];
        $result = $this->model_order_status->getAvailableSlots($data);
        $this->response->setOutput($result);
       
    
    }
       public function totalorderstatus(){
        
        $this->load->model('order/status');
        
        $result = $this->model_order_status->getTotalStatus();
        $this->response->setOutput($result);
       
    
    }
    public function getbookingstatus() {    

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
        
        if (date('N') != 2){
            $data['today'] = date("Y-m-d");
        }
        $this->response->setOutput(json_encode($data));
        
        
    }
}