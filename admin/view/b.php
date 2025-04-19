<div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Thong ke so luong san pham</h1>
            <div class="row">
                <div class="container-fluid">

                <h1 class="h3 mb-2 text-gray-800">Bieu do</h1>
                <div id="piechart"></div>
                </div>

            </div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
               <script type="text/javascript">
                google.chart.load('current',{'packages':['corechart', 'bar']});
                google.charts.setOnLoadCallback(drawStuff);

                function drawStuff() {
                    var data = google.visualization.arrayToDataTable([
                        ['Danh muc','So luong san pham','So luong da ban'],
                        <?php
                        foreach($thongkesl as $key => $value){
                            echo "['".$value['name_cat']."',".$value['total_quantity'].",".$value['sold_quantity']."],";
                            if ($key < count($thongkesl)-1) echo ",";
                        }
                        ?>
                    ]);
                    var options = {
                        title: 'So luong san pham theo danh muc',
                        chartArea: {width: '40%'},
                        height: 500,
                        hAxis: {
                            title: 'So luong san pham',
                            minValue: 0,
                            textStyle: {color: '#3e3e3e', fontSize: 14}
                        },
                        vAxis: {
                            title: 'Danh muc',
                            textStyle: {color: '#3e3e3e', fontSize: 14},
                            slantedText: true,
                            slantedTextAngle: 0

                        },
                        colors: ['#4CAF50', '#FF9800'],
                        backgroundColor: '#f4f4f4',
                        is3D: true,
                        Animation: {
                            startup :true,
                            duration: 1000,
                            easing: 'out'
                        },
                        bar: {groupWidth: "75%"},
                        legend: {position:'top', alignment:'end'}

                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
               </script>
                    
                </div>