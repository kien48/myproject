<?php

namespace App\Models;

class Category extends BaseModel
{
    protected $table = "categories";
    public function listCategory()
    {
        $sql = "SELECT * FROM $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function oneCategory($id)
    {
        $sql = "SELECT * FROM $this->table where id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function insertCategory($id, $name)
    {
        $sql = "INSERT INTO $this->table VALUES (?,?)";
        $this->setQuery($sql);
        return $this->execute([$id, $name]);
    }

    public function updateCategory($id, $name)
    {
        $sql = "UPDATE $this->table SET `name`=? WHERE  `id`= ?";
        $this->setQuery($sql);
        return $this->execute([$name, $id]);
    }

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM $this->table  WHERE  `id`= ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }

    public function checkKhoaNgoai()
    {
        $sql = "SELECT id, name 
                FROM categories 
                WHERE EXISTS (
                SELECT 1 
                FROM products
               WHERE products.id_ct = categories.id);";
        $this->setQuery($sql);
        return $this->loadAllRows([]);
    }

    public function totalCategory()
    {
        $sql = "SELECT COUNT(*) AS total FROM $this->table";
        $this->setQuery($sql);
        return $this->loadRow();
    }
}
