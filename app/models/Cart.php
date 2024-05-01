<?php

namespace App\Models;

class Cart extends BaseModel
{
    protected $table = "invoices";
    public function order($id,$name, $phone, $address, $id_user, $total, $created_at, $note, $ship, $payment, $status,$percentDiscount,$payment_status)
    {
        $sql = "INSERT INTO $this->table  VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
        $this->setQuery($sql);
        $re = $this->execute([$id,$name, $phone, $address, $id_user, $total, $created_at, $note, $ship, $payment, $status,$percentDiscount,$payment_status]);
        $lastId = $this->getPdo()->lastInsertId();
        return $lastId;
    }

    public function orderDetail($id, $invoice_id,$id_product, $product_name, $quantity, $price, $total,$size,$color)
    {
        $sql = "INSERT INTO invoice_details (id, invoice_id,id_product, product_name, quantity, price, total, size, color) 
                VALUES (?, ?,?, ?, ?, ?, ?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id, $invoice_id,$id_product, $product_name, $quantity, $price, $total,$size,$color]);
    }
    public function listOrder($id_user)
    {
        $sql = "SELECT * FROM $this->table WHERE id_user = ? ORDER BY id DESC";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_user]);
    }
    public function totalToday()
    {
        $sql = "SELECT SUM(total_amount) AS total_today 
            FROM $this->table
            WHERE DATE(created_at) = CURDATE() AND status = 3
            GROUP BY DATE(created_at), status";

        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function totalThisWeek()
    {
        $sql = "SELECT SUM(total_amount) AS total_week 
            FROM $this->table
            WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) AND status = 3
            GROUP BY YEARWEEK(created_at, 1), status";

        $this->setQuery($sql);
        return $this->loadAllRows();
    }


    public function totalThisMonth()
    {
        $sql = "SELECT SUM(total_amount) AS total_month 
            FROM $this->table
            WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) AND status = 3
            GROUP BY MONTH(created_at), status";

        $this->setQuery($sql);
        return $this->loadAllRows();
    }




    public function listAllOrder()
    {
        $sql = "SELECT * FROM $this->table WHERE 1 ORDER BY id DESC ";

        $this->setQuery($sql);
        return $this->loadAllRows();
    }


    public function listAllOrderPages($vitri,$bghi)
    {
        $sql = "SELECT * FROM invoices WHERE 1 ORDER BY id DESC LIMIT $vitri,$bghi ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }


    public function updateQuantity($quantity,$idpro,$color,$size)
    {
        $sql = "UPDATE `variant`
                SET `quantity` = `quantity` - ?
                WHERE `idpro` = ? AND `color` = ? AND `size` = ?;";
        $this->setQuery($sql);
        return $this->execute([$quantity,$idpro,$color,$size]);
    }

    public function detailOrderForOrder($invoice_id)
    {
        $sql = "SELECT * FROM `invoice_details`
                WHERE invoice_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$invoice_id]);
    }

    public function huyOrder($id)
    {
        $sql = "UPDATE `invoices` SET `status`= 4 WHERE id= ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }

    public function detailOrderForID($id)
    {
        $sql = "SELECT * FROM $this->table
                WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function detailOrder($id)
    {
        $sql = "SELECT i.*,d.product_name,d.id_product,d.quantity,d.price,d.total,d.size,d.color FROM $this->table i
                INNER JOIN invoice_details d ON i.id = d.invoice_id
                WHERE i.id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function selectUpdate($id)
    {
        $sql = "SELECT * FROM $this->table i
                WHERE i.id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function update($id,$status)
    {
        $sql = "UPDATE `invoices` SET `status`= ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$status,$id]);
    }

    public function updatePaymentStatus()
    {
        $sql = "UPDATE `invoices` SET `payment_status` = 0 WHERE `status` = 3;";
        $this->setQuery($sql);
        return $this->execute([]);
    }


}
