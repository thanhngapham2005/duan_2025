<?php
class orderController
{
    public $orderModel;
    function __construct()
    {
        $this->orderModel = new orderModel();
    }
    function order($id){
        $order = $this->orderModel->getOrdersByStatus($id);
        $orderStatus = [];
        for ($status = 0;$status <=6; $status++) {
            $orderStatus[$status] = $this->orderModel->getOrdersByStatus($id, $status);
        }
        $tabIds = [
            0 => "pending-payment",
            1 => "processing",
            2 => "awaiting-pickup",
            3 => "shipping",
            4 => "return-request",
            5 => "successful-delivery",
            6 => "cancelled"
        ];
        $tabbLabels = [
            0 => "Cho xac nhan",
            1 => "Da xac nhan",
            2 => "Cho lay hang",
            3 => "Dang van chuyen",
            4 => "Yeu cau tra hang",
            5 => "Giao hang thanh cong",
            6 => "Da huy"
        ];
        require_once __DIR__ . '/../commoms/function.php';
        require_once "view/order.php";
    }
    function orderDetail($id_bill){
        $orderDetail = $this->orderModel->getOrderDetails($id_bill);
        // if(empty($orderDetail)){
        //    echo "<script>alert('Không tìm thấy đơn hàng'); window.location.href='?act=order';</script>";
        //     exit();
            
        // }
        require_once "view/orderDetail.php";
    }
    function cancelOrder(){
        if (isset($_POST['cancel'])){
            $id_bill = $_POST['id_bill'];
            $currentStatus = $this->orderModel->getOrderStatus($id_bill);
            if (in_array($currentStatus, [0, 1])){
                $updateted = $this->orderModel->cancelOrder($id_bill);
                if ($updateted){
                    $_SESSION['Message'] = "Hủy đơn hàng thành công";
                }else{
                    $_SESSION['Message'] = "Hủy đơn hàng thất bại";
                }
            }else{
                $_SESSION['Message'] = "Không thể hủy đơn hàng này";
            }
            header('Location: ?act=oder');
        }
    }

}
