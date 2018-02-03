<?php

class ControllerPermissionAdmin extends Controller{
   private  $page = array("area/add","area/show","dashboard/register","order/create","order/status",
       "permission/user","register/agent","register/agentrating","rss/feeds",);
    
    function index(){
        $data = array(
        "access" =>$this->page,
        "modify" =>$this->page
    );
        echo serialize($data);
    }
}

