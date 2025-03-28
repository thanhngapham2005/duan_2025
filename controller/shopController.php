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
        require_once 'view/shop.php'; // ✅ Chỉ gọi khi được gọi từ index.php
    }
}