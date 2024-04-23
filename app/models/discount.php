<?php
namespace App\Models;
class discount extends BaseModel {
    protected $table = "discount";

    public function listDiscount()
    {
        $currentDate = date('Y-m-d'); // Lấy ngày hiện tại

        $sql = "SELECT * FROM $this->table WHERE expiration > '$currentDate' AND quantity > 0 AND start_day <='$currentDate' ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function listAllDiscount($vitri, $bghi)
    {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT $vitri, $bghi";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }


    public function listAllDiscount1()
    {
        $sql = "SELECT * FROM $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }


    public function applySuccess($id)
    {
        $sql = "UPDATE $this->table SET quantity = quantity - 1 WHERE id=?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }

    public function applyFail($id)
    {
        // Đơn giản là không cần thay đổi gì trong trường hợp áp dụng thất bại
        return true; // Trả về true để biểu thị rằng thao tác đã thành công (mặc dù không có gì được thay đổi)
    }
    public function insert($id,$code,$percent,$start_day,$expiration,$quantity,$status)
    {
        $sql = "INSERT INTO $this->table VALUES (?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id,$code,$percent,$start_day,$expiration,$quantity,$status]);
    }



}
