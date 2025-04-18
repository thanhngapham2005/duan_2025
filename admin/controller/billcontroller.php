<?php
class billController{
    public $billModel;
    public $discountModel;
    

    public function __construct(){

        $this->billModel = new billModel();
        // Nếu bạn có model discountModel, hãy bỏ comment dòng dưới
        // $this->discountModel = new discountModel();
    }
    
    function listBill(){
        $status = isset($_GET['status']) && $_GET['status'] !== '' ? $_GET['status'] : null;
        $bills = $this->billModel->bill($status);
        
        require_once '../commoms/function.php';


        require_once "view/listBill.php";
    }
    
    function updateBill($id){
        $bills = $this->billModel->bill();
        $oneBill = $this->billModel->findBillById($id);
        $status = $this->billModel->billStatus($id)['status'];
        $statusDescription = [
            0 => 'Cho xac nhan',
            1 => 'Da xac nhan',
            2 => 'Cho lay hang',
            3 => 'Dang van chuyen',
            4 => 'Dang hoan tra hang',
            5 => 'Giao hang thanh cong',


        ];
        
        // Lấy thông tin đơn hàng bao gồm mã giảm giá
        $billInfo = $this->billModel->getBillDiscountInfo($id);
        
        require_once "../commoms/function.php";
        require_once "view/updateBill.php";
        
        if (isset($_POST['btn_update'])) {
            $newStatus = $_POST['status'];
            if ($newStatus == 5 && $status !=5){
                $this->billModel->reduceQuantity($id);
            }

            if($this->billModel->updateBill($newStatus, $id)){
                header("Location: ?act=listBill");
            }else{
                echo "sua that bai";
            }
        }
    }

}



