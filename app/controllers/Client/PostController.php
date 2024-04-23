<?php
namespace App\controllers\Client;
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
        $bGhi = 8;
        $viTri = ($pageNumber - 1)*$bGhi ;
        $tong = count($list);
        $soTrang = ceil($tong/$bGhi);
        $listAll = $this->post->listPostPages($viTri,$bGhi);
        return $this->renderClient("posts.list",compact('listAll','soTrang'));
    }


       function detail($id)
       {
           $listOne = $this->post->listOnePost($id);
           if(!$listOne ){
               return $this->renderClient("home.404");
           }
           return $this->renderClient("posts.detail",compact('listOne'));
       }

}