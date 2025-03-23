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

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
            id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?act=about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?act=shop">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?act=contact">Contact</a>
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
                <a class="nav-icon position-relative text-decoration-none" href="?act=cart">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    <span
                        class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">7</span>
                </a>

                <?php if (isset($_SESSION['user'])) : ?>
                <div class="dropdown">
                    <a href="" class="drop-toggle text-decoration-none" role="button" data-bs-toggle="dropdown">
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