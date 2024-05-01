<?php
namespace App\Controllers\Client;
use App\Models\Cart;
use App\Models\Category;
use App\Models\discount;
use App\Models\Product;
use App\Models\Settings;

class cartController extends BaseController
{
    public $cart;
    public $discount;
    public $product;
    protected $category;
    protected $setting;


    public function __construct()
    {
        $this->cart= new Cart();
        $this->discount= new discount();
        $this->product= new Product();
        $this->category = new Category();
        $this->setting = new Settings();


        // Lấy và lưu cài đặt trong phiên khi khởi tạo controller
        $listSettings = $this->setting->listSettings();
        $_SESSION['listSettings'] = $listSettings;

        $listCT = $this->category->listCategory();
        $_SESSION['category'] = $listCT;

// Khởi tạo giỏ hàng nếu chưa có
        if (!isset($_SESSION['giohang'])) {
            $_SESSION['giohang'] = [];
        }
    }


    public function index()
    {
        $maxQuantity = $this->product->listBienThe();
        foreach ($_SESSION['giohang'] as $key=>$value) {
            if($_SESSION['giohang'][$key]['quantity'] == 0 ){
                unset($_SESSION['giohang'][$key]);
            }
        }
        return $this->renderClient("cart.list",compact('maxQuantity'));
    }
    public function addCart()
    {
        if (isset($_POST['them'])) {
            $errors = [];
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
            $keyID = uniqid();
            $size_radio =  $_POST['size_radio'][0];
            $color_radio = $_POST['color_radio'][0];
            $variant = $this->product->listBienTheSP($id);

// Kiểm tra xem size và color đã được chọn chưa
            if (empty($size_radio) || empty($color_radio)) {
                $errors[] = "Vui lòng chọn kích thước và màu sắc!";
            }

            foreach ($variant as $key=>$item) {
                if ($item->size === $size_radio && $item->color === $color_radio) {
                    if ($item->quantity < $quantity) {
                        $errors[] = "Số lượng sản phẩm vượt quá số lượng trong kho";
                    }

                    break; // Không cần kiểm tra các biến thể khác nếu đã tìm được
                }
            }

            if (empty($errors)) {
                    if (count($_SESSION['giohang']) > 0) {
                        foreach ($_SESSION['giohang'] as $cart_id => $item) {
                            // Kiểm tra sản phẩm có trong giỏ hàng với cùng id, size và color
                            if ($item['id'] == $id && $item['size'] == $size_radio && $item['color'] == $color_radio) {
                                $check_sp = 1; // Đánh dấu sản phẩm đã tồn tại trong giỏ hàng
                                $_SESSION['giohang'][$cart_id]["quantity"] += $quantity; // Tăng số lượng sản phẩm
                                break;
                            }
                        }
                    }

                    if ($check_sp == 0) {
                        // Không cần tạo mảng mới ở đây, chỉ cần gán trực tiếp
                        $_SESSION['giohang'][] = [
                            "keyID" => $keyID,
                            "id" => $id,
                            "name" => $name,
                            "price" => $price,
                            "image" => $image,
                            "category" => $category,
                            "quantity" => $quantity,
                            "size" => $size_radio,
                            "color" => $color_radio
                        ];
                    }
                }
            }

            if (!empty($errors)) {
                flash('errors', $errors, 'detail/' . $id);
            } else {
                flash('success', "Thêm vào giỏ thành công", 'detail/' . $id);
            }

            exit();
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
            $ship = 'Giao hàng nhanh';
            $date = date('Y-m-d H:i:s');
            $payment = 'Thanh toán COD';
            $percentDiscount = isset($_POST['percent_discount']) ? $_POST['percent_discount'] : 0;
            $matchedId = isset($_POST['id_code']) ? $_POST['id_code'] : 0;
            // Xác định giá trị tổng hoàn thành dựa trên liệu có áp dụng mã giảm giá không
            if(isset($_POST['totalCompleted'])){
                $totalCompleted = $_POST['totalCompleted'];
            } else {
                $totalCompleted = $_POST['total'];
            }

            $id_order = $this->cart->order(NULL, $name, $phone, $address, $id_user, $totalCompleted, $date, $note, $ship, $payment, 1, $percentDiscount,1);
            $this->discount->applySuccess($matchedId); // Áp dụng giảm giá chỉ khi người dùng chọn "submit"
            if($id_order){
                foreach ($_SESSION['giohang'] as $item) {
                    $this->cart->orderDetail(NULL, $id_order,$item['id'], $item['name'], $item['quantity'], $item['price'], $item['price'] * $item['quantity'],$item['size'],$item['color']);
                    $this->cart->updateQuantity($item['quantity'],$item['id'],$item['color'],$item['size']);
                }
                unset($_SESSION['total']);
                unset($_SESSION['giohang']);
                header('Location: ' . BASE_URL . 'order/success');
                exit; // Thêm exit để dừng việc thực thi mã PHP tiếp theo sau khi chuyển hướng
            } else {
                $this->discount->applyFail($matchedId);
                header('Location: ' . BASE_URL . 'order/errors');
                exit; // Thêm exit để dừng việc thực thi mã PHP tiếp theo sau khi chuyển hướng
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
        $maxQuantity = $this->product->listBienThe();
        // Kiểm tra xem có dữ liệu số lượng mới và key được gửi lên không
        if(isset($_POST['quantitynew']) && isset($_POST['key'])) {
            // Lặp qua mỗi sản phẩm được gửi lên từ form
            foreach($_POST['key'] as $index => $keyID) {
                // Lặp qua mỗi sản phẩm trong giỏ hàng để tìm sản phẩm cần cập nhật số lượng
                foreach ($_SESSION['giohang'] as $cartIndex => &$cart){
                    // Kiểm tra nếu keyID của sản phẩm trong giỏ hàng trùng với keyID gửi từ form
                    if($cart['keyID'] == $keyID) {
                        // Cập nhật số lượng mới cho sản phẩm
                        $quantityNew = $_POST['quantitynew'][$index];
                        $cart['quantity'] = $quantityNew;
                        $status = 1; // Cập nhật biến status thành 1 khi cập nhật số lượng thành công
                        $found = true; // Đánh dấu là đã tìm thấy sản phẩm
                        break; // Thoát khỏi vòng lặp khi tìm thấy sản phẩm
                    }
                }
            }

            // Sau khi cập nhật xong, chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác
            return $this->renderClient("cart.list",compact('status','maxQuantity'));
            exit; // Chắc chắn kết thúc chương trình sau khi chuyển hướng
        } else {
            // Nếu không có dữ liệu gửi lên hoặc thiếu dữ liệu, cập nhật biến status và chuyển hướng đến trang lỗi
            $status = 0;
            return $this->renderClient("cart.list",compact('status','maxQuantity'));
            exit; // Chắc chắn kết thúc chương trình sau khi chuyển hướng
        }

    }


    public function detail($id)
    {
        $orderID = $this->cart->detailOrderForID($id);
        $order = $this->cart->detailOrder($id);
        return $this->renderClient("order.detail",compact('order','orderID'));
    }

    public function huy()
    {
        if (isset($_POST['huy'])) {
            $invoice_id = $_POST['invoice_id'];
            $id_product = $_POST['id_product'];
            $quantity = $_POST['quantity'];
            $size = $_POST['size'];
            $color = $_POST['color'];

            // Lấy danh sách biến thể bên trong điều kiện hủy
            $listBienThe = $this->product->listBienThe();

            $check = $this->cart->huyOrder($invoice_id);
            if ($check) {
                foreach ($listBienThe as $item) {
                    foreach ($id_product as $key => $value) {
                        if ($value == $item->idpro && $size[$key] == $item->size && $color[$key] == $item->color) {
                            $this->product->huyProduct($value, $color[$key], $size[$key], $quantity[$key]);
                        }
                    }
                }
                flash('success', "Hủy đơn hàng thành công", 'detail-order/' . $invoice_id);
            } else {
                flash('errors', 'Hủy đơn hàng thất bại', 'detail-order/' . $invoice_id);
            }
        }
    }









    }

