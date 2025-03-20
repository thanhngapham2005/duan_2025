<?php
require_once "model/categoriesModel.php";

class categoriesController 
{
    public $categoriesModel;
    public function __construct()
    {
        $this->categoriesModel = new categoriesModel();
    }
    public function listcategories(){
        $categoriess = $this->categoriesModel->loadall_categories();
        require_once "view/listCategories.php";
    }
    public function insert(){
        require_once "view/addCategories.php";
        
        if(isset($_POST['themmoi'])&& $_POST['themmoi']){
            $tenloai = $_POST['tenloai'];
            if($this->categoriesModel->check_categories_exists($tenloai)){
                echo "<p style='color:red;'>Bien the da ton tai!</p>";

            }else{
                if($this->categoriesModel->insert_categories($tenloai)){
                    echo "<p style='color:green;'>Them moi bien the thanh cong!</p>";
            }
        }
    }
    }
}

