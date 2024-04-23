<?php
namespace App\Controllers\Admin;
use App\Models\Cart;

class OrderController extends BaseController
{
    private $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }
    public function list(){
        $list = $this->cart->listAllOrder();
        return $this->renderAdmin("order.list",compact('list'));
    }

}
