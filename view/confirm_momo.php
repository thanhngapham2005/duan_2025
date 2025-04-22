<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Log file
$logFile = __DIR__ . '/momo_debug.log';
function writeLog($message)
{
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

writeLog("Starting MOMO payment process");

require_once '../commoms/function.php';
require_once '../model/payModel.php';
require_once '../controller/payController.php';

if (isset($_POST['momo'])) {
    try {
        writeLog("MOMO payment initiated");
        writeLog("POST data received: " . print_r($_POST, true));

        if (!isset($_SESSION['user']['customer_info'])) {
            throw new Exception("Vui lòng đăng nhập để thanh toán");
        }

        $total_amount = (int)$_POST['total_amount'];
        $discount_code = isset($_POST['discount_code']) ? $_POST['discount_code'] : null;
        $discount_amount = isset($_POST['discount_amount']) ? (int)$_POST['discount_amount'] : 0;

        // Lấy thông tin khách hàng
        $id_customer = $_SESSION['user']['customer_info']['id_customer'];
        $receiver_name = $_POST['receiver_name'];
        $receiver_phone = $_POST['receiver_phone'];
        $receiver_address = $_POST['receiver_address'];
        $cartItems = $_SESSION['mycart'];

        if (empty($cartItems)) {
            throw new Exception("Giỏ hàng trống!");
        }

        // Lưu đơn hàng
        $payController = new payController();
        $result = $payController->saveMomoOrder(
            $id_customer,
            $receiver_name,
            $receiver_phone,
            $receiver_address,
            $cartItems,
            $discount_code,
            $discount_amount
        );

        if (!$result) {
            throw new Exception("Không thể lưu đơn hàng");
        }

        // Lưu thông tin giảm giá vào session để sử dụng sau này
        $_SESSION['momo_discount'] = [
            'code' => $discount_code,
            'amount' => $discount_amount
        ];

        // MOMO Config và các xử lý tiếp theo...
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderInfo = "Thanh toan don hang";
        $redirectUrl = "http://" . $_SERVER['HTTP_HOST'] . "/duan/duan_2025/index.php?act=pay";
        $ipnUrl = "http://" . $_SERVER['HTTP_HOST'] . "/duan/duan_2025/index.php?act=pay";
        $orderId = time() . "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        $extraData = "";

        // Tạo data array
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId' => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $total_amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType
        );

        // Tính signature
        $rawHash = "accessKey=" . $accessKey .
            "&amount=" . $total_amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data['signature'] = $signature;

        // Gửi request đến MOMO
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception("Lỗi CURL: " . curl_error($ch));
        }
        curl_close($ch);

        writeLog("Response from MOMO: " . print_r($result, true));

        $jsonResult = json_decode($result, true);
        if (isset($jsonResult['payUrl'])) {
            writeLog("Redirecting to payUrl: " . $jsonResult['payUrl']);
            // Lưu orderId vào session để sau này đối chiếu
            $_SESSION['momo_order_id'] = $orderId;
            header('Location: ' . $jsonResult['payUrl']);
            exit;
        } else {
            writeLog("Error response: " . print_r($jsonResult, true));
            throw new Exception("Lỗi kết nối với MOMO: " . ($jsonResult['message'] ?? 'Unknown error'));
        }
    } catch (Exception $e) {
        writeLog("Error: " . $e->getMessage());
        $_SESSION['payment_status'] = 'error';
        $_SESSION['payment_message'] = 'Lỗi thanh toán: ' . $e->getMessage();
        header('Location: ../index.php?act=pay');
        exit;
    }
} else {
    writeLog("No MOMO POST data received");
}
