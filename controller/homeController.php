<?php
class homeController
{
    public $homeModel;
    function __construct()
    {
        $this->homeModel = new homeModel();
    }
    function home()
    {
        // Lấy sản phẩm nổi bật
        $topPro = $this->homeModel->topProduct();
        
        // Thêm code để lấy sản phẩm mới nhất
        $newestProducts = $this->homeModel->getNewestProducts();
        
        // Xóa đoạn code này để không gán $newestProducts = $topPro
        // if (empty($newestProducts)) {
        //     $newestProducts = $topPro;
        // }
        
        // Các biến khác nếu có
        $product = $this->homeModel->getProductNames();
        
        require_once 'view/home.php';
    }
}
