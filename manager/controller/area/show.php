<?php
class ControllerAreaShow extends Controller{
	
    public function getshowarea(){
        
        $this->load->model('area/show');
       
        $result = $this->model_area_show->getShowArea();
        $this->response->setOutput($result);
    
    }
      public function changestatus(){
        $area=$this->request->get["areaid"];
        $this->load->model('area/show');
       
        $result = $this->model_area_show->getChangeStatus($area);
        $this->response->setOutput($result);
    }

}
