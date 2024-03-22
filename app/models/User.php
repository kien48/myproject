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


}