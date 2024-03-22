<?php
namespace App\Controllers\Client;
use App\Models\Product;
use App\Models\Category;

class homeController extends BaseController{
    protected $product;
    protected $category;
    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function index()
    {

        $products = $this->product->listProduct();
        $kids = $this->product->listProductKids(4);
        $new = $this->product->productNew();
        return $this->renderClient("home.home",compact("new","kids"));
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
        // Lấy URL hiện tại
        $currentUrl = $_SERVER['REQUEST_URI'];

// Tách URL thành các phần dựa trên dấu '/'
        $urlParts = explode('/', $currentUrl);

// Lấy phần tử cuối cùng trong mảng, sau cùng là tham số bạn quan tâm
        $parameter = end($urlParts);

// Kiểm tra giá trị của tham số và gán cho biến $get tương ứng
        if ($parameter == '3') {
            $get = "Đồng phục";
        } else if ($parameter == '1') {
            $get = "Nam";
        } else if ($parameter == '2') {
            $get = "Nữ";
        } else if ($parameter == '4') {
            $get = "Trẻ em";
        } else {
            $get = "Không xác định"; // Giá trị mặc định nếu không khớp với bất kỳ giá trị nào
        }

        $menu = $this->product->listProductForCategory($id_ct);
        return $this->renderClient("product.category",compact("menu","get"));
    }




}
