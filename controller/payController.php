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
        require_once 'view/pay.php';
    }
    function payment(){
        if(isset($_POST['order_cart'])){
            if(!empty($_SESSION['mycart'])){
                $receiver_name = $_POST['receiver_name'];
                $receiver_phone = $_POST['receiver_phone'];
                $receiver_address= $_POST['receiver_address'];
                $id_customer = $_SESSION['user']['customer_info']['id_customer'];

                $cartItems = $_SESSION['mycart'];

                $result = $this->payModel->saveOrder($id_customer, $receiver_name, $receiver_phone, $receiver_address, $cartItems); 
                if($result){
                    $_SESSION['payment_status'] = 'success';
                    $_SESSION['payment_message'] = 'Thanh toan thanh cong!';
                    unset($_SESSION['mycart']);
                }
                

        }else{
            $_SESSION['payment_status'] = 'error';
            $_SESSION['payment_message'] = 'Giỏ hàng của ban hien dang trong!';
        
        }
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
}
}