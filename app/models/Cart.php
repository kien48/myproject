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
    public function total()
    {
        $sql = "SELECT SUM(total_amount) AS total_amount 
            FROM $this->table
            WHERE status = 3";

        $this->setQuery($sql);
        return $this->loadRow();
    }




    public function listAllOrder()
    {
        $sql = "SELECT * FROM $this->table WHERE 1 ORDER BY id DESC ";

        $this->setQuery($sql);
        return $this->loadAllRows();
    }


    public function listAllOrderPages($vitri,$bghi,$id = null)
    {
        $sql = "SELECT i.*,u.username FROM invoices i 
          INNER JOIN users u ON u.id = i.id_user";
        if ($id !== null) {
            $sql .= " WHERE i.id = $id";
        }else{
            $sql .= " WHERE 1";
        }

        $sql .= " ORDER BY i.id DESC LIMIT $vitri, $bghi";

        $this->setQuery($sql);
        return $this->loadAllRows();
    }



    public function listAllOrderStatus($status)
    {
        $sql = "SELECT i.*,u.username FROM invoices i 
          INNER JOIN users u ON u.id = i.id_user WHERE i.status = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$status]);
    }


    public function updateQuantity($quantity,$idpro,$color,$size)
    {
        $sql = "UPDATE `variant`
                SET `quantity` = `quantity` - ?
                WHERE `idpro` = ? AND `color` = ? AND `size` = ?;";
        $this->setQuery($sql);
        return $this->execute([$quantity,$idpro,$color,$size]);
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


    public function totalOrder()
    {
        $sql = "SELECT COUNT(*) AS total FROM $this->table WHERE status = 3";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function thongKe()
    {
        $sql = "SELECT `status`, COUNT(*) as total_orders 
FROM $this->table
GROUP BY `status`;
";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function giaThongKe()
    {
        $sql = "SELECT 
    MIN(total_amount) AS don_thap_nhat, 
    MAX(total_amount) AS don_cao_nhat, 
    AVG(total_amount) AS don_trung_binh
FROM invoices;
";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function thongKeNguoiMua()
    {
        $sql = "SELECT 
    i.id_user, 
    u.username, 
    COUNT(*) AS total_orders, 
    SUM(CASE WHEN i.status = 3 THEN i.total_amount ELSE 0 END) AS total_amount_status_3,
    (SELECT COUNT(*) FROM invoices WHERE status = 3 AND id_user = i.id_user) AS total_orders_status_3
FROM 
    invoices i
INNER JOIN 
    users u ON u.id = i.id_user
GROUP BY 
    i.id_user, 
    u.username;
";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }



}
