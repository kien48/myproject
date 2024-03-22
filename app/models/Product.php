<?php
namespace App\Models;
class Product extends BaseModel {
    protected $table = "products";

    public function productNew()
    {
        $sql = "SELECT p.*, c.name AS category_name FROM {$this->table} p
        INNER JOIN categories c ON p.id_ct = c.id 
        ORDER BY p.id DESC LIMIT 4";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function searchProduct($keyword)
    {
        // Sử dụng dấu `%` trong câu truy vấn để tìm kiếm các từ khóa trong tên sản phẩm
        $searchKeyword = '%' . $keyword . '%';

        $sql = "SELECT * FROM $this->table WHERE name LIKE ?";
        $this->setQuery($sql);

        // Truyền giá trị của biến $searchKeyword vào mảng truyền vào hàm loadAllRows([$searchKeyword])
        // để sử dụng trong câu SQL
        return $this->loadAllRows([$searchKeyword]);
    }

    public function listProductForCategory($id_ct)
    {
        $sql = "SELECT * FROM $this->table WHERE id_ct = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_ct]);
    }

    public function listProduct()
    {
        $sql = "SELECT * FROM $this->table ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function detailProduct($id)
    {
        $sql = "SELECT p.*, c.name AS category_name FROM {$this->table} p
        INNER JOIN categories c ON p.id_ct = c.id   WHERE p.id =?";
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
        $sql = "SELECT * FROM {$this->table} WHERE id_ct = ? AND id != ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_ct,$id]);
    }
    public function listProductKids($id_ct)
    {
        $sql = "SELECT * FROM $this->table WHERE id_ct = ? LIMIT 0,4";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_ct]);
    }
}