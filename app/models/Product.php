<?php
namespace App\Models;
class Product extends BaseModel {
    protected $table = "products";

    public function productNew()
    {
        $sql = "SELECT p.*, c.name AS category_name FROM {$this->table} p
        INNER JOIN categories c ON p.id_ct = c.id WHERE status = 1
        ORDER BY p.id DESC LIMIT 4";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function searchProduct($keyword)
    {
        // Sử dụng dấu `%` trong câu truy vấn để tìm kiếm các từ khóa trong tên sản phẩm
        $searchKeyword = '%' . $keyword . '%';

        $sql = "SELECT * FROM $this->table WHERE name LIKE ? AND status = 1";
        $this->setQuery($sql);

        // Truyền giá trị của biến $searchKeyword vào mảng truyền vào hàm loadAllRows([$searchKeyword])
        // để sử dụng trong câu SQL
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

    public function listProductPages($vitri,$bghi)
    {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT $vitri,$bghi ";
        $this->setQuery($sql);
        return $this->loadAllRows();
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
    public function addProduct($id,$name,$price,$image,$image2,$description,$id_ct)
    {
        $sql = "INSERT INTO  $this->table VALUES (?,?,?,?,?,?,?) ";
        $this->setQuery($sql);
        return $this->execute([$id,$name,$price,$image,$image2,$description,$id_ct]);
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
    public function listProductCl($id_ct,$id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE status = 1 AND id_ct = ? AND id != ? LIMIT 0,4";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_ct,$id]);
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
}