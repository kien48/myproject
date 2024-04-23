<?php
namespace App\Controllers\Client;
use App\Models\Cart;
use App\Models\discount;

class cartController extends BaseController
{
    public $cart;
    public $discount;


    public function __construct()
    {
        $this->cart= new Cart();
        $this->discount= new discount();

    }


    public function index()
    {return $this->renderClient("cart.list");
    }
    public function addCart()
    {
        if (isset($_POST['them'])) {
            // Kiểm tra xem $_SESSION['giohang'] đã được khởi tạo chưa
            if (!isset($_SESSION['giohang'])) {
                $_SESSION['giohang'] = [];
            }

            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $image = $_POST['image'];
            $category = $_POST['category'];
            $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
            $check_sp = 0;

            if (count($_SESSION['giohang']) > 0) {
                foreach ($_SESSION['giohang'] as $key => $value) {
                    if ($key == $id) {
                        $check_sp = 1;
                        $_SESSION['giohang'][$id]["quantity"] += $quantity;
                        break;
                    }
                }
            }

            if ($check_sp == 0) {
                // Không cần tạo mảng mới ở đây, chỉ cần gán trực tiếp
                $_SESSION['giohang'][$id] = ["id" => $id, "name" => $name, "price" => $price, "image" => $image, "category" => $category, "quantity" => $quantity];
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
    public function addOrder()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Hà Nội

        if(isset($_POST['submit'])){

            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $id_user = isset($_SESSION['user']) ? $_SESSION['user']->id : 0;
            $note = $_POST['note'];
            $ship = $_POST['ship'];
            $date = date('Y-m-d H:i:s');
            $payment = $_POST['pay'];
            $percentDiscount = $_POST['percent_discount'];
            $matchedId = $_POST['id_code'];
            // Xác định giá trị tổng hoàn thành dựa trên liệu có áp dụng mã giảm giá không
            if(isset($_POST['totalCompleted'])){
                $totalCompleted = $_POST['totalCompleted'];
            } else {
                $totalCompleted = $_POST['total'];
            }

            $id_order = $this->cart->order(NULL, $name, $phone, $address, $id_user, $totalCompleted, $date, $note, $ship, $payment, 1, $percentDiscount);
            $this->discount->applySuccess($matchedId); // Áp dụng giảm giá chỉ khi người dùng chọn "submit"
            if($id_order){
                foreach ($_SESSION['giohang'] as $item) {
                    $this->cart->orderDetail(NULL, $id_order,$item['id'], $item['name'], $item['quantity'], $item['price'], $item['price'] * $item['quantity']);
                }
                unset($_SESSION['total']);
                unset($_SESSION['giohang']);
                header('Location: ' . BASE_URL . 'order/success');
            } else {
                $this->discount->applyFail($matchedId);
                header('Location: ' . BASE_URL . 'order/errors');
            }
        }

        // Xử lý áp dụng mã giảm giá
        if(isset($_POST['apply'])){
            $code = $_POST['code'];
            $checkCode = $this->discount->listDiscount();
            $status = "Áp dụng thất bại"; // Khởi tạo status mặc định
            $totalCompleted = $_SESSION['total']; // Khởi tạo totalCompleted mặc định
            $matchedPercent = null; // Khởi tạo biến lưu trữ % mã giảm giá khớp
            $matchedId = null; // Khai báo biến lưu trữ ID mã giảm giá khớp

            // Lặp qua danh sách mã giảm giá
            foreach ($checkCode as $check){
                if($code == $check->code){
                    $matchedPercent = $check->percent; // Lưu mã giảm giá khớp
                    $matchedId = $check->id; // Lưu ID mã giảm giá khớp
                    $status = "Áp dụng thành công mã ".$check->percent."%";
                    $totalCompleted = ($_SESSION['total'] + 30000)  - ($_SESSION['total'] +30000)*$check->percent/100;
                    break; // Thoát khỏi vòng lặp sau khi tìm thấy mã giảm giá khớp
                }
            }

            return $this->renderClient("cart.order", compact('status', 'totalCompleted', 'matchedPercent','matchedId'));
        }




    }


    public function success()
    {
        return $this->renderClient("cart.success");
    }
    public function errors()
    {
        return $this->renderClient("cart.errors");
    }

    public function listOrder()
    {

        $listOrder = $this->cart->listOrder($_SESSION['user']->id);
        return $this->renderClient("order.list",compact('listOrder'));
    }
    public function detailOrder()
    {
        return $this->renderClient("order.detail");
    }

    public function deleteCartProduct($id)
    {
        unset($_SESSION['giohang'][$id]);
        // Chuyển hướng người dùng đến trang giỏ hàng
        header('Location: ' . BASE_URL . 'list-cart');
    }

    public function updateQuantityProductCart()
    {
        $status = 0; // Khởi tạo biến status
        // Kiểm tra xem có dữ liệu gửi lên không
        if(isset($_POST['quantitynew']) && isset($_POST['id_product'])) {
            // Lặp qua mỗi sản phẩm được gửi lên từ form
            foreach($_POST['id_product'] as $index => $id) {
                // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
                if(isset($_SESSION['giohang'][$id])) {
                    // Cập nhật số lượng mới cho sản phẩm
                    $quantityNew = $_POST['quantitynew'][$index];
                    $_SESSION['giohang'][$id]['quantity'] = $quantityNew;
                    $status = 1; // Cập nhật biến status thành 1 khi cập nhật số lượng thành công
                } else {
                    // Sản phẩm không tồn tại trong giỏ hàng
                    // Xử lý thông báo lỗi hoặc thực hiện các hành động khác tùy theo yêu cầu
                    // Ví dụ:
                    // header('Location: ' . BASE_URL . 'error-page');
                    // hoặc
                    // echo "Sản phẩm không tồn tại trong giỏ hàng.";
                }
            }

            // Sau khi cập nhật xong, chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác
            return $this->renderClient("cart.list", compact('status')); // Trả về trạng thái sau khi cập nhật
            exit; // Chắc chắn kết thúc chương trình sau khi chuyển hướng
        } else {
            // Nếu không có dữ liệu gửi lên hoặc thiếu dữ liệu, cập nhật biến status và chuyển hướng đến trang lỗi
            $status = 0;
            header('Location: ' . BASE_URL . 'error-page');
            exit; // Chắc chắn kết thúc chương trình sau khi chuyển hướng
        }
    }










}

