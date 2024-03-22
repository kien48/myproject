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

}