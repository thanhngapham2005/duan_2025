<?php
class variantController{
    public $variantModel;
    function __construct(){
        $this->variantModel = new variantModel();
    }
    function listvariant(){
        $variants = $this->variantModel->loadall_variant();
        require_once "view/listvariant.php";
    }
    function insert(){
        require_once "view/addvariant.php";
        if(isset($_POST['themmoi']) && $_POST['themmoi']){
            $tenloai = $_POST['tenloai'];
            $dungluong = $_POST['dungluong'];
            if($this->variantModel->check_variant_exists($tenloai, $dungluong)){
                echo "<p style='color:red;'>Biến thể đã tồn tại!</p>";
            }else{
                if($this->variantModel->insert_variant($tenloai, $dungluong)){
                    echo "<p style='color:green;'>Thêm biến thể thành công!</p>";
                }
            }
        }
    }
    function update($id_variant){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $tenloai = $_POST['tenloai'];
            $dungluong = $_POST['dungluong'];
            $this->variantModel->update_variant($id_variant, $tenloai, $dungluong);
            header("Location: index.php?act=listvariant");
            exit;
        }
        $variant = $this->variantModel->loadone_variant($id_variant);
        $name_color = $variant['name_color'] ?? '';
        $name_capacity = $variant['name_capacity'] ?? '';
        
        require_once "view/updatevariant.php";
    }
    function delete($id_variant) {
        $result = $this->variantModel->delete_variant($id_variant);
        if ($result === true) {
            header("Location: index.php?act=listvariant");
            exit();
        } else {
            echo "<p style='color:red;'>$result</p>";
        }
    }
    
}