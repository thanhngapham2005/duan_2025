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
        require_once "../commoms/function.php";
        require_once "view/order.php";
    }
}
