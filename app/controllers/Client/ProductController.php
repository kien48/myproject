<?php
namespace App\Controllers\Client;
use App\Models\Category;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Settings;

class ProductController extends BaseController{
    protected $product;
    protected $comment;
    protected $category;
    protected $setting;
    public function __construct()
    {
        $this->product = new Product();
        $this->comment = new Comment();
        $this->category = new Category();
        $this->setting = new Settings();

        // Lấy và lưu cài đặt trong phiên khi khởi tạo controller
        $listSettings = $this->setting->listSettings();
        $_SESSION['listSettings'] = $listSettings;

        $listCT = $this->category->listCategory();
        $_SESSION['category'] = $listCT;
    }
    public function detailProduct($id)
    {

        $product = $this->product->detailProduct($id);
        if (!$product) {
            return $this->renderClient('home.404',"bienThe");
            exit();
        }

        $soLuong = 1; // Khởi tạo giá trị mặc định cho $soLuong
        $listComment = $this->comment->listComment($id);
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Hà Nội
        if(isset($_POST['send'])){
            $id_pro = $id;
            $id_user = isset($_SESSION['user']) ? $_SESSION['user']->id : 0;
            $content = $_POST['content'];
            $date = date('Y-m-d H:i:s');
            $star = isset($_POST['option'][0]) ? $_POST['option'][0] :0;
            $this->comment->insertComment(NULL,$id_user,$content,$date,$id_pro,$star);
            header('Location: ' . BASE_URL . 'detail/'.$id);
        }
        $total = $this->product->numberOfProductSales($id);
        $rating = $this->comment->productStatistics($id);
        $product = $this->product->detailProduct($id);
        $id_ct = $product->id_ct;
        $productCL = $this->product->listProductCl($id_ct,$id);
        $feedback = [];
        foreach ($listComment as $value) {
            $feedback[] = $this->comment->feedBack($value->id);
        }
        $bienThe = $this->product->bienThe($id);
        $bienThe1 = $this->product->listBienThe();

        return $this->renderClient("product.detail", compact('product', 'productCL','soLuong','listComment','rating','total','feedback','bienThe','bienThe1'));
    }



    public function listTopProduct(){
        $listTop = $this->product->topProducts();
        return $this->renderClient("product.top",compact('listTop'));
    }





}