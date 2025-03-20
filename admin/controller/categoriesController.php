<?php
require_once "model/categoriesModel.php";

class categoriesController 
{
    public $categoriesModel;
     function __construct()
    {
        $this->categoriesModel = new categoriesModel();
    }
    function listcategories(){
        $categoriess = $this->categoriesModel->loadall_categories();
        require_once "view/listCategories.php";
    }
     function insert(){
        require_once "view/addCategories.php";

        if(isset($_POST['themmoi'])&& $_POST['themmoi']){
            $tenloai = $_POST['tenloai'];
            if($this->categoriesModel->check_categories_exists($tenloai)){
                echo "<p style='color:red;'>Bien the da ton tai!</p>";

            }else{
                if($this->categoriesModel->insert_categories($tenloai)){
                  
                    echo "<p style='color:green;'>Them moi bien the thanh cong!</p>";
                    header("Location: index.php?act=listCategories");
                    exit();
            }
        }
    }
 }
        function delete($id_category){
            if($id_category){
                $this->categoriesModel->delete_categories($id_category);
                header("Location: index.php?act=listCategories");
                exit();
            }else{
                echo "Khong tim thay bien the can xoa.";
            }
        }
        function update($id_category){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $tenloai = $_POST['tenloai'];


                $this->categoriesModel->update_categories($id_category, $tenloai);
                header("Location: index.php?act=listCategories");
                exit;
            }
            $stmt = $this->categoriesModel->loadone_categories($id_category);
            require_once "view/updateCategories.php";
        }
}

