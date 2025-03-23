<?php
ob_start();
session_start();
require_once __DIR__ . '/../commoms/function.php';
require_once __DIR__ . '/controller/userController.php';
require_once __DIR__ . '/controller/trangchu.php';
require_once __DIR__ . '/controller/productcontroller.php';
require_once __DIR__ . '/controller/categoriesController.php';
require_once __DIR__ . '/controller/variantcontroller.php';
require_once __DIR__ . '/model/variantmodel.php';
require_once __DIR__ . '/model/userModel.php';
require_once __DIR__ . '/model/categoriesModel.php';
require_once __DIR__ . '/model/productmodel.php';
// abcgit add
$act = $_GET['act'] ?? '/';
$id_user = $_GET['id_user'] ?? null;
$id_category = $_GET['id_category'] ?? null;
match ($act) {
    '/' => (new trang_chu())->trang_chu(),
    'listProduct' => (new productController())->listProduct(),
    'insertProduct' => (new productController())->insert(),
    'updateProduct' => (new productController())->update($_GET['id']),
    'deleteProduct' => (new productController())->delete($_GET['id']),
    'listProduct_variant' => (new productController())->listProduct_variant($_GET['id']),
    'updateProduct_variant' => (new productController())->updateProduct_variant($_GET['id_pro'], $_GET['id_var']),
    'deleteProduct_variant' => (new productController())->deleteProduct_variant($_GET['id_pro'], $_GET['id_var']),
    // 'listvariant' => (new variantController())->listvariant(),
    // 'updatevariant' => (new variantController())->update($id_variant),
    // 'deletevariant' => (new variantController())->delete($id_variant),
    'listUser' => (new UserController())->listUsers(),
    'addUser' => (new UserController())->addUser(),
    'insertUser' => (new UserController())->insertUser(),
    'deleteUser' => (new UserController())->deleteUser($id_user),
    'addCategories' => (new categoriesController())->insert(),
    'listCategories' => (new categoriesController())->listcategories(),
    default => throw new Exception("No matching action found for '$act'"),
};

ob_end_flush();
