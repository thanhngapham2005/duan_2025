<?php
session_start();


// Require các file cần thiết
require_once 'commoms/function.php';

require_once 'controller/homeController.php';
require_once 'controller/aboutController.php';
require_once 'controller/contactController.php';
require_once 'controller/loginController.php';
require_once 'controller/registerController.php';
require_once 'controller/profileController.php';
require_once 'controller/logoutController.php';
require_once 'controller/shopController.php';
require_once 'controller/shop-singleController.php';
// require_once 'controller/orderController.php';

require_once 'model/homeModel.php';
require_once 'model/userModel.php';
require_once 'model/orderModel.php';
require_once 'model/shop-singleModel.php';
require_once 'model/shopModel.php';
$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => (new HomeController())->home(),
    'about' => (new AboutController())->about(),
    'contact' => (new ContactController())->contact(),
    'login' => (new LoginController())->login(),
    'register' => (new RegisterController())->register(),
    'logout' => (new LogoutController())->logout(),
    'profile' => (new ProfileController())->profile(),
    'updateProfile' => (new ProfileController())->updateProfile(),

    'shop' => (new ShopController())->showShop(),
    'shop_single' => (new detailController())->detail($_GET['id']),
    'addToCart' => (new cartController())->addToCart(),
    'deleteToCart' => (new cartController())->deleteToCart(),
    // 'order' => (new OrderController())->order(),
    'addComment' => (new detailController())->addComment(),
    default => (new HomeController())->home(),
};


if ($act === 'shop' || $act === 'shop_cat') {
    require_once 'model/shopModel.php';
    require_once 'view/shop.php';
}
