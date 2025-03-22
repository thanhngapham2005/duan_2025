<?php
session_start();
if (isset($_SESSION['Message'])) {
    $successMessage = $_SESSION['Message'];
    unset($_SESSION['Message']);
    echo "<script>alert('$successMessage');</script>";
}

require_once 'controller/loginController.php';
require_once 'controller/homeController.php';
require_once 'controller/registerController.php';
require_once 'controller/logoutController.php';
require_once 'model/homeModel.php';
require_once 'model/userModel.php';
require_once 'model/orderModel.php';
require_once 'commoms/function.php';

$act = $_GET['act'] ?? '/';
match ($act) {
    '/' => (new HomeController())->home(),
    'login' => (new LoginController())->login(),
    'register' => (new RegisterController())->register(),
    'logout' => (new LogoutController())->logout(),
    'profile' => (new ProfileController())->profile(),
    'update-profile' => (new ProfileController())->updateProfile(),
    // 'order' => (new OrderController())->order(),
    default => (new HomeController())->home(),
};
