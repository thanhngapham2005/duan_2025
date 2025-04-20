<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Tạo file log riêng cho MOMO
$logFile = __DIR__ . '/momo_debug.log';

function writeLog($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

writeLog("Starting MOMO payment process");
writeLog("POST data: " . print_r($_POST, true));
writeLog("SESSION data: " . print_r($_SESSION, true));

require_once '../commoms/function.php';
require_once '../model/payModel.php';
require_once '../controller/payController.php';

if (isset($_POST['momo'])) {
    try {
        writeLog("MOMO payment initiated");
        
        if (!isset($_SESSION['user']['customer_info'])) {
            throw new Exception("Vui lòng đăng nhập để thanh toán");
        }
        
        if (!isset($_POST['total_amount']) || empty($_POST['total_amount'])) {
            throw new Exception("Không tìm thấy số tiền thanh toán");
        }

        $total_amount = (int)$_POST['total_amount'];
        if ($total_amount <= 0) {
            throw new Exception("Số tiền thanh toán không hợp lệ");
        }

        writeLog("Total amount: " . $total_amount);

        $id_customer = $_SESSION['user']['customer_info']['id_customer'];
        $receiver_name = $_SESSION['user']['customer_info']['full_name'];
        $receiver_phone = $_SESSION['user']['customer_info']['phone'];
        $receiver_address = $_SESSION['user']['customer_info']['address'];
        $cartItems = $_SESSION['mycart'];

        if (empty($cartItems)) {
            throw new Exception("Giỏ hàng trống!");
        }

        // Debug thông tin
        error_log("MOMO Payment - Amount: " . $total_amount);
        error_log("MOMO Payment - Customer: " . $id_customer);

        $payController = new payController();
        $result = $payController->saveMomoOrder(
            $id_customer,
            $receiver_name,
            $receiver_phone,
            $receiver_address,
            $cartItems
        );

        if ($result) {
            writeLog("Order saved successfully, proceeding with MOMO payment");
            // Cấu hình MOMO
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = "MOMOBKUN20180529";
            $accessKey = "klm05TvNBzhg7h7j";
            $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
            $orderInfo = "Thanh toan don hang";
            $redirectUrl = "http://localhost/tthien-duan1/duan_2025/index.php?act=pay";
            $ipnUrl = "http://localhost/tthien-duan1/duan_2025/index.php?act=pay";
            $orderId = time() . "";
            $requestId = time() . "";
            $requestType = "payWithATM";
            $extraData = "";

            $rawHash = "accessKey=" . $accessKey . "&amount=" . $total_amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => (int)$total_amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );

            writeLog("MOMO Request data: " . print_r($data, true));

            $ch = curl_init($endpoint);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($data))
            ));
            curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Tăng timeout
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // Tăng timeout
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Thêm option này nếu có vấn đề SSL
            
            $result = curl_exec($ch);
            
            if (curl_errno($ch)) {
                error_log("MOMO Curl Error: " . curl_error($ch));
                throw new Exception("Lỗi kết nối: " . curl_error($ch));
            }
            
            curl_close($ch);
            
            $jsonResult = json_decode($result, true);
            writeLog("MOMO Response: " . print_r($jsonResult, true));

            if (isset($jsonResult['payUrl'])) {
                writeLog("Redirecting to MOMO payment URL: " . $jsonResult['payUrl']);
                header('Location: ' . $jsonResult['payUrl']);
                exit;
            } else {
                writeLog("Error response from MOMO: " . print_r($jsonResult, true));
                throw new Exception("Lỗi kết nối với MOMO: " . ($jsonResult['message'] ?? 'Unknown error'));
            }
        } else {
            writeLog("Failed to save order");
            throw new Exception("Failed to save order");
        }

    } catch (Exception $e) {
        writeLog("Error: " . $e->getMessage());
        writeLog("Stack trace: " . $e->getTraceAsString());
        $_SESSION['payment_status'] = 'error';
        $_SESSION['payment_message'] = 'Lỗi thanh toán: ' . $e->getMessage();
        header('Location: ../index.php?act=pay');
        exit;
    }
} else {
    writeLog("No MOMO POST data received");
}
?>