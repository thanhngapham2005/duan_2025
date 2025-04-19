<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thống kê sản phẩm</title>

    <?php require_once 'layout/css.php'; ?>
</head>

<body>
    <?php require_once 'layout/header.php'; ?>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <?php require_once 'layout/sidebar.php'; ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Code chức năng -->
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Thống kê số lượng sản phẩm</h1>
                <h1 class="h3 mb-2 text-gray-800">Biểu đồ</h1>
                <div id="piechart" style="height: 500px;"></div>
            </div>

            <!-- Biểu đồ Google Chart -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {
                    packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Danh mục', 'Số lượng sản phẩm', 'Số lượng đã bán'],
                        <?php
                        foreach ($thongkesl as $key => $value) {
                            echo "['{$value['name_cat']}', {$value['total_quantity']}, {$value['sold_quantity']}]";
                            if ($key < count($thongkesl) - 1) echo ",";
                        }
                        ?>
                    ]);

                    var options = {
                        title: 'Số lượng sản phẩm theo danh mục',
                        chartArea: {
                            width: '40%'
                        },
                        height: 500,
                        hAxis: {
                            title: 'Số lượng sản phẩm',
                            minValue: 0,
                            textStyle: {
                                color: '#3e3e3e',
                                fontSize: 14
                            }
                        },
                        vAxis: {
                            title: 'Danh mục',
                            textStyle: {
                                color: '#3e3e3e',
                                fontSize: 14
                            },
                            slantedText: true,
                            slantedTextAngle: 0
                        },
                        colors: ['#4CAF50', '#FF9800'],
                        backgroundColor: '#f4f4f4',
                        is3D: true,
                        animation: {
                            startup: true,
                            duration: 1000,
                            easing: 'out'
                        },
                        bar: {
                            groupWidth: '75%'
                        },
                        legend: {
                            position: 'top',
                            alignment: 'end'
                        }
                    };

                    var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
            </script>
            <!-- End code chức năng -->

            <?php require_once 'layout/footer.php'; ?>
        </div> <!-- end page-wrapper -->
    </div> <!-- end main-wrapper -->

    <?php require_once 'layout/scripts.php'; ?>
</body>

</html>