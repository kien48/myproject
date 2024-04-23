<?php
namespace App\Controllers\Admin;
use App\Models\Category;

class CategoryController extends BaseController
{
    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }
    public function list(){
        $list = $this->category->listCategory();
        return $this->renderAdmin("category.list",compact('list'));
    }

    public function formAdd(){
        return $this->renderAdmin("category.add");
    }
}