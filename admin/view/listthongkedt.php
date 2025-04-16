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
                        <h4 class="page-title">Thống kê doanh thu </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Thống kê doanh thu  </li>
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
            <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Thống kê doanh thu </h1>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tên </th>
                                    <th>Tổng doanh thu</th>
                                    <th>Doanh thu theo ngày </th>
                                    <th>Doanh thu theo tuần </th>
                                    <th>Doanh thu theo tháng </th>
                                    <th>Doanh thu theo năm </th>



                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($thongkedt as $key => $value){
                                    $daily_revenue = $value['total_revenue'] / 365; // doanh thu ngay
                                    $weekly_revenue = $daily_revenue * 7; // doanh thu tuan
                                    $monthly_revenue = $daily_revenue * 30; // doanh thu thang
                                    $yearly_revenue = $value['total_revenue']; // doanh thu nawm
                                    ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $value['name_cat']; ?></td>
                                            <td><?php echo number_format($value['total_revenue'], 0, ',', '.'); ?> VND</td>
                                            <td><?php echo number_format($daily_revenue, 0, ',', '.'); ?> VND</td>
                                            <td><?php echo number_format($weekly_revenue, 0, ',', '.'); ?> VND</td>
                                            <td><?php echo number_format($monthly_revenue, 0, ',', '.'); ?> VND</td>
                                            <td><?php echo number_format($yearly_revenue, 0, ',', '.'); ?> VND</td>
                                        </tr>
                                    <?php

                                }
                                ?>
                            </tbody>

                        </table>
                                    <div class="input_button">
                                        <a href="index.php?act=bieudodt"><input type="button" class="btn btn-success" value="Xem biểu đồ "></a>

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


