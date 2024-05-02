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

    public function list($pageNumber)
    {
        $bghi = 5;
        $vitri = ($pageNumber - 1) * $bghi;
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id !== null) {
            $products = $this->product->listProductPages($vitri, $bghi, $id);
        } else {
            $products = $this->product->listProductPages($vitri, $bghi);
        }

        $listAll = $this->product->listProduct();
        $tong = count($listAll);
        $sotrang = ceil($tong / $bghi);
        $listCategory = $this->category->listCategory();

        return $this->renderAdmin("product.list", compact('products', 'sotrang', 'listCategory'));
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

            if (empty($_POST['import_price'])) {
                $errors[] = 'Bạn phải nhập giá nhập';
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
                                $check = $this->product->addProduct(NULL, $_POST['name'], $_POST['price'],$_POST['import_price'], $image_url, $image_url2, $_POST['description'], $_POST['id_ct'],0);
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
            flash('success', "Xóa thành công", 'admin/list-product/1');
        }
    }


    public function listVariant($id)
    {
        $list = $this->product->listBienTheSP($id);
        return $this->renderAdmin("product.variant",compact('list','id'));
    }

    public function formAddVR($id)
    {
        $id = $id;
        return $this->renderAdmin("product.addVariant",compact('id'));
    }
    public function formUpdateVR($id)
    {
        $oneVariant = $this->product->bienTheforID($id);
        return $this->renderAdmin("product.updateVariant",compact('oneVariant'));
    }


    public function addVR()
    {
        if(isset($_POST['add'])){
            $errors = [];
            $idpro = $_POST['pro_id'];
            $color = $_POST['color'];
            $size = $_POST['size'];
            $quantity = $_POST['quantity'];
            if(empty($color)){
                $errors[] = "Vui lòng điền màu";
            }
            if(empty($size)){
                $errors[] = "Vui lòng điền kích thước";
            }
            if(empty($quantity)){
                $errors[] = "Vui lòng điền số lượng";
            }
            $list = $this->product->listBienTheSP($idpro);
            foreach ($list as $item) {
                if($item->color == $color && $item->size == $size){
                    $errors[] = "Đã có biến thể này";
                }
            }
            if(count($errors) <= 0){
                $check = $this->product->insertBienThe(NULL, $idpro, $color, $size, $quantity);
                $this->product->updateStatusPro($idpro);
                if($check){
                    flash('success', "Thêm thành công", 'admin/variant-add/'.$idpro);
                }
            }else{
                flash('errors', $errors, 'admin/variant-add/'.$idpro);
            }
        }
    }

    public function formUpdate($id)
    {
        $listCategory = $this->category->listCategory();
        $product = $this->product->detailProduct($id);
        return $this->renderAdmin('product.update', compact('product','listCategory'));
    }


    public function updateVR()
    {
        if(isset($_POST['add'])){
            $errors = [];
            $id = $_POST['id'];
            $idpro = $_POST['pro_id'];
            $color = $_POST['color'];
            $size = $_POST['size'];
            $quantity = $_POST['quantity'];
            if(empty($color)){
                $errors[] = "Vui lòng điền màu";
            }
            if(empty($size)){
                $errors[] = "Vui lòng điền kích thước";
            }
            if(empty($quantity)){
                $errors[] = "Vui lòng điền số lượng";
            }
            $list = $this->product->listBienTheSP1($idpro,$id);
            foreach ($list as $item) {
                if($item->color == $color && $item->size == $size){
                    $errors[] = "Đã có biến thể này";
                }
            }
            if(count($errors) <= 0){
                $check = $this->product->updateBienThe($id, $idpro, $color, $size, $quantity);
                if($check){
                    flash('success', "Cập nhật thành công", 'admin/variant-update/'.$id);
                }
            }else{
                flash('errors', $errors, 'admin/variant-update/'.$id);
            }
        }
    }

    public function updateProduct(){
        if (isset($_POST['update'])) {
            $errors = [];
            $id = $_POST['id'];
            $product = $this->product->detailProduct($id);
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

            // Kiểm tra nếu không có lỗi và không có ảnh mới được tải lên
            if (count($errors) == 0 && empty($product->image) && empty($product->image2)) {
                $check = $this->product->updateProduct($id, $_POST['name'], $_POST['price'], $_POST['import_price'], $product->image, $product->image2, $_POST['description'], $_POST['id_ct'], $_POST['status']);

                if ($check) {
                    flash('success', 'Cập nhật sản phẩm thành công', 'admin/product/form-update/'.$id);
                } else {
                    flash('errors', 'Có lỗi xảy ra khi cập nhật sản phẩm', 'admin/product/form-update/'.$id);
                }
            } else {
                // Kiểm tra và xử lý ảnh 1
                if (!empty($_FILES['image']['name'])) {
                    $image = $_FILES['image'];
                    $targetDir = "public/img/";
                    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                        // Nếu tải lên ảnh thành công, lưu URL ảnh vào biến $image_url
                        $image_url = $targetFile;
                    } else {
                        // Nếu có lỗi khi tải lên ảnh, thêm thông báo lỗi vào mảng $errors
                        $errors[] = 'Có lỗi xảy ra khi tải lên ảnh';
                    }
                } else {
                    $image_url = $product->image;
                }

                // Kiểm tra và xử lý ảnh 2
                if (!empty($_FILES['image2']['name'])) {
                    $image2 = $_FILES['image2'];
                    $targetDir2 = "public/img/";
                    $targetFile2 = $targetDir2 . basename($_FILES["image2"]["name"]);
                    if (move_uploaded_file($_FILES["image2"]["tmp_name"], $targetFile2)) {
                        // Nếu tải lên ảnh thành công, lưu URL ảnh vào biến $image_url2
                        $image_url2 = $targetFile2;
                    } else {
                        // Nếu có lỗi khi tải lên ảnh, thêm thông báo lỗi vào mảng $errors
                        $errors[] = 'Có lỗi xảy ra khi tải lên ảnh 2';
                    }
                } else {
                    $image_url2 = $product->image2;
                }

                // Kiểm tra nếu có lỗi
                if (count($errors) >= 1) {
                    // Nếu có lỗi, chuyển hướng lại với thông báo lỗi
                    flash('errors', $errors, 'admin/product/form-update/'.$id);
                } else {
                    // Nếu không có lỗi, tiếp tục xử lý dữ liệu
                    $check = $this->product->updateProduct($id, $_POST['name'], $_POST['price'], $_POST['import_price'], $image_url, $image_url2, $_POST['description'], $_POST['id_ct'], $_POST['status']);
                    if ($check) {
                        flash('success', 'Cập nhật sản phẩm thành công', 'admin/product/form-update/'.$id);
                    } else {
                        flash('errors', 'Có lỗi xảy ra khi cập nhật sản phẩm', 'admin/product/form-update/'.$id);
                    }
                }
            }
        }
    }


    public function thongKe()
    {
        $thongKe = $this->product->thongKe();
        $gia = $this->product->ThongKeGia();
        $sao = $this->product->ThongKeSao();
        return $this->renderAdmin('product.thongKe', compact('thongKe','gia','sao'));
    }

    public function deleteVariant()
    {
        if(isset($_POST['delete'])){
            $id = $_POST['id'];
            $idpro = $_POST['id_pro'];
            $check = $this->product->deleteBienThe($id);
            if ($check) {
                flash('success', 'Xóa thành công','admin/variant/'.$idpro);
            } else {
                flash('errors', 'Có lỗi xảy ra khi xóa sản phẩm','admin/variant/'.$idpro);
            }
        }
    }




}
