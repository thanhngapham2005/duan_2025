<?php
class discountController{
    public $discountModel;

    public function __construct()
    {
        $this->discountModel = new discountModel();
    }
    function listDiscount(){
        $status = isset($_GET['status']) && $_GET['status'] !== '' ? $_GET['status'] : null;
        $discounts = $this->discountModel->getAll($status);
        require_once "../commoms/function.php";
        require_once "view/listDiscount.php";
    }
    function addDiscount() {
        if(isset($_POST['btn_add'])) {
            $now = date("Y-m-d H:i:s");
            $data = [
                'code' => $_POST['code'],
                'discount_percentage' => $_POST['discount_percentage'],
                'max_discount' => $_POST['max_discount'],
                'min_order_value' => $_POST['min_order_value'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'usage_limit' => $_POST['usage_limit'],
                'used_count' => 0, 
                'status' => $_POST['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
            if($this->discountModel->create($data)) {
                $_SESSION['success'] = "Thêm mã giảm giá thành công!";
                header("Location: ?act=listDiscount");
                exit;
            } else {
                $_SESSION['error'] = "Thêm thất bại";
            }
        }
        require_once "view/addDiscount.php";
    }
    
    function editDiscount($id){
        $discount = $this->discountModel->findById($id);
        if(isset($_POST['btn_update'])){
            $now = date("Y-m-d H:i:s");
            $data = [
                'code' => $_POST['code'],
                'discount_percentage' => $_POST['discount_percentage'],
                'max_discount' => $_POST['max_discount'],
                'min_order_value' => $_POST['min_order_value'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'usage_limit' => $_POST['usage_limit'],
                'used_count' => $discount['used_count'], 
                'status' => $_POST['status'],
                'updated_at' => $now
            ];
            if($this->discountModel->update($id, $data)){
                header("Location: ?act=listDiscount");
            }else{
                echo "Cập nhật thất bại";
            }
        }
        require_once "view/editDiscount.php";
    }
    function deleteDiscount($id){
        if($this->discountModel->delete($id)){
            header("Location: ?act=listDiscount");
        }else{
            echo "Xoá thất bại";
        }
    }
}