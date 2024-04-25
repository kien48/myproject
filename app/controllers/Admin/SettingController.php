<?php
namespace App\Controllers\Admin;
use App\Models\Settings;
class SettingController extends BaseController
{
    protected $settings;
    public function __construct()
    {
        $this->settings = new Settings();
    }

    public function form()
    {
        $listSettings = $this->settings->listSettings();

        $_SESSION['listSettings'] = $listSettings; // Gán $listSettings vào session
        return $this->renderAdmin("settings.form");
    }

    public function formUpdate()
    {
        if(isset($_POST['update'])){
            if(isset($_SESSION['listSettings'][0]->logo)){
                $sayings = $_POST['sayings'];
                $link_fb = $_POST['link_fb'];
                $link_yt = $_POST['link_yt'];
                $link_tiktok = $_POST['link_tiktok'];
                $company_name = $_POST['company_name'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $logo = $_POST['logo'];
                $banner1 =$_SESSION['listSettings'][0]->banner1;
                $banner2 = $_SESSION['listSettings'][0]->banner2;
                $banner3 = $_SESSION['listSettings'][0]->banner3;
                $link_bn_1 = $_POST['link_bn_1'];
                $link_bn_2 = $_POST['link_bn_2'];
                $link_bn_3 = $_POST['link_bn_3'];
                // Kiểm tra xem có banner trong session không
                if(isset($_SESSION['listSettings'][0]->banner)){
                    $banner = $_SESSION['listSettings'][0]->banner;
                    $check = $this->settings->updateSettings($logo,$sayings,$banner,$link_fb,$link_yt,$link_tiktok,$company_name,$phone,$address,$banner1,$banner2,$banner3,$link_bn_1,$link_bn_2,$link_bn_3);
                    unset($_SESSION['listSettings']);
                    if ($check) {
                        $_SESSION['listSettings'] = $check;
                        flash('success', 'Cập nhật cài đặt thành công', 'admin/settings');
                    } else {
                        flash('errors', 'Có lỗi xảy ra khi cập nhật cài đặt', 'admin/settings');
                    }
                } else {
                    flash('errors', 'Không tìm thấy banner trong session', 'admin/settings');
                }
            } else {
                flash('errors', 'Không tìm thấy logo trong session', 'admin/settings');
            }
        }
    }


}
