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
        require_once 'view/home.php';
    }
}
