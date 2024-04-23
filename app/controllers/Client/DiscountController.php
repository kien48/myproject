<?php
namespace App\controllers\Client;
use App\Models\discount;

class DiscountController extends BaseController{
    protected $discount;
    public function __construct()
    {
        $this->discount = new discount();
    }

    public function list()
    {
        $list = $this->discount->listDiscountUser();
        return $this->renderClient("discount.list",compact('list'));
    }


}
