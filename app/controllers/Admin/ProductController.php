<?php
namespace App\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
class ProductController extends BaseController
{
    protected $product;
    protected $category;

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function list()
    {
        $products = $this->product->listProduct();
        return $this->renderAdmin("product.list", compact('products'));
    }

    public function formAdd()
    {
        $categories = $this->category->listCategory();
        return $this->renderAdmin("product.add", compact('categories'));
    }

    public function addProduct()
    {

        if (isset($_POST['add'])) {
            $errors = [];

            // Kiểm tra và xử lý trường name
            if (empty($_POST['name'])) {
                $errors[] = 'Bạn phải nhập tên';
            }

            // Kiểm tra và xử lý trường price
            if (empty($_POST['price'])) {
                $errors[] = 'Bạn phải nhập giá';
            }

            // Kiểm tra và xử lý trường description
            if (empty($_POST['description'])) {
                $errors[] = 'Bạn phải nhập mô tả';
            }

            // Kiểm tra và xử lý trường id_ct
            if (empty($_POST['id_ct'])) {
                $errors[] = 'Bạn phải nhập danh mục';
            }

            // Kiểm tra và xử lý ảnh 1
            if (!empty($_FILES['image'])) {
                $image = $_FILES['image'];
                $targetDir = "public/img/";
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    // Nếu tải lên ảnh thành công, lưu URL ảnh vào biến $image_url
                    $image_url = $targetFile;

                    // Kiểm tra và xử lý ảnh 2
                    if (!empty($_FILES['image2'])) {
                        $image2 = $_FILES['image2'];
                        $targetDir2 = "public/img/"; // Thay đổi tên biến targetDir2
                        $targetFile2 = $targetDir2 . basename($_FILES["image2"]["name"]); // Thay đổi tên biến targetFile2
                        if (move_uploaded_file($_FILES["image2"]["tmp_name"], $targetFile2)) { // Thay đổi tên biến targetFile2
                            // Nếu tải lên ảnh thành công, lưu URL ảnh vào biến $image_url2
                            $image_url2 = $targetFile2; // Thay đổi tên biến image_url2
                            // Kiểm tra nếu có lỗi
                            if (count($errors) >= 1) {
                                // Nếu có lỗi, chuyển hướng lại với thông báo lỗi
                                flash('errors', $errors, 'admin/form-add');
                            } else {
                                // Nếu không có lỗi, tiếp tục xử lý dữ liệu
                                $check = $this->product->addProduct(NULL, $_POST['name'], $_POST['price'], $image_url, $image_url2, $_POST['description'], $_POST['id_ct']);
                                if ($check) {
                                    flash('success', 'Thêm sản phẩm thành công', 'admin/form-add');
                                } else {
                                    flash('errors', 'Có lỗi xảy ra khi thêm sản phẩm', 'admin/form-add');
                                }
                            }
                        } else {
                            // Nếu có lỗi khi tải lên ảnh, thêm thông báo lỗi vào mảng $errors
                            $errors[] = 'Có lỗi xảy ra khi tải lên ảnh 2';
                            flash('errors', $errors, 'admin/form-add');
                        }
                    }
                } else {
                    // Nếu có lỗi khi tải lên ảnh, thêm thông báo lỗi vào mảng $errors
                    $errors[] = 'Có lỗi xảy ra khi tải lên ảnh';
                    flash('errors', $errors, 'admin/form-add');
                }
            }
        }


    }


    public function deleteProduct($id){
        $check = $this->product->deleteProduct($id);
        if($check){
            flash('success', "Xóa thành công", 'admin/list-product');
        }
    }
}