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
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="libs/toastr/build/toastr.min.css" rel="stylesheet">
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
        <?php
        require_once 'layout/sidebar.php';
        ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->



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
                        <h4 class="page-title">Đơn hàng </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Đơn hàng </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Danh sách đơn hàng </h1>
                </div>


                <div class="card shadow mb-4">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <form method="GET" class="mb-4">
                                    <input type="hidden" name="act" value="listBill">

                                    <div class="form-group row align-items-center mb-3">
                                        <div class="col-auto">
                                            <label for="status" class="col-form-label fw-semibold">Lọc theo trạng
                                                thái:</label>
                                        </div>
                                        <div class="col-auto">
                                            <select name="status" id="status" class="form-select">
                                                <option value="">Tất cả</option>
                                                <option value="0"
                                                    <?= (isset($_GET['status']) && $_GET['status'] == 0) ? 'selected' : '' ?>>
                                                    Chờ xác nhận</option>
                                                <option value="1"
                                                    <?= (isset($_GET['status']) && $_GET['status'] == 1) ? 'selected' : '' ?>>
                                                    Đã xác nhận</option>
                                                <option value="2"
                                                    <?= (isset($_GET['status']) && $_GET['status'] == 2) ? 'selected' : '' ?>>
                                                    Chờ lấy hàng</option>
                                                <option value="3"
                                                    <?= (isset($_GET['status']) && $_GET['status'] == 3) ? 'selected' : '' ?>>
                                                    Đang vận chuyển</option>
                                                <option value="4"
                                                    <?= (isset($_GET['status']) && $_GET['status'] == 4) ? 'selected' : '' ?>>
                                                    Đang hoàn trả hàng</option>
                                                <option value="5"
                                                    <?= (isset($_GET['status']) && $_GET['status'] == 5) ? 'selected' : '' ?>>
                                                    Giao hàng thành công</option>
                                                <option value="6"
                                                    <?= (isset($_GET['status']) && $_GET['status'] == 6) ? 'selected' : '' ?>>
                                                    Đã hủy</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary px-4 ">Lọc</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên người nhận </th>
                                    <th>Số điện thoại người nhận </th>
                                    <th>Địa chỉ người nhận </th>
                                    <th>Ngày mua </th>
                                    <th>Trạng thái đơn hàng </th>
                                    <th>Thao tác </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($bills as $bill) {
                                ?>
                                <tr>
                                    <td><?= $bill['id_bill'] ?></td>
                                    <td><?= $bill['receiver_name'] ?></td>
                                    <td><?= $bill['receiver_phone'] ?></td>
                                    <td><?= $bill['receiver_address'] ?></td>
                                    <td><?= $bill['purchase_date'] ?></td>
                                    <td><?= getOderStatus($bill['status']) ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="?act=updateBill&id=<?= $bill['id_bill'] ?>"
                                            role="button">Xem chi tiết</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
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
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->

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
    <script src="libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="libs/toastr/build/toastr.min.js"></script>
    <script>
    $(function() {
        // Success Type
        $('#ts-success').on('click', function() {
            toastr.success('Have fun storming the castle!', 'Miracle Max Says');
        });

        // Success Type
        $('#ts-info').on('click', function() {
            toastr.info('We do have the Kapua suite available.', 'Turtle Bay Resort');
        });

        // Success Type
        $('#ts-warning').on('click', function() {
            toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!');
        });

        // Success Type
        $('#ts-error').on('click', function() {
            toastr.error('I do not think that word means what you think it means.', 'Inconceivable!');
        });
    });
    </script>
</body>

</html>