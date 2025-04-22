<?php
class payController
{
    public $payModel;
    public function __construct()
    {
        $this->payModel = new payModel();
    }

    function pay()
    {
        if (isset($_SESSION['user']['customer_info']['id_customer'])) {
            $id_customer = $_SESSION['user']['customer_info']['id_customer'];
            // Lấy danh sách mã giảm giá có sẵn
            $discountCodes = $this->payModel->getAvailableDiscountCodes($id_customer);
            require_once 'view/pay.php';
        } else {
            $_SESSION['payment_status'] = 'error';
            $_SESSION['payment_message'] = 'Không tìm thấy thông tin khách hàng!';
            header('Location: index.php?act=login');
            exit;
        }
    }

    function payment()
    {
        if (isset($_POST['order_cart'])) {
            if (!empty($_SESSION['mycart'])) {
                try {
                    $receiver_name = $_POST['receiver_name'];
                    $receiver_phone = $_POST['receiver_phone'];
                    $receiver_address = $_POST['receiver_address'];
                    
                    // Validate dữ liệu
                    if (empty($receiver_name) || empty($receiver_phone) || empty($receiver_address)) {
                        throw new Exception('Vui lòng điền đầy đủ thông tin người nhận!');
                    }

                    $id_customer = $_SESSION['user']['customer_info']['id_customer'];
                    $discount_code = isset($_POST['discount_code']) ? $_POST['discount_code'] : null;
                    $cartItems = $_SESSION['mycart'];
                    
                    // Tính toán giảm giá và lưu đơn hàng
                    $total = array_reduce($cartItems, function($sum, $item) {
                        return $sum + ($item['price'] * $item['quantity']);
                    }, 0);

                    $discount_amount = 0;
                    if ($discount_code) {
                        $discountInfo = $this->payModel->getDiscountInfo($discount_code);
                        if ($discountInfo) {
                            $discount_percentage = $discountInfo['discount_percentage'];
                            $max_discount = $discountInfo['max_discount'] ?? PHP_INT_MAX;
                            $discount_amount = min(($total * $discount_percentage / 100), $max_discount);
                        }
                    }

                    $result = $this->payModel->saveOrder(
                        $id_customer, 
                        $receiver_name, 
                        $receiver_phone, 
                        $receiver_address, 
                        $cartItems,
                        $discount_code,
                        $discount_amount
                    );

                    if ($result) {
                        $_SESSION['payment_status'] = 'success';
                        $_SESSION['payment_message'] = 'Đặt hàng thành công!';
                        unset($_SESSION['mycart']);
                    } else {
                        throw new Exception('Có lỗi xảy ra khi xử lý đơn hàng!');
                    }

                } catch (Exception $e) {
                    $_SESSION['payment_status'] = 'error';
                    $_SESSION['payment_message'] = $e->getMessage();
                }
            } else {
                $_SESSION['payment_status'] = 'error';
                $_SESSION['payment_message'] = 'Giỏ hàng của bạn đang trống!';
            }
            
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    // Thêm phương thức kiểm tra mã giảm giá qua AJAX
    function checkDiscountCode()
    {
        header('Content-Type: application/json');

        if (isset($_POST['discount_code']) && !empty($_POST['discount_code'])) {
            $code = $_POST['discount_code'];
            $total = isset($_POST['total']) ? floatval($_POST['total']) : 0;

            $discountInfo = $this->payModel->getDiscountInfo($code);

            if ($discountInfo) {
                $discount_percentage = $discountInfo['discount_percentage'];
                // Kiểm tra xem max_discount có tồn tại không
                $max_discount = isset($discountInfo['max_discount']) ? $discountInfo['max_discount'] : PHP_INT_MAX;

                $discount_amount = min(($total * $discount_percentage / 100), $max_discount);
                $final_total = $total - $discount_amount;

                echo json_encode([
                    'status' => 'success',
                    'discount_percentage' => $discount_percentage,
                    'discount_amount' => $discount_amount,
                    'final_total' => $final_total
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Mã giảm giá không hợp lệ']);
            }
            exit;
        }

        echo json_encode(['status' => 'error', 'message' => 'Vui lòng nhập mã giảm giá']);
        exit;
    }

    function payMomo()
    {
        if (isset($_GET['resultCode'])) {
            $status = $_GET['resultCode'];
            $orderId = $_GET['orderId'] ?? null;
            $amount = $_GET['amount'] ?? null;
            $transId = $_GET['transId'] ?? null;

            if ($status == '0') { // Thanh toán thành công
                $thongTinThanhToan = [
                    'orderId' => $orderId,
                    'transId' => $transId,
                    'amount' => $amount
                ];

                // Xử lý thanh toán
                $result = $this->xuLyThanhToanMomo($orderId, $amount, $thongTinThanhToan);

                if ($result) {
                    $_SESSION['payment_status'] = 'success';
                    $_SESSION['payment_message'] = 'Thanh toán Momo thành công!';
                    unset($_SESSION['mycart']);
                } else {
                    $_SESSION['payment_status'] = 'error';
                    $_SESSION['payment_message'] = 'Có lỗi xảy ra khi xử lý thanh toán!';
                }
            } else {
                $_SESSION['payment_status'] = 'error';
                $_SESSION['payment_message'] = 'Giao dịch Momo không thành công!';
            }
        } else {
            $_SESSION['payment_status'] = 'error';
            $_SESSION['payment_message'] = 'Không nhận được kết quả từ Momo!';
        }

        header('Location: index.php?act=order');
        exit;
    }
    public function xuLyThanhToanMomo($maDonHang, $soTien, $thongTinThanhToan)
    {
        try {
            // Gọi model để lưu thông tin thanh toán
            $ketQua = $this->payModel->luuThanhToanMomo($maDonHang, $soTien, $thongTinThanhToan);

            if ($ketQua) {
                // Cập nhật trạng thái đơn hàng
                $this->payModel->capNhatTrangThaiDonHang($maDonHang, 1);
                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log("Lỗi xử lý thanh toán MOMO: " . $e->getMessage());
            return false;
        }
    }

    // Xử lý lưu đơn hàng MOMO ban đầu
    function saveMomoOrder($id_customer, $receiver_name, $receiver_phone, $receiver_address, $cartItems, $discount_code = null, $discount_amount = 0) {
        try {
            $result = $this->payModel->saveOrder(
                $id_customer,
                $receiver_name,
                $receiver_phone,
                $receiver_address,
                $cartItems,
                $discount_code,
                $discount_amount
            );
            
            if (!$result) {
                error_log("Failed to save MOMO order");
                return false;
            }
            
            return true;
        } catch (Exception $e) {
            error_log("Error in saveMomoOrder: " . $e->getMessage());
            return false;
        }
    }
}