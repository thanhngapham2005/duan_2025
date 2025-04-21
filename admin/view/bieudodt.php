<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Biểu đồ doanh thu</title>

    <?php
    require_once 'layout/css.php';
    ?>
</head>

<body>
    <?php
    require_once 'layout/header.php';
    ?>

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
                                    <li class="breadcrumb-item active" aria-current="page">Biểu đồ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div id="chart-section" class="container-fluid">
                <div id="piechart"></div>
                <div id="chart_total" style="height: 400px;"></div>
                <div id="chart_detail" style="height: 400px;"></div>
            </div>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var dataTotal = google.visualization.arrayToDataTable([
                        ['Danh mục', 'Doanh thu tổng (VND)'],
                        <?php
                        foreach ($thongkedt as $row) {
                            echo "['" . $row['name_cat'] . "', " . $row['total_revenue'] . "],";
                        }
                        ?>
                    ]);

                    var optionsTotal = {
                        title: 'Biểu đồ doanh thu tổng theo danh mục',
                        chartArea: {
                            width: '50%'
                        },
                        hAxis: {
                            title: 'Doanh thu (VND)',
                            minValue: 0
                        },
                        vAxis: {
                            title: 'Danh mục'
                        },
                        colors: ['#4CAF50']
                    };

                    var chartTotal = new google.visualization.BarChart(document.getElementById('chart_total'));
                    chartTotal.draw(dataTotal, optionsTotal);

                    var dataDetail = google.visualization.arrayToDataTable([
                        ['Danh mục', 'Ngày', 'Tuần', 'Tháng', 'Năm'],
                        <?php
                        foreach ($thongkedt as $value) {
                            $daily = round($value['total_revenue'] / 365, 2);
                            $weekly = round($daily * 7, 2);
                            $monthly = round($daily * 30, 2);
                            $yearly = $value['total_revenue'];
                            echo "['" . $value['name_cat'] . "', $daily, $weekly, $monthly, $yearly],";
                        }
                        ?>
                    ]);

                    var optionsDetail = {
                        title: 'Biểu đồ chi tiết doanh thu',
                        curveType: 'function',
                        legend: {
                            position: 'bottom'
                        },
                        colors: ['#FF5733', '#33C3FF', '#FFC300', '#4CAF50']
                    };

                    var chartDetail = new google.visualization.LineChart(document.getElementById('chart_detail'));
                    chartDetail.draw(dataDetail, optionsDetail);
                }
            </script>

            <?php require_once 'layout/footer.php'; ?>
        </div>
    </div>

    <?php require_once 'layout/scripts.php'; ?>
</body>

</html>