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
        $sql = "SELECT * FROM comments WHERE 1 ORDER BY ID DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function listAllPages($vitri, $bghi)
    {
        $sql = "SELECT c.*,u.username,p.name  FROM comments c
                            INNER JOIN users u ON c.id_user = u.id
                            INNER JOIN products p ON p.id = c.id_pro
                            WHERE 1 ORDER BY c.ID DESC LIMIT $vitri, $bghi";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function feedBack($id_comment)
    {
        $sql = "SELECT * FROM `feedback` WHERE 1 AND id_comment = ".$id_comment;
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function checkFeedBack($id_comment)
    {
        $sql = "SELECT * FROM `feedback` WHERE 1 AND id_comment = ".$id_comment;
        $this->setQuery($sql);
        return $this->loadAllRows();
    }


    public function detailFeedback($id)
    {
        $sql = "SELECT c.*, u.username, p.name, f.text AS feedback_text, f.date AS feedback_date, f.id_user_admin
FROM comments c
INNER JOIN users u ON c.id_user = u.id
INNER JOIN products p ON p.id = c.id_pro
INNER JOIN feedback f ON f.id_comment = c.id
WHERE c.id = ?
";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function listOne($id)
    {
        $sql = "SELECT c.*,u.username,p.name  FROM comments c
                            INNER JOIN users u ON c.id_user = u.id
                            INNER JOIN products p ON p.id = c.id_pro
                            WHERE c.id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }


    public function insertFeedback($id,$id_comment,$id_user_admin,$text,$date)
    {
        $sql = "INSERT INTO `feedback`(`id`, `id_comment`, `id_user_admin`, `text`, `date`) VALUES (?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->loadAllRows([$id,$id_comment,$id_user_admin,$text,$date]);
    }


    public function thongKe()
    {
        $sql = "SELECT 
    c.id_user, 
    u.username, 
    COUNT(*) AS total_comments 
FROM 
    comments c
INNER JOIN 
    users u ON u.id = c.id_user
GROUP BY 
    c.id_user, 
    u.username;";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }



}