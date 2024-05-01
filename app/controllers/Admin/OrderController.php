<?php
namespace App\Controllers\Admin;
use App\Models\Cart;
use App\Models\User;

class OrderController extends BaseController
{
    private $cart;
    private $user;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->cart->updatePaymentStatus();
        $this->user = new User();
        $this->user->updateRank();
    }
    public function list($pageNumber){
        $bghi = 2;
        $vitri = ($pageNumber - 1) * $bghi;
        $list = $this->cart->listAllOrderPages($vitri,$bghi);
        $listAll = $this->cart->listAllOrder();
        $tong = count($listAll);
        $sotrang = ceil($tong/$bghi);
        return $this->renderAdmin("order.list",compact('list','sotrang'));
    }
    public function detail($id)
    {
        $order = $this->cart->detailOrder($id);
        return $this->renderAdmin("order.detail",compact('order'));
    }

    public function updatedetail($id)
    {
        $order = $this->cart->selectUpdate($id);
        return $this->renderAdmin("order.update",compact('order'));
    }

    public function postDetail()
    {
       if(isset($_POST['submit'])){
           $id = $_POST['id'];
           $status = $_POST['status'];
           $check = $this->cart->update($id,$status);
           if($check){
               flash('success', 'Cập nhật trạng thái thành công', 'admin/order/detail/update/'.$id);
           }else{
               flash('errors','Cập nhật lỗi', 'admin/order/detail/update/'.$id);
           }
       }
    }


}
