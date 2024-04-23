<?php

namespace App\Models;

class Cart extends BaseModel
{
    protected $table = "invoices";
    public function order($id,$name, $phone, $address, $id_user, $total, $created_at, $note, $ship, $payment, $status,$percentDiscount)
    {
        $sql = "INSERT INTO $this->table  VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $this->setQuery($sql);
        $re = $this->execute([$id,$name, $phone, $address, $id_user, $total, $created_at, $note, $ship, $payment, $status,$percentDiscount]);
        $lastId = $this->getPdo()->lastInsertId();
        return $lastId;
    }

    public function orderDetail($id, $invoice_id,$id_product, $product_name, $quantity, $price, $total)
    {
        $sql = "INSERT INTO invoice_details (id, invoice_id,id_product, product_name, quantity, price, total) 
                VALUES (?, ?,?, ?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$id, $invoice_id,$id_product, $product_name, $quantity, $price, $total]);
    }
    public function listOrder($id_user)
    {
        $sql = "SELECT * FROM $this->table WHERE id_user = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_user]);
    }

    public function totalToday()
    {
        $sql = "SELECT *, SUM(total_amount) AS total_today FROM $this->table 
                WHERE DATE(created_at) = CURDATE() AND status = 3
               
";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function listAllOrder()
    {
        $sql = "SELECT * FROM $this->table where 1 order by id desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }




}
