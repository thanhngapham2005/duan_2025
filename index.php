<?php
session_start();
if (isset($_SESSION['Message'])) {
    $successMessage = $_SESSION['Message'];
    unset($_SESSION['Message']);
    echo "<script>alert('$successMessage');</script>";
}
if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Xóa thông báo sau khi hiển thị
}

require_once 'controller/shopController.php';
require_once 'controller/loginController.php';
require_once 'controller/homeController.php';
require_once 'controller/registerController.php';
require_once 'controller/profileController.php';
require_once 'controller/logoutController.php';
require_once 'model/homeModel.php';
require_once 'model/userModel.php';
require_once 'model/orderModel.php';
require_once 'commoms/function.php';
require_once 'view/shop.php';
require_once 'model/shopModel.php';

$act = $_GET['act'] ?? '/';
match ($act) {
    '/' => (new HomeController())->home(),
    'login' => (new LoginController())->login(),
    'register' => (new RegisterController())->register(),
    'logout' => (new LogoutController())->logout(),
    'profile' => (new ProfileController())->profile(),
    'updateProfile' => (new ProfileController())->updateProfile(),
    'shop' => (new shopController())->showShop(),
    // 'shop_cat' => (new shopController())->cat_pro($_GET['id']),
    // 'order' => (new OrderController())->order(),
    default => (new HomeController())->home(),
};