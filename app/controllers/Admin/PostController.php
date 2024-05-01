<?php
namespace App\Controllers\Admin;
use App\Models\Post;

class PostController extends BaseController{
    protected $post;
    public function __construct()
    {
        $this->post = new Post();

    }

    public function list($pageNumber)
    {
        $list = $this->post->listPost();
        $bGhi = 4;
        $viTri = ($pageNumber - 1)*$bGhi ;
        $tong = count($list);
        $soTrang = ceil($tong/$bGhi);
        $listAll = $this->post->listPostPages($viTri,$bGhi);
        return $this->renderAdmin("posts.list",compact('listAll','soTrang'));
    }

    public function formAdd()
    {
        return $this->renderAdmin("posts.add");
    }
    public function add()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Hà Nội
       if(isset($_POST['submit'])){
           $errors = [];
           if (empty($_POST['title'])) {
               $errors[] = 'Bạn phải nhập tiêu đề';
           }
           if (empty($_POST['text'])) {
               $errors[] = 'Bạn phải nhập nội dung';
           }
           if (empty($_FILES['image'])) {
               $errors[] = 'Bạn phải nhập ảnh';
           }
           $date = date('Y-m-d H:i:s');
           $author = $_POST['author'];
           if (!empty($_FILES['image'])) {
               $image = $_FILES['image'];
               $targetDir = "public/img/";
               $targetFile = $targetDir . basename($_FILES["image"]["name"]);
               if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                   // Nếu tải lên ảnh thành công, lưu URL ảnh vào biến $image_url
                   $image_url = $_FILES["image"]["name"]; // Lưu đường dẫn của ảnh vào biến $image_url
                   if (count($errors) >= 1) {
                       // Nếu có lỗi, chuyển hướng lại với thông báo lỗi
                       flash('errors', $errors, 'admin/post/form-add');
                   }else{
                       $check = $this->post->insertPost(null,$_POST['title'],$image_url,$_POST['text'],$author,$date);
                       if ($check) {
                           flash('success', 'Thêm bài viết thành công', 'admin/post/form-add');
                       }
                   }
               }
           }



           }

       }

       function detail($id)
       {
           $listOne = $this->post->listOnePost($id);
           return $this->renderAdmin("posts.detail",compact('listOne'));
       }


    function formUpdate($id)
    {
        $listOne = $this->post->listOnePost($id);
        return $this->renderAdmin("posts.update",compact('listOne'));
    }


    public function update()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Hà Nội
        if(isset($_POST['submit'])){
            $errors = [];
            if (empty($_POST['title'])) {
                $errors[] = 'Bạn phải nhập tiêu đề';
            }
            if (empty($_POST['text'])) {
                $errors[] = 'Bạn phải nhập nội dung';
            }
            $date = date('Y-m-d H:i:s');
            $author = $_POST['author'];
            $id = $_POST['id'];
            $onePost = $this->post->listOnePost($id);

            // Kiểm tra nếu không có lỗi và có tập tin ảnh được tải lên
            if (empty($errors) && !empty($_FILES['image']['name'])) {
                $image = $_FILES['image'];
                $targetDir = "public/img/";
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    $image_url = $_FILES["image"]["name"];
                } else {
                    $errors[] = 'Không thể tải lên ảnh';
                }
            } else {
                // Sử dụng ảnh hiện tại của bài viết nếu không có ảnh mới được tải lên
                $image_url = $onePost->image;
            }

            // Nếu không có lỗi, cập nhật bài viết
            if (empty($errors)) {
                $check = $this->post->updatePost($id, $_POST['title'], $image_url, $_POST['text'], $author, $date);
                if ($check) {
                    flash('success', 'Cập nhật bài viết thành công', 'admin/post/form-update/'.$id);
                } else {
                    $errors[] = 'Không thể cập nhật bài viết';
                }
            }

            // Hiển thị thông báo lỗi nếu có
            if (!empty($errors)) {
                flash('errors', $errors, 'admin/post/form-update/'.$id);
            }
        }
    }

    public function delete($id)
    {
        $check = $this->post->deletePost($id);
        if ($check) {
            flash('success', 'Xóa bài thành công', 'admin/post/list/1');
        }else{
            flash('errors', "Xóa lỗi", 'admin/post/list/1/');
        }
    }





}