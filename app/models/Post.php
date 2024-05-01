<?php
namespace App\Models;
class Post extends BaseModel
{
    protected $table = "post";
    public function listPost()
    {
        $sql = "SELECT * FROM $this->table where 1 ORDER BY id DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function listPostPages($viTri,$bGhi)
    {
        $sql = "SELECT * FROM $this->table where 1 ORDER BY id DESC LIMIT $viTri,$bGhi";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function listOnePost($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function insertPost($id,$tilte,$image,$text,$author,$date)
    {
        $sql = "INSERT INTO $this->table VALUES (?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id,$tilte,$image,$text,$author,$date]);
    }

    public function updatePost($id,$tilte,$image,$text,$author,$date)
    {
        $sql = "UPDATE $this->table SET `tilte`=?,
                  `image`=?,`text`=?,`author`=?,`date`=? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$tilte,$image,$text,$author,$date,$id]);
    }

    public function deletePost($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
}
