<?php
namespace App\Controllers\Admin;
use eftec\bladeone\BladeOne;

class BaseController{

    protected function renderAdmin($viewFile, $data = []){
        $viewDir = "./app/views/Admin/";
        $storageDir = "./storage";
        $blade = new BladeOne($viewDir,$storageDir, BladeOne::MODE_DEBUG);
        echo $blade->run($viewFile, $data);
    }
}

?>
