<?php
require_once __DIR__ . '/../model/shopModel.php'; // Đảm bảo đường dẫn chính xác

class ShopController
{
    public $shopModel;

    public function __construct()
    {
        $this->shopModel = new shopModel();
    }

    function allProduct() {
        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $search = $_POST['search']; // Lấy dữ liệu tìm kiếm từ form
            // Gọi phương thức tìm kiếm sản phẩm trong model
            $product = $this->shopModel->searchProducts($search); 
        } else {
            $product = $this->shopModel->allProduct(); // Lấy tất cả sản phẩm nếu không tìm kiếm
        }
        $category = $this->shopModel->allCategory();
        require_once 'view/shop.php';
    }
    function cat_pro($id)
    {
        if (isset($_POST['search'])) {
            $product = $this->shopModel->searchProducts($_POST['search']);
        } else {
            $product = $this->shopModel->cat_pro($id);
        }
        $category = $this->shopModel->allCategory();
        require_once 'view/shop.php';
    }
    
}


