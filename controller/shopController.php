<?php

require_once __DIR__ . '/../model/shopModel.php'; // Đảm bảo đường dẫn chính xác  

class ShopController
{
    private $model;

    public function __construct()
    {
        $this->model = new shopModel();
    }

    public function showShop(){
        $categories = $this->model->allCategory(); 
        
        if (isset($_GET['id_category']) && is_numeric($_GET['id_category'])) {
            $id_category = $_GET['id_category'];
            $product = $this->model->cat_pro($id_category);  // Lọc theo danh mục
            $category_name = $this->model->getCategoryName($id_category);
        } else {
            $product = $this->model->allProduct();  // Lấy tất cả sản phẩm
            $category_name = "Tất cả sản phẩm";
        }
        
        require_once 'view/shop.php'; 
    }
}

