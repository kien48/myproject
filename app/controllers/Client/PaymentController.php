<?php
namespace App\controllers\Client;

use http\Env\Request;

class PaymentController extends BaseController
{
    public function vnpay()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL của cổng thanh toán
        $vnp_Returnurl = "http://localhost:90/vnpay_php/vnpay_return.php"; // URL để xử lý kết quả trả về từ VNPAY
        $vnp_TmnCode = "6FQRPIJM"; // Mã website tại VNPAY
        $vnp_HashSecret = "PTSJCECJUANMJNLXEPQGPQVQQLQRYREG"; // Chuỗi bí mật

        $vnp_TxnRef = $_POST['id']; // Mã đơn hàng
        $vnp_OrderInfo = "thanh toán đơn hàng"; // Thông tin đơn hàng
        $vnp_OrderType = "Trung Kiên Shop"; // Loại đơn hàng

        // Xác định số tiền thanh toán
        if(isset($_POST['total'])) {
            $vnp_Amount = $_POST['total'] * 100;
        } elseif(isset($_POST['totalCompleted'])) {
            $vnp_Amount = $_POST['totalCompleted'] * 100;
        } else {
            // Xử lý hoặc thông báo lỗi tùy thuộc vào logic của bạn
        }

        $vnp_Locale = "VI"; // Ngôn ngữ
        $vnp_BankCode = "NCB"; // Mã ngân hàng
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của client

        // Thông tin thanh toán
        $vnp_Bill_Mobile = '0366508004';
        $vnp_Bill_Email = "lkien610@gmail.com";
        $fullName = trim("Lê Kiên");
        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }
        $vnp_Bill_Address = "Hoàng Long";
        $vnp_Bill_City = "Hà Nội";
        $vnp_Bill_State = "hahaa";

        // Thông tin hóa đơn
        $vnp_Inv_Phone = "0366508004";
        $vnp_Inv_Email = "lkien610@gmail.com";
        $vnp_Inv_Customer = "cc";
        $vnp_Inv_Address = "jb";
        $vnp_Inv_Company = "Trung kiên shop";
        $vnp_Inv_Taxcode = "99";
        $vnp_Inv_Type = "00";

        // Tạo mảng dữ liệu đầu vào
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            "vnp_Bill_Email" => $vnp_Bill_Email,
            "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            "vnp_Bill_LastName" => $vnp_Bill_LastName,
            "vnp_Bill_Address" => $vnp_Bill_Address,
            "vnp_Bill_City" => $vnp_Bill_City,
            "vnp_Inv_Phone" => $vnp_Inv_Phone,
            "vnp_Inv_Email" => $vnp_Inv_Email,
            "vnp_Inv_Customer" => $vnp_Inv_Customer,
            "vnp_Inv_Address" => $vnp_Inv_Address,
            "vnp_Inv_Company" => $vnp_Inv_Company,
            "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            "vnp_Inv_Type" => $vnp_Inv_Type
        );

        // Thêm mã ngân hàng và trạng thái thanh toán nếu có
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        // Tạo mã hash bảo mật
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );

        // Chuyển hướng hoặc trả về dữ liệu dưới dạng JSON
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }


}
