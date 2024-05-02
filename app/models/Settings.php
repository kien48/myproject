<?php

namespace App\Models;

class Settings extends BaseModel
{
    protected $table = "settings";

    public function listSettings()
    {
        $sql = "SELECT * FROM $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function updateSettings($logo, $sayings, $banner, $link_fb, $link_yt, $link_tiktok, $company_name, $phone, $address, $banner1, $banner2, $banner3, $link_bn_1, $link_bn_2, $link_bn_3)
    {
        $sql = "UPDATE $this->table 
            SET `logo`=?, `sayings`=?, `banner`=?, `link_fb`=?, `link_yt`=?, `link_tiktok`=?, `company_name`=?, `phone`=?, `address`=? ,`banner1`=?,`banner2`=?,`banner3`=?,`link_bn_1`=?,`link_bn_2`=?,`link_bn_3`=? 
            WHERE 1";
        $this->setQuery($sql);
        return $this->execute([$logo, $sayings, $banner, $link_fb, $link_yt, $link_tiktok, $company_name, $phone, $address, $banner1, $banner2, $banner3, $link_bn_1, $link_bn_2, $link_bn_3]);
    }
}
