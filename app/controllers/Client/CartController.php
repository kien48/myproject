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
            $keyID = uniqid();

            // Kiểm tra xem size và color đã được chọn chưa
            if(isset($_POST['size_radio']) && isset($_POST['color_radio'])) {
                $size_radio = $_POST['size_radio'];
                $color_radio = $_POST['color_radio'];
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
                    $_SESSION['giohang'][] = ["keyID"=> $keyID ,"id" => $id, "name" => $name, "price" => $price, "image" => $image, "category" => $category, "quantity" => $quantity, "size" => $size_radio, "color" => $color_radio];
                }
            } else {
                // Nếu size hoặc color chưa được chọn, hiển thị thông báo
                echo '<script>alert("Vui lòng chọn kích thước và màu sắc!");</script>';
                // Sau khi hiển thị thông báo, dừng việc thêm vào giỏ hàng
                echo '<script>window.history.back();</script>';
                return;
            }

            // Chuyển hướng về trang trước
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
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
                    $this->cart->orderDetail(NULL, $id_order,$item['id'], $item['name'], $item['quantity'], $item['price'], $item['price'] * $item['quantity'],$item['size'][0],$item['color'][0]);
                    $this->cart->updateQuantity($item['quantity'],$item['id'],$item['color'][0],$item['size'][0]);
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

        // Kiểm tra xem có dữ liệu số lượng mới và key được gửi lên không
        if(isset($_POST['quantitynew']) && isset($_POST['key'])) {
            // Lặp qua mỗi sản phẩm được gửi lên từ form
            foreach($_POST['key'] as $index => $keyID) {
                $found = false; // Biến để kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không

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

                // Kiểm tra nếu không tìm thấy sản phẩm trong giỏ hàng
                if(!$found) {
                    // Sản phẩm không tồn tại trong giỏ hàng
                    // Xử lý thông báo lỗi hoặc thực hiện các hành động khác tùy theo yêu cầu
                    // Ví dụ:
                    // header('Location: ' . BASE_URL . 'error-page');
                    // hoặc
                    // echo "Sản phẩm không tồn tại trong giỏ hàng.";
                    $status = 0; // Cập nhật biến status thành 0 khi có lỗi xảy ra
                }
            }

            // Sau khi cập nhật xong, chuyển hướng người dùng đến trang giỏ hàng hoặc trang khác
            header('Location: ' . BASE_URL . 'list-cart');
            exit; // Chắc chắn kết thúc chương trình sau khi chuyển hướng
        } else {
            // Nếu không có dữ liệu gửi lên hoặc thiếu dữ liệu, cập nhật biến status và chuyển hướng đến trang lỗi
            $status = 0;
            header('Location: ' . BASE_URL . 'error-page');
            exit; // Chắc chắn kết thúc chương trình sau khi chuyển hướng
        }
    }








}

