<?php
require_once 'layout/header.php';
require_once 'layout/css.php';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="extra-libs/calendar/calendar.css" rel="stylesheet" />
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <?php
        require_once 'layout/sidebar.php';
        ?>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">San pham</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">San pham</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
            <div class="container-fluid mt-4">
                <h1 class="h3 mb-2 text-gray-800">Danh sách sản phẩm</h1>
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Bảng sản phẩm</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                <form method="GET" action="index.php" class="mb-3">
    <input type="hidden" name="act" value="listthongkesl">
    <div class="row g-2 align-items-center">
        <div class="col-auto">
            <label for="category" class="col-form-label">Lọc theo danh mục:</label>
        </div>
        <div class="col-auto">
            <select id="category" name="category" class="form-select">
                <option value="">Tất cả</option>
                <?php foreach ($category as $cat) : ?>
                    <option value="<?= $cat['id_category'] ?>"
                        <?= isset($_GET['category']) && $_GET['category'] == $cat['id_category'] ? 'selected' : '' ?>>
                        <?= $cat['name_cat'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Lọc</button>
        </div>
    </div>
</form>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Mã SP</th>
                                                <th>Ảnh</th>
                                                <th>Tên</th>
                                                <th>Hãng</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Mô tả</th>
                                                <th>Danh mục</th>
                                                <th>Lượt xem</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $value['id_product'] ?></td>
                                                    <td><img src="images/<?= $value['img_product'] ?>"
                                                            class="img-fluid rounded" alt="" width="80px" height="80px" />
                                                    </td>
                                                    <td><?= $value['name'] ?></td>
                                                    <td><?= $value['firms'] ?></td>
                                                    <td><?= number_format($value['price']) ?>đ</td>
                                                    <td><?= $value['amount'] ?></td>
                                                    <td
                                                        style="max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        <?= $value['description'] ?></td>
                                                    <td><?= $value['name_cat'] ?></td>
                                                    <td><?= $value['view'] ?></td>
                                                    <td><?= ($value['censorship'] == 0) ? '<span class="badge badge-success">Đang hiện</span>' : '<span class="badge badge-danger">Đã ẩn</span>' ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm"
                                                            href="?act=listProduct_variant&id=<?= $value['id_product'] ?>">Biến
                                                            thể</a>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="?act=updateProduct&id=<?= $value['id_product'] ?>">Sửa</a>
                                                        <!-- <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn có muốn xóa không?')" href="?act=deleteProduct&id=<?= $value['id_product'] ?>">Xóa</a> -->
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <!-- <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer> -->
                <?php
                require_once 'layout/footer.php';
                require_once 'layout/scripts.php';
                ?>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
                
            </div>
            <!-- ============================================================== -->

            <!-- End Page wrapper  -->

            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->


</body>

</html>