<?php
session_start();
if (isset($_SESSION['Message'])) {
    $successMessage = $_SESSION['Message'];
    unset($_SESSION['Message']);
    echo "<script>alert('$successMessage');</script>";
}

// Require các file cần thiết
require_once 'commoms/function.php';
require_once 'controller/cartController.php';
require_once 'controller/homeController.php';
require_once 'controller/aboutController.php';
require_once 'controller/contactController.php';
require_once 'controller/loginController.php';
require_once 'controller/registerController.php';
require_once 'controller/profileController.php';
require_once 'controller/logoutController.php';
require_once 'controller/shopController.php';
require_once 'controller/shop-singleController.php';
require_once 'controller/orderController.php';
require_once 'controller/payController.php';

// require_once 'controller/orderController.php';
require_once 'model/cartModel.php';
require_once 'model/homeModel.php';
require_once 'model/userModel.php';
require_once 'model/orderModel.php';
require_once 'model/shop-singleModel.php';
require_once 'model/shopModel.php';
require_once 'model/orderModel.php';
require_once 'model/payModel.php';
require_once 'model/orderModel.php';
$act = $_GET['act'] ?? '/';

if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];

match ($act) {
    '/' => (new HomeController())->home(),
    'about' => (new AboutController())->about(),
    'contact' => (new ContactController())->contact(),
    'login' => (new LoginController())->login(),
    'register' => (new RegisterController())->register(),
    'logout' => (new LogoutController())->logout(),
    'profile' => (new ProfileController())->profile(),
    'updateProfile' => (new ProfileController())->updateProfile(),
    'addToCart' => (new cartController())->addToCart(),
    'deleteToCart' => (new cartController())->deleteToCart(),
    'shop' => (new ShopController())->showShop(),
    'shop_single' => (new detailController())->detail($_GET['id']),
    'cart' => (new cartController())->cart(),
    'pay' => (new payController())->pay(),
    'payment' => (new payController())->payment(),
    'orderDetail' => (new orderController())->orderDetail($_GET['id']),
    'cancelOrder' => (new orderController())->cancelOrder(),
    'order' => (new orderController())->order($_SESSION['user']['customer_info']['id_customer']),
    // 'order' => (new OrderController())->order(),
    'addComment' => (new detailController())->addComment(),
    default => (new HomeController())->home(),
};


if ($act === 'shop' || $act === 'shop_cat') {
    require_once 'model/shopModel.php';
    require_once 'view/shop.php';
}
