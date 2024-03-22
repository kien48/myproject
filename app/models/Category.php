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
}
