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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
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
                        <h4 class="page-title">Bien the</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bien the</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">DANH SÁCH BIẾN THỂ</h1>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>MÃ LOẠI</th>
                                        <th>TÊN LOẠI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($variants as $variant) {
                                        extract($variant);
                                        $suabt = "index.php?act=updatevariant&id_variant=" . $id_variant;
                                        $xoabt = "index.php?act=deletevariant&id_variant=" . $id_variant;
                                        echo '
                                            <tr>
                                                <td><input type="checkbox" name="chk" id=""></td>
                                                <td>' . $id_variant . '</td> <!-- hien thi id-->
                                                <td>' . $name_color . '</td>  <!-- hien thi ten loai-->
                                                <td><a href="' . $suabt . '"><input class="btn btn-primary" type="button" value="Sửa"></a> <a href="' . $xoabt . '"><input class="btn btn-danger" type="button" value="Xóa"></a></td>
                                            </tr>
                                            ';
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <div class="input_button">
                                <input type="button" onclick="selects()" class="btn btn-info" value="Chọn tất cả">
                                <input type="button" onclick="deSelect()" class="btn btn-info" value="Bỏ chọn tất cả">
                                <input type="button" value="Xoá các mục đã chọn" class="btn btn-danger">
                                <a href="index.php?act=addvariant"><input type="button" class="btn btn-success"
                                        value="Nhập thêm"></a>

                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                function selects() {
                    var ele = document.getElementsByName('chk');
                    for (var i = 0; i < ele.length; i++) {
                        if (ele[i].type == 'checkbox') {
                            ele[i].checked = true;
                        }
                    }

                    function deSelect() {
                        var ele = document.getElementsByName('chk');
                        for (var i = 0; i < ele.length; i++) {
                            if (ele[i].type == 'checkbox')
                                ele[i].checked = false;
                        }
                    }
                }
                </script>
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
        <!-- </div> -> -->
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