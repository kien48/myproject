<?php

namespace App\controllers\Client;

use App\Models\Category;
use App\Models\Post;
use App\Models\Settings;

class PostController extends BaseController
{
    protected $post;
    protected $category;
    protected $setting;
    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
        $this->setting = new Settings();

        // Lấy và lưu cài đặt trong phiên khi khởi tạo controller
        $listSettings = $this->setting->listSettings();
        $_SESSION['listSettings'] = $listSettings;

        $listCT = $this->category->listCategory();
        $_SESSION['category'] = $listCT;
    }

    public function list($pageNumber)
    {
        $list = $this->post->listPost();
        $bGhi = 8;
        $viTri = ($pageNumber - 1) * $bGhi;
        $tong = count($list);
        $soTrang = ceil($tong / $bGhi);
        $listAll = $this->post->listPostPages($viTri, $bGhi);
        return $this->renderClient("posts.list", compact('listAll', 'soTrang'));
    }


    function detail($id)
    {
        $listOne = $this->post->listOnePost($id);
        if (!$listOne) {
            return $this->renderClient("home.404");
        }
        return $this->renderClient("posts.detail", compact('listOne'));
    }
}
