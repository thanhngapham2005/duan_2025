<?php
class payController{
    public $payModel;
    public function __construct(){
        $this->payModel = new payModel();
    }
    function pay(){
        if (isset($_SESSION['user']['customer_info']['id_customer'])) {
            $id_customer = $_SESSION['user']['customer_info']['id_customer'];
        } else {
            $_SESSION['payment_status'] = 'error';
            $_SESSION['payment_message'] = 'Không tìm thấy thông tin khách hàng!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        
        // Lấy danh sách mã giảm giá có sẵn
        $discountCodes = $this->payModel->getAvailableDiscountCodes($id_customer);
        
        require_once 'view/pay.php';
    }
    
    function payment(){
        if(isset($_POST['order_cart'])){
            if(!empty($_SESSION['mycart'])){
                $receiver_name = $_POST['receiver_name'];
                $receiver_phone = $_POST['receiver_phone'];
                $receiver_address= $_POST['receiver_address'];
                $id_customer = $_SESSION['user']['customer_info']['id_customer'];
                
                // Lấy mã giảm giá nếu có
                $discount_code = isset($_POST['discount_code']) ? $_POST['discount_code'] : null;

                $cartItems = $_SESSION['mycart'];

                $result = $this->payModel->saveOrder($id_customer, $receiver_name, $receiver_phone, $receiver_address, $cartItems, $discount_code); 
                if($result){
                    $_SESSION['payment_status'] = 'success';
                    $_SESSION['payment_message'] = 'Thanh toán thành công!';
                    unset($_SESSION['mycart']);
                }
                
            }else{
                $_SESSION['payment_status'] = 'error';
                $_SESSION['payment_message'] = 'Giỏ hàng của bạn hiện đang trống!';
            }
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    
    // Thêm phương thức kiểm tra mã giảm giá qua AJAX
    function checkDiscountCode() {
        header('Content-Type: application/json');
        
        if(isset($_POST['discount_code']) && !empty($_POST['discount_code'])) {
            $code = $_POST['discount_code'];
            $total = isset($_POST['total']) ? floatval($_POST['total']) : 0;
            
            $discountInfo = $this->payModel->getDiscountInfo($code);
            
            if($discountInfo) {
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
}