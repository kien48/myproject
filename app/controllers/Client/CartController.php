<?php
namespace App\Controllers\Client;
use App\Models\Cart;

class cartController extends BaseController
{
    public $cart;
    public function __construct()
    {
        $this->cart= new Cart();
    }


    public function index()
    {
        return $this->renderClient("cart.list");
    }
    public function addCart()
    {
        if(isset($_POST['them'])){
            // Kiểm tra xem $_SESSION['giohang'] đã được khởi tạo chưa
            if(!isset($_SESSION['giohang'])){
                $_SESSION['giohang'] = array();
            }

            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $image = $_POST['image'];
            $category = $_POST['category'];
            $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
            $check_sp = 0;

            if(count($_SESSION['giohang']) > 0){
                foreach ($_SESSION['giohang'] as $key => $value){
                    if($key==$id){
                        $check_sp = 1;
                        $_SESSION['giohang'][$id]["quantity"]+=$quantity;
                        break;
                    }
                }
            }

            if($check_sp == 0){
                // Không cần tạo mảng mới ở đây, chỉ cần gán trực tiếp
                $_SESSION['giohang'][$id] = ["id"=>$id,"name"=>$name,"price"=>$price,"image"=>$image,"category"=>$category,"quantity"=>$quantity];
            }

            // Chuyển hướng người dùng đến trang giỏ hàng
            header('Location: ' . BASE_URL . 'list-cart');
        }

    }
    public function delete()
    {

        if(count($_SESSION['giohang'])){
            $_SESSION['giohang'] = [];
        }
        return $this->renderClient("cart.list");
    }
    public function order()
    {
        return $this->renderClient("cart.order");
    }
}
