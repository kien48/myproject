<?php
namespace App\Controllers\Client;
use eftec\bladeone\BladeOne;

class BaseController{

    protected function renderClient($viewFile, $data = []){
        $viewDir = "./app/views/Client/";
        $storageDir = "./storage";
        $blade = new BladeOne($viewDir,$storageDir, BladeOne::MODE_DEBUG);
        echo $blade->run($viewFile, $data);
    }
}

?>
