<div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Thong ke doanh thu</h1>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Ten</th>
                                    <th>Tổng doanh thu</th>
                                    <th>Doanh thu theo ngay</th>
                                    <th>Doanh thu theo tuan</th>
                                    <th>Doanh thu theo thang</th>
                                    <th>Doanh thu theo nam</th>



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
                                        <a href="index.php?act=bieudodt"><input type="button" class="btn btn-success" value="Bieu do"></a>

                                    </div>
                    </div>

                </div>

            </div>
        </div>