<?php
namespace App\Controllers\Admin;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\discount;
use App\Models\Post;



class DashboardController extends BaseController{
     private $cart;
     private $user;
    private $product;
    private $category;
    private $discount;
    private $post;

    public function __construct()
     {
         $this->cart= new Cart();
         $this->user = new User();
         $this->product = new Product();
         $this->category = new Category();
         $this->discount = new discount();
         $this->post = new Post();
         $dem = $this->user->dem();
         $_SESSION['$dem'] = $dem;
     }

    public function index()
     {

         $totalToday = $this->cart->totalToday();
         $totalAll= $this->cart->total();
         $totalProduct = $this->product->totalProduct();
         $totalCategory = $this->category->totalCategory();
         $totalUser = $this->user->totalUser();
         $totalDiscount = $this->discount->totalDiscount();
         $totalPost = $this->post->totalPost();
         $totalOrderSucsess = $this->cart->totalOrder();
         return $this->renderAdmin("dashboard.list",compact('totalToday','totalAll','totalProduct','totalCategory','totalUser','totalDiscount','totalPost','totalOrderSucsess'));
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