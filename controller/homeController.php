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
        $topPro = $this->homeModel->topProduct();
        $newestProducts = $this->homeModel->getNewestProducts();
        $product = $this->homeModel->getProductNames();
        
        // Xử lý tìm kiếm
        $searchResults = [];
        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
        if (!empty($keyword)) {
            $searchResults = $this->homeModel->searchProducts($keyword);
        }
        
        require_once 'view/home.php';
    }
}
