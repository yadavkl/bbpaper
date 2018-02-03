
<?php

class ControllerPermissionUser extends Controller {

    public function adminDefaultPermission() {
        $access[]='area/app';
        $access[]='area/show';
        $access[]='dashboard/home';
        $access[]='register/agent';
        $access[]='register/agentrting';
        $permission['access'] = $access;
    }

}
