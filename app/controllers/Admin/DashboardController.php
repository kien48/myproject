<?php
namespace App\Controllers\Admin;
use App\Models\Cart;
use App\Models\User;

class DashboardController extends BaseController{
     private $cart;
    public $user;
     public function __construct()
     {
         $this->cart= new Cart();
         $this->user = new User();
         $dem = $this->user->dem();
         $_SESSION['$dem'] = $dem;
     }

    public function index()
     {

         $totalToday = $this->cart->totalToday();
         $total_week = $this->cart->totalThisWeek();

         return $this->renderAdmin("dashboard.list",compact('totalToday','total_week'));
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