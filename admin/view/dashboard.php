<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thống kê</title>
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
                    <h4 class="page-title">Dashboard</h4>
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

        <!-- Nội dung -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Thống kê doanh thu và sản phẩm</h1>
            </div>

            <div class="row">
                <!-- Biểu đồ doanh thu tổng -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Biểu đồ doanh thu tổng theo danh mục</h6>
                        </div>
                        <div class="card-body">
                            <div id="chart_total" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ chi tiết doanh thu -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Biểu đồ chi tiết doanh thu</h6>
                        </div>
                        <div class="card-body">
                            <div id="chart_detail" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ số lượng sản phẩm -->
                <div class="col-lg-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Biểu đồ số lượng sản phẩm</h6>
                        </div>
                        <div class="card-body">
                            <div id="piechart" style="height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once 'layout/footer.php'; ?>
    </div>
</div>

<?php require_once 'layout/scripts.php'; ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        const thongkedt = <?php echo json_encode($thongkedt); ?>;
        const thongkesl = <?php echo json_encode($thongkesl); ?>;

        console.log("thongkedt", thongkedt);
        console.log("thongkesl", thongkesl);

        // Biểu đồ doanh thu tổng
        const dataTotal = new google.visualization.DataTable();
        dataTotal.addColumn('string', 'Danh mục');
        dataTotal.addColumn('number', 'Doanh thu tổng (VND)');
        thongkedt.forEach(item => {
            dataTotal.addRow([item['name_cat'], parseFloat(item['total_revenue'])]);
        });

        const optionsTotal = {
            title: 'Biểu đồ doanh thu tổng theo danh mục',
            chartArea: {width: '70%'},
            hAxis: {title: 'Doanh thu (VND)', minValue: 0},
            vAxis: {title: 'Danh mục'},
            colors: ['#4CAF50'],
        };

        const chartTotal = new google.visualization.ColumnChart(document.getElementById('chart_total'));
        chartTotal.draw(dataTotal, optionsTotal);

        // Biểu đồ chi tiết doanh thu
        const dataDetail = new google.visualization.DataTable();
        dataDetail.addColumn('string', 'Danh mục');
        dataDetail.addColumn('number', 'Doanh thu ngày');
        dataDetail.addColumn('number', 'Doanh thu tuần');
        dataDetail.addColumn('number', 'Doanh thu tháng');
        dataDetail.addColumn('number', 'Doanh thu năm');

        thongkedt.forEach(item => {
            const daily = parseFloat(item['total_revenue']) / 365;
            const weekly = daily * 7;
            const monthly = daily * 30;
            const yearly = parseFloat(item['total_revenue']);
            dataDetail.addRow([item['name_cat'], daily, weekly, monthly, yearly]);
        });

        const optionsDetail = {
            title: 'Biểu đồ chi tiết doanh thu',
            curveType: 'function',
            legend: {position: 'bottom'},
            colors: ['#FF5733', '#33C3FF', '#FFC300', '#4CAF50'],
        };

        const chartDetail = new google.visualization.LineChart(document.getElementById('chart_detail'));
        chartDetail.draw(dataDetail, optionsDetail);

        // Biểu đồ số lượng sản phẩm
        const dataQuantity = new google.visualization.DataTable();
        dataQuantity.addColumn('string', 'Danh mục');
        dataQuantity.addColumn('number', 'Số lượng sản phẩm');
        dataQuantity.addColumn('number', 'Số lượng đã bán');

        thongkesl.forEach(item => {
            dataQuantity.addRow([item['name_cat'], parseInt(item['total_quantity']), parseInt(item['sold_quantity'])]);
        });

        const optionsQuantity = {
            title: 'Số lượng sản phẩm theo danh mục',
            chartArea: {width: '40%'},
            height: 500,
            hAxis: {
                title: 'Số lượng sản phẩm',
                minValue: 0,
                textStyle: {color: '#3e3e3e', fontSize: 14}
            },
            vAxis: {
                title: 'Danh mục',
                textStyle: {color: '#3e3e3e', fontSize: 14},
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
            bar: {groupWidth: '75%'},
            legend: {position: 'top', alignment: 'end'}
        };

        const chartQuantity = new google.visualization.ColumnChart(document.getElementById('piechart'));
        chartQuantity.draw(dataQuantity, optionsQuantity);
    }
</script>
</body>

</html>
