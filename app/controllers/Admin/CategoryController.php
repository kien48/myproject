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

    public function postCategory()
    {
        if (isset($_POST['submit'])) {
            $errors = [];
            $name = $_POST['name'];
            if(empty($name)) {
                $errors[] = "Vui lòng điền tên danh mục";
            }
            if (count($errors) > 0) {
                flash('errors', $errors, 'admin/category/add');
            } else {
                $check = $this->category->insertCategory(null, $name);
                if ($check) {
                    flash('success', 'Thêm danh mục thành công', 'admin/category/add');
                }
            }
        }
    }

    public function formUpdate($id){
        $oneCategory = $this->category->oneCategory($id);
        return $this->renderAdmin("category.update",compact('oneCategory'));
    }

    public function updateCategory()
    {
        if (isset($_POST['submit'])) {
            $errors = [];
            $id = $_POST['id'];
            $name = $_POST['name'];
            if(empty($name)) {
                $errors[] = "Vui lòng điền tên danh mục";
            }
            if (count($errors) > 0) {
                flash('errors', $errors, 'admin/category/update/'.$id);
            } else {
                $check = $this->category->updateCategory($id, $name);
                if ($check) {
                    flash('success', 'Cập nhật danh mục thành công', 'admin/category/update/'.$id);
                }
            }
        }
    }

    public function deleteCategory($id)
    {
        $checkKhoaNgoai = $this->category->checkKhoaNgoai();
        $errors = [];
        $canDelete = true;

        foreach ($checkKhoaNgoai as $value) {
            if ($value->id == $id) {
                $errors[] = 'Xóa thất bại do ràng buộc với sản phẩm';
                $canDelete = false;
                break; // No need to continue if we find any foreign key constraint
            }
        }

        if ($canDelete) {
            $check = $this->category->deleteCategory($id);
            if ($check) {
                flash('success', 'Xóa danh mục thành công', 'admin/category');
            } else {
                $errors[] = 'Xóa thất bại';
                flash('errors', $errors, 'admin/category');
            }
        } else {
            flash('errors', $errors, 'admin/category');
        }
    }

}