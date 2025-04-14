<?php
class billController{
    public $billModel;

    public function __construct(){

        $this->billModel = new billModel();
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
        require_once "../commoms/function.php";
        require_once "view/updateBill.php";
        if (isset($_POST['btn_update'])) {
            $newStatus = $_POST['status'];//Lay trang thai moi tu form
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

