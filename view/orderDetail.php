<!DOCTYPE html>
<html lang="en">

<?php
require_once 'layout/head.php';
?>

<body>
    <!-- Start Top Nav -->
    <?php require_once 'layout/topnav.php'; ?>
    <!-- Close Top Nav -->


    <!-- Header -->
    <?php require_once 'layout/header.php'; ?>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Open Content -->

    <!-- đổ chi tiết sp ra đây -->
    
    <!-- Close Content -->

    <!-- Start Article -->
    <div class="container my-5">
        <h2 class="mb-4">Chi tiết đơn hàng </h2>
        <div class="card">
            <div class="card-header">
                <strong>Mã đơn hàng </strong> <?= $orderDetail[0]['id_bill'] ?>

            </div>
            <div class="card-body">
                <p><strong>Nguời nhận :</strong> <?= $orderDetail[0]['receiver_name'] ?></p>
                <p><strong>Điện thoại :</strong> <?= $orderDetail[0]['receiver_phone'] ?></p>
                <p><strong>Địa chỉ :</strong> <?= $orderDetail[0]['receiver_address'] ?></p>
                <p><strong>Ngày mua :</strong> <?= $orderDetail[0]['purchase_date'] ?></p>
                <p><strong>Trạng thái :</strong> <?= getOderStatus($orderDetail[0]['status']) ?></p>

                <?php if (in_array($orderDetail[0]['status'],[0, 1])): ?>
                    <form action="?act=cancelOrder" method="post">
                        <input type="hidden" name="id_bill" value="<?= $orderDetail[0]['id_bill'] ?>">
                        <button type="submit" class="btn btn-danger" name="cancel" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng ? ')">Hủy đơn hàng </button>
                    
                    </form>
                    <?php endif; ?>
            </div>
        </div>
<h3 class="mt-4">Danh sách sản phẩm </h3>
<table class="table">
<thead>
    <tr>
        <th>Ảnh </th>
        <th>Tên sản phẩm</th>
        <th>Màu </th>
        <th>Giá </th>
        <th>Số lượng</th>
        <th>Thành tiền </th>
    </tr>
</thead>
<tbody>
    <?php foreach ($orderDetail as $detail): ?>
        <tr>
            <td><img src="admin/images/<?= $detail['img_product'] ?>" alt="Anh san pham" style="width: 50px; height: 50px; object-fit:cover;"></td>
            <td><?= $detail['name_product'] ?></td>
            <td><?= $detail['name_color'] ?></td>
            <td><?= number_format($detail['price']) ?>đ</td>
            <td><?= $detail['quantity'] ?></td>
            <td><?= number_format($detail['price'] * $detail['quantity']) ?>đ</td>
        </tr>
        <?php endforeach; ?>
</tbody>
</table>

<div class="text-end mt-3">
    <?php 
    $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $orderDetail));
    $discount = isset($orderDetail[0]['discount_amount']) ? $orderDetail[0]['discount_amount'] : 0;
    $total = $subtotal - $discount;
    ?>
    
    <div class="mb-2">
        <strong>Tổng tiền hàng:</strong>
        <span class="text-dark"><?= number_format($subtotal) ?> đ</span>
    </div>
    
    <?php if($discount > 0): ?>
    <div class="mb-2 text-danger">
        <strong>Giảm giá:</strong>
        <span>-<?= number_format($discount) ?> đ</span>
    </div>
    <?php endif; ?>
    
    <div class="mb-2">
        <strong>Thành tiền:</strong>
        <span class="fs-5 fw-bold text-danger"><?= number_format($total) ?> đ</span>
    </div>
</div>

</div>

    </div>
    <!-- End Article -->
    <section class="py-5">
       
    </section>                                            

    <!-- Start Footer -->
    <?php include 'layout/footer.php'; ?>
    <!-- End Footer -->

    <!-- Start Script -->
    <?php include 'layout/scripts.php'; ?>
    <!-- End Slider Script -->

</body>

</html>