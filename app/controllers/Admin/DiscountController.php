<?php
namespace App\Controllers\Admin;
use App\Models\discount;
class DiscountController extends BaseController{
    protected $discount;
    public function __construct()
    {
        $this->discount = new discount();
    }

    public function list($pageNumber)
    {
        $bghi = 5;
        $vitri = ($pageNumber - 1) * $bghi;
        $list = $this->discount->listAllDiscount($vitri, $bghi);
        $listAll = $this->discount->listAllDiscount1();
        $tong = count($listAll);
        $sotrang = ceil($tong/$bghi);
        return $this->renderAdmin("discount.list", compact('list', 'sotrang'));
    }
    public function formAdd()
    {
        return $this->renderAdmin("discount.add");
    }
    public function post()
    {
        if(isset($_POST['add'])){
            $errors = [];
            $code = uniqid();
            if(empty($_POST['percent'])){
                $errors[] ="Không được để trống mã giảm giá";
            }else{
                $percent = $_POST['percent'];
            }
            if(empty($_POST['expiration'])){
                $errors[] ="Không được để trống ngày hết hạn";
            }else{
                $expiration = $_POST['expiration'];
            }
            if(empty($_POST['start_day'])){
                $errors[] ="Không được để trống ngày bắt đầu";
            }else{
                $start_day = $_POST['start_day'];
            }
            if(empty($_POST['quantity'])){
                $errors[] ="Không được để trống số lượng";
            }else{
                $quantity = $_POST['quantity'];
            }
            if($_POST['start_day'] > $_POST['expiration']){
                $errors[] ="Không được để ngày bắt đầu lớn hơn ngày kết thúc";
            }

            if(count($errors) >= 1){
                flash('errors', $errors, 'admin/discount/form-add');
            }else{
                $this->discount->insert(NULL,$code,$percent,$start_day,$expiration,$quantity,1);
                flash('success', 'Thêm mã thành công', 'admin/discount/form-add');

            }


        }
    }
}