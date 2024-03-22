<?php
namespace App\Controllers\Client;
use App\Models\Product;
use App\Models\Comment;

class ProductController extends BaseController{
    protected $product;
    protected $comment;
    public function __construct()
    {
        $this->product = new Product();
        $this->comment = new Comment();
    }
    public function detailProduct($id)
    {
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
        $rating = $this->comment->productStatistics($id);
        $product = $this->product->detailProduct($id);
        $id_ct = $product->id_ct;
        $productCL = $this->product->listProductCl($id_ct,$id);
        return $this->renderClient("product.detail", compact('product', 'productCL','soLuong','listComment','rating'));
    }





}