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

            if(strlen($pass) <= 6) {
                $error[] = "Vui lòng điền mật khẩu trên 6 ký tự";
            }
            if(strlen($name) <= 4) {
                $error[] = "Vui lòng điền tên trên 4 ký tự";
            }

            // Kiểm tra xem có lỗi không trước khi thêm vào cơ sở dữ liệu
            if(empty($error)){
                $date = date('Y-m-d H:i:s');
                $check = $this->user->insertUser(NULL,$name,$email,$pass,$phone,$address,1,$date,0);
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

    public function inbox()
    {
        $checkBox = $this->user->checkBox($_SESSION['user']->id);
        $list = $this->user->listMessage(4, $_SESSION['user']->id);

        if (!empty($checkBox)) {
            $idCheckBox = $checkBox[0]->id;
            foreach ($list as $message) {
                if ($message->conversation_id === $idCheckBox && $message->sender_id === 4) {
                    $message_id = $message->conversation_id;
                    $this->user->updateStatus($message_id, 4);
               unset($_SESSION['tinNhanAdmin']);
                }
            }
        }
        $list = $this->user->listMessage(4, $_SESSION['user']->id);
        return $this->renderClient("login.inbox", compact('list', 'checkBox'));

    }


    public function addBox()
    {
        if(isset($_POST['submit'])){
            $id_user = $_POST['id_user'];
          $check =  $this->user->insertInbox(NULL,4,$id_user);
          if($check){
              flash('success', 'Đăng ký thành công', 'inbox');
          }
        }

    }

    public function send()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Hà Nội
        if(isset($_POST['submit'])){
            $date = date('Y-m-d H:i:s');
           $check = $this->user->send(NULL,$_POST['conversation_id'],$_POST['id_user'],$_POST['text'],$date,1);
            if($check){
                flash('success', 'Đăng ký thành công', 'inbox');
            }
        }
    }

}