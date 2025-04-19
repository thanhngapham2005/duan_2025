
<?php
// Xác định trang hiện tại dựa trên tham số 'act' trong URL
$current_page = isset($_GET['act']) ? $_GET['act'] : 'home';
?>

<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="./">
            Inno
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between"

            id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">

                        <a class="nav-link <?= ($current_page == 'home' || $current_page == '') ? 'active text-primary fw-bold' : '' ?>"
                            href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= ($current_page == 'shop') ? 'active text-primary fw-bold' : '' ?>" 
                           href="?act=shop" 
                           role="button" 
                           data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            Sản phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?act=shop">Tất cả sản phẩm</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <?php 
                            // Kiểm tra biến $categories có tồn tại không
                            if(isset($categories) && is_array($categories)) {
                                foreach($categories as $cat) {
                                    echo '<li><a class="dropdown-item" href="?act=shop&id_category='.$cat['id_category'].'">'.$cat['name_cat'].'</a></li>';
                                }
                            } else {
                                // Nếu không có biến $categories, thử lấy từ model
                                try {
                                    require_once 'd:/laragon/www/duan/duan_2025/model/shopModel.php';
                                    $model = new shopModel();
                                    $cats = $model->allCategory();
                                    foreach($cats as $cat) {
                                        echo '<li><a class="dropdown-item" href="?act=shop&id_category='.$cat['id_category'].'">'.$cat['name_cat'].'</a></li>';
                                    }
                                } catch (Exception $e) {
                                    echo '<li><a class="dropdown-item" href="?act=shop">Không thể tải danh mục</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($current_page == 'about') ? 'active text-primary fw-bold' : '' ?>"
                            href="?act=about">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_page == 'contact') ? 'active text-primary fw-bold' : '' ?>"
                            href="?act=contact">Liên hệ</a>

                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                        <div class="input-group-text">
                            <i class="fa fa-fw fa-search"></i>
                        </div>
                    </div>

                </div>
                <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal"
                    data-bs-target="#templatemo_search">
                    <i class="fa fa-fw fa-search text-dark mr-2"></i>
                </a>
                <?php
                    // Giả sử bạn lưu giỏ hàng trong session
                    $cartCount = isset($_SESSION['mycart']) ? count($_SESSION['mycart']) : 0;

                ?>
                <a class="nav-icon position-relative text-decoration-none" href="?act=cart">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">
                        <?= $cartCount ?>
                    </span>
                </a>

                <?php if (isset($_SESSION['user'])) : ?>
                <div class="dropdown">
                    <a href="#" class="drop-toggle text-decoration-none" role="button" data-bs-toggle="dropdown">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <?php echo isset($_SESSION['user']['customer_info']['full_name'])
                                ? $_SESSION['user']['customer_info']['full_name']
                                : 'Tài khoản'; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?act=profile">Hồ sơ</a></li>
                        <li><a class="dropdown-item" href="?act=order">Đơn hàng</a></li>
                        <?php if ($_SESSION['user']['role'] == 2) : ?>
                        <li><a class="dropdown-item" href="./admin/">Quản trị</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="?act=logout">Đăng xuất</a></li>
                    </ul>
                </div>
                <?php else : ?>
                <a class="nav-icon position-relative text-decoration-none" href="?act=login">
                    <i class="fa fa-fw fa-user text-dark mr-3"></i>
                </a>
                <?php endif; ?>
            </div>
        </div>


    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

