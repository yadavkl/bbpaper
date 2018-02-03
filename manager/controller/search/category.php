<?php
class ControllerSearchCategory extends Controller{
    
    public function index(){ 
        
        $data['key']=isset($this->request->get['key'])?$this->request->get['key']:"";               
        $this->load->model('search/category');

        $category = $this->model_search_category->getCategory($data);
        
        if( $category == NULL || !file_exists(DIR_TEMPLATE.'search/'.$category.'.tpl') )        
        {
        	if( $category == NULL ){
        		$this->model_search_category->setUnknownKeyword($data['key']);
        	}
        	$this->response->addHeader('Content-Type: application/xml');
        	$this->response->setOutput($this->load->view('search/null.tpl')); 
        	return; 
        }
        
        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($this->load->view('search/'.$category.'.tpl'));   
   
    }
}