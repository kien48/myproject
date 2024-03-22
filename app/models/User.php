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
    public function insertUser($id,$user,$email,$pass,$phone,$address,$role,$created_ad)
    {
        $sql = "INSERT INTO $this->table VALUES (?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id,$user,$email,$pass,$phone,$address,$role,$created_ad]);
    }


}