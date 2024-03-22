<?php
namespace App\Controllers\Admin;

class DashboardController extends BaseController{
     public function index()
     {
         return $this->renderAdmin("dashboard.list");
     }
}