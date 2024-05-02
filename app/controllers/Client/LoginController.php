<?php

namespace App\Controllers\Client;

use App\Models\Category;
use App\Models\Settings;
use App\Models\User;

class LoginController extends BaseController
{
    protected $user;
    protected $category;
    protected $setting;
    public function __construct()
    {
        $this->user = new User();
        $this->category = new Category();
        $this->setting = new Settings();

        // Lấy và lưu cài đặt trong phiên khi khởi tạo controller
        $listSettings = $this->setting->listSettings();
        $_SESSION['listSettings'] = $listSettings;

        $listCT = $this->category->listCategory();
        $_SESSION['category'] = $listCT;

        if (isset($_SESSION['user'])) {
            $oneUser = $this->user->listOneUser($_SESSION['user']->id);
            $_SESSION['user'] = $oneUser;
        }
    }


    public function formLogin()
    {
        if (isset($_SESSION['user'])) {
            $demUser = $this->user->demUser($_SESSION['user']->id);
        }
        $demUser = "";
        return $this->renderClient("login.login", compact('demUser'));
    }
    public function login()
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            // Kiểm tra đăng nhập
            $check = $this->user->checkLogin($email, $pass);

            if ($check) {
                // Lưu thông tin người dùng vào session
                $_SESSION['user'] = $check;

                flash('success', 'Đăng nhập thành công', 'form-login');
            } else {
                flash('errors', 'Đăng nhập thất bại do sai email hoặc mật khẩu hoặc đã bị khóa', 'form-login');
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

        if (isset($_POST['submit'])) {
            $error = [];

            // Kiểm tra và lấy dữ liệu từ các trường nhập liệu
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $address = isset($_POST['address']) ? $_POST['address'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';

            // Kiểm tra và xử lý số điện thoại
            if (strlen($phone) != 10) {
                $error[] = "Vui lòng điền số điện thoại gồm 10 số";
            }

            // Kiểm tra và xử lý địa chỉ email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Vui lòng điền đúng định dạng email";
            }

            if (strlen($pass) <= 6) {
                $error[] = "Vui lòng điền mật khẩu trên 6 ký tự";
            }
            if (strlen($name) <= 4) {
                $error[] = "Vui lòng điền tên trên 4 ký tự";
            }
            $allUser = $this->user->listAllUser();
            foreach ($allUser as $user) {
                if ($user->username === $name) {
                    $error[] = "Tên đã được sử dụng";
                }
                if ($user->email === $email) {
                    $error[] = "Email đã được sử dụng";
                }
            }

            // Kiểm tra xem có lỗi không trước khi thêm vào cơ sở dữ liệu
            if (empty($error)) {
                $date = date('Y-m-d H:i:s');
                $check = $this->user->insertUser(NULL, $name, $email, $pass, $phone, $address, 1, $date, 0, 0);
                if ($check) {
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
        if (isset($_POST['submit'])) {
            $id_user = $_POST['id_user'];
            $check =  $this->user->insertInbox(NULL, 4, $id_user);
            if ($check) {
                flash('success', 'Đăng ký thành công', 'inbox');
            }
        }
    }

    public function send()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Hà Nội
        if (isset($_POST['submit'])) {
            $date = date('Y-m-d H:i:s');
            $check = $this->user->send(NULL, $_POST['conversation_id'], $_POST['id_user'], $_POST['text'], $date, 1);
            if ($check) {
                flash('success', 'Đăng ký thành công', 'inbox');
            }
        }
    }

    public function formUpdate()
    {
        return $this->renderClient("login.update");
    }


    public function update()
    {
        if (isset($_POST['submit'])) {
            $errors = [];
            $id = $_POST['id'];
            $name = $_POST['username'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            if (strlen($phone) != 10) {
                $error[] = "Vui lòng điền số điện thoại gồm 10 số";
            }

            // Kiểm tra và xử lý địa chỉ email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Vui lòng điền đúng định dạng email";
            }

            if (strlen($name) <= 4) {
                $error[] = "Vui lòng điền tên trên 4 ký tự";
            }
            $allUser = $this->user->listAllUser1($id);
            foreach ($allUser as $user) {
                if ($user->username === $name) {
                    $errors[] = "Tên đã được sử dụng";
                }
                if ($user->email === $email) {
                    $errors[] = "Email đã được sử dụng";
                }
            }

            if (empty($errors)) {
                $check = $this->user->updateUser($id, $name, $email, $phone, $address);
                if ($check) {
                    flash('success', 'Cập nhật thành công', 'form-update');
                } else {
                    $errors[] = 'Cập nhật thất bại';
                    flash('errors', $errors, 'form-update');
                }
            } else {
                flash('errors', $errors, 'form-update');
            }
        }
    }


    public function formPass()
    {
        return $this->renderClient("login.updatePass");
    }

    public function updatePass()
    {
        if (isset($_POST['submit'])) {
            $errors = [];
            $pass = $_POST['pass'];
            $id = $_POST['id'];
            $passNew = $_POST['pass_new'];
            $passNew1 = $_POST['pass_new_1'];
            if ($pass != $_SESSION['user']->password) {
                $errors[] = "Mật khầu bạn điền không đúng";
            }
            if ($passNew != $passNew1) {
                $errors[] = "Mật khầu mới bạn điền và nhập lại không trùng nhau";
            }
            if (empty($passNew)) {
                $errors[] = "Mật khầu mới bạn không được để trống";
            }
            if (empty($pass)) {
                $errors[] = "Mật khầu bạn không được để trống";
            }
            if (strlen($passNew) <= 6) {
                $errors[] = "Mật khầu mới bạn phải lớn hơn 6 ký tự";
            }
            if ($passNew == $passNew1) {
                if (empty($errors)) {
                    $check = $this->user->updatePassUser($id, $pass);
                    if ($check) {
                        flash('success', 'Cập nhật thành công', 'form-update/pass');
                    } else {
                        $errors[] = 'Cập nhật thất bại';
                        flash('errors', $errors, 'form-update/pass');
                    }
                } else {
                    flash('errors', $errors, 'form-update/pass');
                }
            } else {
                flash('errors', $errors, 'form-update/pass');
            }
        }
    }
}
