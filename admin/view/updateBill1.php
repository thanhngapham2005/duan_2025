<?php
require_once 'layout/header.php';

?>
<div id="content-wrapper" class="d-flex flex-column">
    <?php
    require_once 'layout/sidebar.php';
    ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chi tiet đơn hàng</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thong tin san pham trong don hang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Anh</th>
                                <th>Ten san pham</th>
                                <th>Mau sac</th>
                                <th>Gia</th>
                                <th>So luong</th>
                                <th>Tong tien</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($oneBill as $index => $item):
                                $itemTotal = $item['price'] * $item['quantity'];
                                $total += $itemTotal;
                            ?>
                                <tr>
                                    <td><img src="../assets/img<?= ['img_product'] ?>" alt="" width="100px"></td>
                                    <td><?= $item['name_product'] ?></td>
                                    <td><?= $item['name_color'] ?></td>
                                    <td><?= number_format($item['price']) ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td><?= number_format($item['price']) * $item['quantity'] ?>đ</td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot></tfoot>
                        <tr>
                            <td colspan="5" class="text-right">Tổng tiền</td>
                            <td><?= number_format($total) ?>đ</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cap nhat trang thai don hang</h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <label for="status" class="form-label">Trang thai</label>
                    <select name="status" id="status" class="form-select">
                        <?php foreach ($statusDescription as $key => $value): ?>
                            <?php if ($key >= $status): ?>
                                <option value="<?= $key ?>" <?= $key == $status ? 'selected' : '' ?>>
                                    <?= $value ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="btn_update" class="btn btn-primary mt-3">Cap nhat</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'layout/footer.php';
require_once 'layout/scripts.php';
?>