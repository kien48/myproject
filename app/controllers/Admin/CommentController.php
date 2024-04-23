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
    public function list(){
        $list = $this->comment->listAll();
        return $this->renderAdmin("comment.list",compact('list'));
    }

    public function formAdd(){
        return $this->renderAdmin("category.add");
    }
}