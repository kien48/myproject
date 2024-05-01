<?php
namespace App\Controllers\Admin;
use App\Models\User;

class AuthenController extends BaseController{

    public $user;
    public function __construct()
    {
        $this->user = new User();
        $dem = $this->user->dem();
        $_SESSION['$dem'] = $dem;
    }

    public function login()
    {
        return $this->renderAdmin("authen.login");
    }
    public function checkLogin()
    {
        if(isset($_POST['check'])){
            $errors = [];
            if(empty($_POST['user'])){
                $errors[] = "vui lòng nhập tài khoản";
            }else{
                $user = $_POST['user'];
            }
            if(empty($_POST['pass'])){
                $errors[] = "vui lòng nhập mật khẩu";
            }else{
                $pass = $_POST['pass'];
            }

            if(count($errors) >= 1){
                flash('errors', $errors, 'admin/login');
            }else{
                $check = $this->user->checkLoginAdmin($user,$pass);

                if($check){
                    $_SESSION['admin'] = $check;
                    header('Location: ' . BASE_URL . 'admin/');
                }else{
                    $errors[] = "Bạn nhập sai tài khoản hoặc mật khẩu";
                    flash('errors', $errors, 'admin/login');
                }
            }

        }
    }
    public function logout()
    {
        // Thực hiện đăng xuất bằng cách xóa thông tin người dùng khỏi session
        unset($_SESSION['admin']);

        // Chuyển hướng người dùng về trang đăng nhập sau khi đăng xuất
        header('Location: ' . BASE_URL . 'admin/login');
        exit; // Đảm bảo không có mã PHP nào được thực thi sau header
    }

    public function listInbox()
    {
        $listConversation = $this->user->conversations();
        $listUser = $this->user->listAllUser();

        return $this->renderAdmin("authen.inbox",compact('listConversation','listUser'));
//        header("Location: {$_SERVER['HTTP_REFERER']}");
//        exit();
    }

    public function chat($id)
    {


        $list = $this->user->listMessage($_SESSION['admin']->id,$id);
        $checkBox0 = $this->user->checkBox($id);
        $conversation_id = $checkBox0[0]->id;
        $checkBox = $this->user->checkBoxAdmin($_SESSION['admin']->id,$conversation_id);
        if (!empty($checkBox)){
            $idCheckBox = $checkBox[0]->id;
            foreach ($list as $message) {
                if ($message->conversation_id === $idCheckBox) {
                    $message_id = $message->conversation_id;
                    $this->user->updateStatus($message_id, $id);
                    unset($_SESSION['tinNhanAdmin']);
                }
            }
        }
//        $chuaDoc = $this->user->tinChuaDoc($id,$message_id);
//        $_SESSION['tinNhanAdmin'] = $chuaDoc;
//        var_dump($_SESSION['tinNhanAdmin']);
        $list = $this->user->listMessage($_SESSION['admin']->id,$id);
        return $this->renderAdmin("authen.chat",compact('list','checkBox'));
        exit();

    }
    public function send()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Hà Nội
        if(isset($_POST['submit'])){
            $date = date('Y-m-d H:i:s');
            $check = $this->user->send(NULL,$_POST['conversation_id'],$_POST['id_user'],$_POST['text'],$date,1);
            if($check){
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit();
            }
        }
    }

    public function list($pageNumber){
        $bghi = 5;
        $vitri = ($pageNumber - 1) * $bghi;
        $list = $this->user->listAllUserPages($vitri,$bghi);
        $listAll = $this->user->listAllUser();
        $tong = count($listAll);
        $sotrang = ceil($tong/$bghi);
        return $this->renderAdmin("authen.list",compact('list','sotrang'));
    }

    public function lockTK($id)
    {
        $check = $this->user->khoaTK($id);
        if ($check) {

            flash('success', 'Khóa thành công', 'admin/users/1');
        } else {
            flash('errors', 'Khóa thất bại', 'admin/users/1');
        }

     }

    public function moTK($id)
    {
        $check = $this->user->moTK($id);
        if ($check) {
            flash('success', 'Mở khóa thành công', 'admin/users/1');
        } else {
            flash('errors', 'Mở thất bại', 'admin/users/1');
        }
    }
}
