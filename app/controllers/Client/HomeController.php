<?php
namespace App\Controllers\Client;
use App\Models\Product;
use App\Models\Category;
use App\Models\Settings;
use App\Models\User;

class homeController extends BaseController{
    protected $product;
    protected $category;
    protected $setting;
    protected $user;
    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->setting = new Settings();
        $this->user = new User();
    }

    public function index()
    {
        $this->user->updateRank();
        $listSettings = $this->setting->listSettings();
        $_SESSION['listSettings'] = $listSettings;
        $kids = $this->product->listProductKids(4);
        $new = $this->product->productNew();
        $bestSeller = $this->product->listProductsBestSeller();
        $listCT = $this->category->listCategory();
        $_SESSION['category'] = $listCT;
        return $this->renderClient("home.home",compact("new","kids",'bestSeller'));
    }


    public function seacrh()
    {
       if(isset($_GET['keyword'])){
           $keyword = $_GET['keyword'];

           // Thực hiện tìm kiếm sản phẩm dựa trên từ khóa
           $searchResults = $this->product->searchProduct($keyword);
           return $this->renderClient("product.search",compact("searchResults","keyword"));
       }
    }
    public function menu($id_ct)
    {
        $oneCT = $this->category->oneCategory($id_ct);
        $menu = $this->product->listProductForCategory($id_ct);
        return $this->renderClient("product.category",compact("menu",'oneCT'));
    }

    public function errorPage()
    {
        return $this->renderClient("home.404");
    }




}
