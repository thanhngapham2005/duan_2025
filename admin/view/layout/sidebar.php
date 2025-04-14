<head>
    <!-- Thêm link thư viện FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
                        <i class="fa fa-chart-line"></i> <!-- Dashboard -->
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fa fa-list"></i> <!-- Danh mục -->
                        <span class="hide-menu">Danh mục </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="index.php?act=listCategories" class="sidebar-link"><i
<<<<<<< HEAD
                                    class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách danh mục
                                </span></a></li>
                        <li class="sidebar-item"><a href="index.php?act=addCategories" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm danh mục
                                </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span
                            class="hide-menu">Biến thể </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="?act=listvariant" class="sidebar-link"><i
                                    class="mdi mdi-emoticon"></i><span class="hide-menu"> Danh sách biến thể
                                </span></a></li>
                        <li class="sidebar-item"><a href="?act=addvariant" class="sidebar-link"><i
                                    class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Thêm biến thể mới
                                </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span
                            class="hide-menu">Sản phẩm </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="?act=listProduct" class="sidebar-link"><i
                                    class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Danh sách sản phẩm
                                </span></a></li>
                        <li class="sidebar-item"><a href="?act=insertProduct" class="sidebar-link"><i
                                    class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Thêm sản phẩm
                                </span></a></li>


                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span
                            class="hide-menu">Thống kê </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="index.php?act=listthongkedt" class="sidebar-link"><i
                                    class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Doanh thu</span></a>
=======
                                    class="fa fa-list-ul"></i><span class="hide-menu"> Danh sách danh mục </span></a>
>>>>>>> 3db58f0f826801eea62ac0eabbd48d72762824bb
                        </li>
                        <li class="sidebar-item"><a href="index.php?act=addCategories" class="sidebar-link"><i
                                    class="fa fa-plus"></i><span class="hide-menu"> Thêm danh mục </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fa fa-shapes"></i> <!-- Biến thể -->
                        <span class="hide-menu">Biến thể </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="?act=listvariant" class="sidebar-link"><i
                                    class="fa fa-cogs"></i><span class="hide-menu"> Danh sách biến thể </span></a></li>
                        <li class="sidebar-item"><a href="?act=addvariant" class="sidebar-link"><i
                                    class="fa fa-plus-circle"></i><span class="hide-menu"> Thêm biến thể mới </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fa fa-box"></i> <!-- Sản phẩm -->
                        <span class="hide-menu">Sản phẩm </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="?act=listProduct" class="sidebar-link"><i
                                    class="fa fa-box-open"></i><span class="hide-menu"> Danh sách sản phẩm </span></a>
                        </li>
                        <li class="sidebar-item"><a href="?act=insertProduct" class="sidebar-link"><i
                                    class="fa fa-plus-square"></i><span class="hide-menu"> Thêm sản phẩm </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fa fa-chart-bar"></i> <!-- Thống kê -->
                        <span class="hide-menu">Thống kê </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="index.php?act=listthongkedt" class="sidebar-link"><i
                                    class="fa fa-dollar-sign"></i><span class="hide-menu"> Doanh thu</span></a></li>
                        <li class="sidebar-item"><a href="index.php?act=listthongkesl" class="sidebar-link"><i
                                    class="fa fa-cubes"></i><span class="hide-menu"> Số lượng sản phẩm </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="?act=listBill"
                        aria-expanded="false">
                        <i class="fa fa-receipt"></i> <!-- Đơn hàng -->
                        <span class="hide-menu">Đơn hàng</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="?act=listUser"
                        aria-expanded="false">
                        <i class="fa fa-users"></i> <!-- Khách hàng -->
                        <span class="hide-menu">Khách hàng</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="?act=listComments" class="sidebar-link">
                        <i class="fa fa-comments"></i> <!-- Quản lý bình luận -->
                        <span class="hide-menu"> Quản lý bình luận </span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>