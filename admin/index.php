<?php
ob_start();
session_start();
require_once __DIR__ . '/../commoms/function.php';
require_once __DIR__ . '/controller/userController.php';
require_once __DIR__ . '/controller/trangchu.php';
require_once __DIR__ . '/model/userModel.php';
require_once __DIR__ . '/model/categoriesModel.php';
require_once __DIR__ . '/controller/categoriesController.php';
// abcgit add
if (!isset($_SESSION['user']) || $_SESSION['role'] != 2) {
    header("Location: view/login.php"); // Đổi thành trang đăng nhập của bạn
    exit();
}
$act = $_GET['act'] ?? '/';
$id_user = $_GET['id_user'] ?? null;
$id_category = $_GET['id_category'] ?? null;
match ($act) {
    '/' => (new trang_chu())->trang_chu(),
    'listUser' => (new UserController())->listUsers(),
    'addUser' => (new UserController())->addUser(),
    'editUser' => (new UserController())->editUser($id_user),
    'updateUser' => (new UserController())->updateUser($id_user),
    'showUser' => (new UserController())->showUser($id_user),
    'insertUser' => (new UserController())->insertUser(),
    'deleteUser' => (new UserController())->deleteUser($id_user),
    'addCategories' => (new categoriesController())->insert(),
    'listCategories' => (new categoriesController())->listcategories(),
    'deleteCategories' => (new categoriesController())->delete($id_category),
    'updateCategories' => (new categoriesController())->update($id_category),
    'logout' => (new UserController())->logout(),


    default => throw new Exception("No matching action found for '$act'"),
};

ob_end_flush();
