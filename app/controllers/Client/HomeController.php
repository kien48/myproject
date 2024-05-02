<?php

namespace App\Controllers\Client;

use App\Models\Product;
use App\Models\Category;
use App\Models\Settings;
use App\Models\User;

class homeController extends BaseController
{
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

        // Lấy và lưu cài đặt trong phiên khi khởi tạo controller
        $listSettings = $this->setting->listSettings();
        $_SESSION['listSettings'] = $listSettings;

        $listCT = $this->category->listCategory();
        $_SESSION['category'] = $listCT;
    }

    public function index()
    {


        // Lấy danh sách sản phẩm cho trẻ em, sản phẩm mới và sản phẩm bán chạy
        $kids = $this->product->listProductKids(4);
        $new = $this->product->productNew();
        $bestSeller = $this->product->listProductsBestSeller();
        $bienThe = $this->product->listBienThe();
        return $this->renderClient("home.home", compact("new", "kids", 'bestSeller', 'bienThe'));
    }

    public function search()
    {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            // Thực hiện tìm kiếm sản phẩm dựa trên từ khóa
            $searchResults = $this->product->searchProduct($keyword);
            $bienThe = $this->product->listBienThe();
            return $this->renderClient("product.search", compact("searchResults", "keyword", 'bienThe'));
        }
    }

    public function menu($id_ct)
    {
        // Lấy thông tin của một danh mục và danh sách sản phẩm trong danh mục đó
        $oneCT = $this->category->oneCategory($id_ct);
        $menu = $this->product->listProductForCategory($id_ct);
        $bienThe = $this->product->listBienThe();
        if (!$oneCT) {
            return $this->renderClient('home.404');
            exit();
        }
        return $this->renderClient("product.category", compact("menu", 'oneCT', 'bienThe'));
    }

    public function errorPage()
    {
        return $this->renderClient("home.404");
    }
}
