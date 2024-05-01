<?php
namespace App\Controllers\Admin;
use App\Models\Comment;

class CommentController extends BaseController
{
    private $comment;

    public function __construct()
    {
        $this->comment = new Comment();
    }
    public function list($pageNumber){
        $bghi = 5;
        $vitri = ($pageNumber - 1) * $bghi;
        $list = $this->comment->listAllPages($vitri,$bghi);
        $listAll = $this->comment->listAll();
        $tong = count($listAll);
        $sotrang = ceil($tong/$bghi);
        return $this->renderAdmin("comment.list",compact('list','sotrang'));
    }


    public function listFeedback($id){
        $list = $this->comment->detailFeedback($id);
        $one = $this->comment->listOne($id);
        return $this->renderAdmin("comment.feedback",compact('list','one'));
    }

    public function insertFeedback()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Hà Nội
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $id_user_admin = $_POST['id_user_admin'];
            $text = $_POST['text'];
            $date = date('Y-m-d H:i:s');
            $check = $this->comment->insertFeedback(NULL,$id,$id_user_admin,$text,$date);
            if ($check) {
                flash('success', 'Xóa danh mục thành công', 'admin/comment/feedback/'.$id);
            } else {
                flash('errors', "loi", 'admin/comment/feedback/'.$id);
            }
        }
    }
}