<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $table = "products";

    public function productNew()
    {
        $sql = "SELECT p.*, c.name AS category_name FROM {$this->table} p
        INNER JOIN categories c ON p.id_ct = c.id
        WHERE status = 1
        ORDER BY p.id  DESC LIMIT 4";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function searchProduct($keyword)
    {
        $searchKeyword = '%' . $keyword . '%';
        $sql = "SELECT * FROM $this->table WHERE status = 1 AND name LIKE ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$searchKeyword]);
    }


    public function listProductForCategory($id_ct)
    {
        $sql = "SELECT * FROM $this->table WHERE id_ct = ? AND status = 1";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_ct]);
    }

    public function listProduct()
    {
        $sql = "SELECT * FROM `products` WHERE 1 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }



    public function listProductPages($vitri, $bghi, $id = null)
    {
        $sql = "SELECT p.*, c.name AS name_ct FROM `$this->table` p
            INNER JOIN `categories` c ON p.id_ct = c.id";

        if ($id !== null) {
            $sql .= " WHERE p.id = $id";
        } else {
            $sql .= " WHERE 1";
        }

        $sql .= " ORDER BY p.id DESC LIMIT $vitri, $bghi";

        $this->setQuery($sql);
        return $this->loadAllRows([]);
    }



    public function detailProduct($id)
    {
        $sql = "SELECT p.*, c.name as name_ct
            FROM products p 
            INNER JOIN categories c ON p.id_ct = c.id
            WHERE p.id = ?";

        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function addProduct($id, $name, $price, $import_price, $image, $image2, $description, $id_ct, $status)
    {
        $sql = "INSERT INTO  $this->table VALUES (?,?,?,?,?,?,?,?,?) ";
        $this->setQuery($sql);
        return $this->execute([$id, $name, $price, $import_price, $image, $image2, $description, $id_ct, $status]);
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }

    public function updateProduct($id, $name, $price, $import_price, $image, $image2, $description, $id_ct, $status)
    {
        $sql = "UPDATE $this->table SET `name`=?,`price`=?,`import_price`=?,`image`=?,
                      `image2`=?,`description`=?,`id_ct`=?,`status`=? WHERE id= ?";
        $this->setQuery($sql);
        return $this->execute([$name, $price, $import_price, $image, $image2, $description, $id_ct, $status, $id]);
    }

    public function listProductCl($id_ct, $id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE status = 1 AND id_ct = ? AND id != ? LIMIT 0,4";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_ct, $id]);
    }
    public function listProductKids($id_ct)
    {
        $sql = "SELECT * FROM $this->table WHERE status =1 AND id_ct = ? LIMIT 0,4";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_ct]);
    }

    public function numberOfProductSales($id)
    {
        $sql = "SELECT
  p.id AS id_product,
  p.name AS product_name,
  SUM(id.quantity) AS total_sold
FROM
  invoice_details id
  INNER JOIN products p ON id.id_product = p.id
  INNER JOIN invoices inv ON inv.id = id.invoice_id  -- Link to invoices table
WHERE
  inv.status = 3  -- Filter by invoice status (replace 3 with your actual value)
  AND id.id_product = ?  -- Filter by product ID (replace ? with parameter)
GROUP BY
  id_product, product_name
ORDER BY
  total_sold DESC ;
";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function listProductsBestSeller()
    {
        $sql = "SELECT
  p.id AS id_product,
  p.name AS product_name,
  p.price,
  p.image,
  SUM(id.quantity) AS total_sold
FROM
  invoice_details id
  INNER JOIN products p ON id.id_product = p.id
  INNER JOIN invoices inv ON inv.id = id.invoice_id  -- Liên kết với bảng invoices
WHERE
  inv.status = 3  -- Chỉ lấy dữ liệu với trạng thái hóa đơn là 3
GROUP BY
  id_product, product_name, p.price, p.image
ORDER BY
  total_sold DESC
LIMIT
  0, 4;

";
        $this->setQuery($sql);
        return $this->loadAllRows([]);
    }


    public function topProducts()
    {
        $sql = "SELECT
  p.id AS id_product,
  p.name AS product_name,
  p.price,
  p.image,
  SUM(id.quantity) AS total_sold
FROM
  invoice_details id
  INNER JOIN products p ON id.id_product = p.id
  INNER JOIN invoices inv ON inv.id = id.invoice_id  -- Liên kết với bảng invoices
WHERE
  inv.status = 3  -- Chỉ lấy dữ liệu với trạng thái hóa đơn là 3
GROUP BY
  id_product, product_name, p.price, p.image
ORDER BY
  total_sold DESC
";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }


    public function bienThe($id_pro)
    {
        $sql = "SELECT * FROM `variant` WHERE idpro = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_pro]);
    }

    public function bienTheforID($id)
    {
        $sql = "SELECT * FROM `variant` WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function listBienTheSP($id)
    {
        $sql = "SELECT v.*,p.name FROM `variant` v
                INNER JOIN products p ON v.idpro = p.id
                WHERE v.idpro = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function listBienTheSP1($idpro, $id)
    {
        $sql = "SELECT v.*, p.name 
            FROM `variant` v
            INNER JOIN products p ON v.idpro = p.id
            WHERE v.idpro = ? AND v.id != ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$idpro, $id]);
    }


    public function listBienThe()
    {
        $sql = "SELECT * FROM `variant` WHERE 1";
        $this->setQuery($sql);
        return $this->loadAllRows([]);
    }


    public function deleteBienThe($id)
    {
        $sql = "DELETE FROM `variant` WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }


    public function insertBienThe($id, $idpro, $color, $size, $quantity)
    {
        $sql = "INSERT INTO `variant`(`id`, `idpro`, `color`, `size`, `quantity`) VALUES (?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id, $idpro, $color, $size, $quantity]);
    }

    public function updateBienThe($id, $idpro, $color, $size, $quantity)
    {
        $sql = "UPDATE `variant` SET `idpro`=?,`color`=?,`size`=?,`quantity`=? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$idpro, $color, $size, $quantity, $id]);
    }

    public function updateStatusPro($id)
    {
        $sql = "UPDATE `products` SET `status`=1 WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }

    public function huyProduct($idpro, $color, $size, $quantity)
    {
        $sql = "UPDATE `variant` 
                SET `quantity` = `quantity` + ? 
                WHERE `idpro`= ? AND `color`= ? AND `size`= ?
";
        $this->setQuery($sql);
        return $this->execute([$quantity, $idpro, $color, $size]);
    }


    public function totalProduct()
    {
        $sql = "SELECT COUNT(*) AS total FROM $this->table";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function thongKe()
    {
        $sql = "SELECT c.id AS id_danh_muc, c.name AS ten_danh_muc, COUNT(p.id) AS so_luong_san_pham
FROM categories c
LEFT JOIN products p ON p.id_ct = c.id
GROUP BY c.id;
";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function ThongKeGia()
    {
        $sql = "SELECT 
    MIN(price) AS gia_thap_nhat, 
    AVG(price) AS gia_trung_binh, 
    MAX(price) AS gia_cao_nhat
FROM $this->table;
";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function ThongKeSao()
    {
        $sql = "SELECT 
    p.id AS id_san_pham, 
    p.name AS ten_san_pham, 
    c.star
FROM 
    products p
LEFT JOIN 
    comments c ON p.id = c.id_pro
WHERE
    c.star BETWEEN 1 AND 5
GROUP BY 
    p.id, c.star;
";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
}
