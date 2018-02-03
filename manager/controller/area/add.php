<?php

class ControllerAreaAdd extends Controller {

    function index() {
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            
            if (isset($this->request->post['areaid'])) {
                $data['areaid'] = $this->request->post['areaid'];
            }
            if (isset($this->request->post['areaname'])) {
                $data['areaname'] = $this->request->post['areaname'];
            }

            $this->load->model('area/add');
            $this->model_area_add->setarea($data);
        }
        $this->response->redirect("?route=dashboard/home#/addarea");
    }

    protected function validate() {
        
        if (!$this->user->hasPermission('modify', 'area/add')) {
            return false;
        }
        return true;
    }

}
