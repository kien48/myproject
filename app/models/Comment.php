<?php
namespace App\Models;
class Comment extends BaseModel {
    protected $table = "comments";

    public function listComment($id_pro)
    {
        $sql = "SELECT co.*, u.username 
            FROM {$this->table} co
            LEFT JOIN users u ON co.id_user = u.id 
            WHERE co.id_pro = ? AND co.id_user IS NOT NULL ORDER BY id DESC";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_pro]);
    }




    public function insertComment($id, $id_user, $content, $created_ad, $id_pro, $star)
    {
        $sql = "INSERT INTO $this->table VALUES (?, ?, ?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$id, $id_user, $content, $created_ad, $id_pro, $star]);
    }

    public function productStatistics($id_pro)
    {
        $sql = "SELECT AVG(CASE WHEN star > 0 THEN star ELSE NULL END) AS average_rating,
                   COUNT(CASE WHEN star > 0 THEN 1 ELSE NULL END) AS number,
                   COUNT(*) AS total_reviews
            FROM $this->table
            WHERE id_pro = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id_pro]);
    }

    public function listAll()
    {
        $sql = "SELECT * FROM $this->table WHERE 1 ORDER BY ID DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }



}