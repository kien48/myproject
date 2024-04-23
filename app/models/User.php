<?php
namespace App\Models;
class User extends BaseModel
{
    protected $table = "users";
    public function checkLogin($email, $pass)
    {
        $sql = "SELECT * FROM $this->table WHERE email = ? AND password = ?";
        $this->setQuery($sql);
        return $this->loadRow([$email, $pass]);
    }
    public function insertUser($id,$user,$email,$pass,$phone,$address,$role,$created_ad,$rank)
    {
        $sql = "INSERT INTO $this->table VALUES (?,?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id,$user,$email,$pass,$phone,$address,$role,$created_ad,$rank]);
    }

    public function checkLoginAdmin($user, $pass)
    {
        $sql = "SELECT * FROM $this->table WHERE username = ? AND password = ? AND role = 2 ";
        $this->setQuery($sql);
        return $this->loadRow([$user, $pass]);
    }

    public function updateRank()
    {
        $sql = "UPDATE users u
JOIN (
    SELECT id_user, SUM(total_amount) AS total_amount
    FROM invoices 
    WHERE status = 3
    GROUP BY id_user
) AS total ON u.id = total.id_user
SET u.rank = 
    CASE 
        WHEN total.total_amount > 100000000 THEN 3
        WHEN total.total_amount > 50000000 THEN 2
        WHEN total.total_amount > 20000000 THEN 1
        ELSE 0
    END;
";
        $this->setQuery($sql);
        return $this->execute([]);
    }



public function listMessage($id_user_1 , $id_user_2)
{
    $sql = "SELECT m.id, m.conversation_id, m.sender_id, m.content, m.date,m.status,u.username
FROM messages m
    INNER JOIN users u ON m.sender_id = u.id
INNER JOIN conversations c ON m.conversation_id = c.id
WHERE (c.id_user_admin = '$id_user_1 ' AND c.id_user = '$id_user_2')
   OR (c.id_user_admin = '$id_user_2' AND c.id_user = '$id_user_1 ');
";
    $this->setQuery($sql);
    return $this->loadAllRows();
}


public function insertInbox($id,$id_admin,$id_user)
{
    $sql = "INSERT INTO `conversations`(`id`, `id_user_admin`, `id_user`) VALUES (?,?,?)
";
    $this->setQuery($sql);
    return $this->execute([$id,$id_admin,$id_user]);
}

public function checkBox($id_user)
{
    $sql = "SELECT `id`, `id_user_admin`, `id_user` FROM `conversations` WHERE id_user = ".$id_user;
    $this->setQuery($sql);
    return $this->loadAllRows([]);
}
    public function checkBoxAdmin($id_user_admin,$id)
    {
        $sql = "SELECT `id`, `id_user_admin`, `id_user` FROM `conversations` WHERE id_user_admin = ".$id_user_admin." AND  id = ".$id;
        $this->setQuery($sql);
        return $this->loadAllRows([]);
    }

    public function conversations()
    {
        $sql = "SELECT c.`id`, c.`id_user_admin`, c.`id_user`, u.`username`
                FROM `conversations` c
                LEFT JOIN `users` u ON c.`id_user` = u.`id`
                WHERE 1;";
        $this->setQuery($sql);
        return $this->loadAllRows([]);
    }

    public function send($id,$conversation_id,$sender_id,$content,$date,$status)
    {
        $sql = "INSERT INTO `messages`(`id`, `conversation_id`, `sender_id`, `content`, `date`,`status`) 
                VALUES (?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id,$conversation_id,$sender_id,$content,$date,$status]);
    }

    public function updateStatus($conversation_id,$id_user)
    {
        $sql = "UPDATE `messages` m
JOIN `conversations` c ON m.`conversation_id` = c.`id`
SET m.`status` = 0
WHERE ? = c.`id` AND m.sender_id = ?;
";
        $this->setQuery($sql);
        return $this->execute([$conversation_id,$id_user]);
    }


    public function tinChuaDoc($id_user,$conversation_id)
    {
        $sql = "SELECT conversation_id, COUNT(*) as total_status_1 
FROM messages 
WHERE status = 1 AND sender_id != ?
GROUP BY conversation_id = ?;
";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_user,$conversation_id]);
    }



    public function listAllUser()
    {
        $sql = "SELECT * FROM $this->table WHERE role = 1 ORDER BY id DESC
";
        $this->setQuery($sql);
        return $this->loadAllRows([]);
    }








}