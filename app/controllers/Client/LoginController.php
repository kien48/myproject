<?php
namespace App\Controllers\Client;
use App\Models\User;
class LoginController extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function formLogin()
    {
        return $this->renderClient("login.login");
    }
    public function login()
    {
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            // Kiểm tra đăng nhập
            $check = $this->user->checkLogin($email, $pass);

            if($check) {
                // Lưu thông tin người dùng vào session
                $_SESSION['user'] = $check;
                flash('success', 'Đăng nhập thành công', 'form-login');
            } else {
                flash('errors', 'Đăng nhập thất bại do sai email hoặc mật khẩu', 'form-login');
            }
        }

    }

    public function logout()
    {
        // Thực hiện đăng xuất bằng cách xóa thông tin người dùng khỏi session
        unset($_SESSION['user']);

        // Chuyển hướng người dùng về trang đăng nhập sau khi đăng xuất
        header('Location: ' . BASE_URL . 'form-login');
        exit; // Đảm bảo không có mã PHP nào được thực thi sau header
    }

    public function formRegister()
    {
        return $this->renderClient("login.register");
    }
    public function register()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Hà Nội

        if(isset($_POST['submit'])){
            $error = [];

            // Kiểm tra và lấy dữ liệu từ các trường nhập liệu
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $address = isset($_POST['address']) ? $_POST['address'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';

            // Kiểm tra và xử lý số điện thoại
            if(strlen($phone) != 10) {
                $error[] = "Vui lòng điền số điện thoại gồm 10 số";
            }

            // Kiểm tra và xử lý địa chỉ email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Vui lòng điền đúng định dạng email";
            }

            // Kiểm tra xem có lỗi không trước khi thêm vào cơ sở dữ liệu
            if(empty($error)){
                $date = date('Y-m-d H:i:s');
                $check = $this->user->insertUser(NULL,$name,$email,$pass,$phone,$address,1,$date);
                if($check){
                    flash('success', 'Đăng ký thành công', 'form-register');
                } else {
                    flash('errors', 'Đã xảy ra lỗi khi thực hiện đăng ký', 'form-register');
                }
            } else {
                flash('errors', $error, 'form-register');
            }
        }
    }


}