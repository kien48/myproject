<?php
namespace App\Controllers\Admin;
use App\Models\Cart;

class DashboardController extends BaseController{
     private $cart;
     public function __construct()
     {
         $this->cart= new Cart();
     }

    public function index()
     {

         $totalToday = $this->cart->totalToday();
         return $this->renderAdmin("dashboard.list",compact('totalToday'));
     }
    public function darkMode()
    {
        if (isset($_POST['submit'])) {
            if (isset($_POST['darkmode'])) {
                $_SESSION['darkMode'] = $_POST['darkmode'];
            } else {
                unset($_SESSION['darkMode']);
            }
        }

        // Redirect back to the current page
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }



}