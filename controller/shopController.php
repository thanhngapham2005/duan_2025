<?php
require_once __DIR__ . '/../model/shopModel.php'; // Đảm bảo đường dẫn chính xác

class ShopController
{
    private $model;

    public function __construct()
    {
        $this->model = new shopModel();
    }

    public function showShop()
    {
        $category = $this->model->allCategory(); // Lấy danh mục từ model
        // var_dump($category); // Kiểm tra dữ liệu
        // die();
        require_once __DIR__ . '/../view/shop.php';
    }
    
}

// Khởi tạo controller và gọi hàm hiển thị
$shopController = new ShopController();
$shopController->showShop();
