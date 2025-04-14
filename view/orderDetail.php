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
        <h2 class="mb-4">Chi tiet don hang</h2>
        <div class="card">
            <div class="card-header">
                <strong>Ma don hang</strong> <?= $orderDetail[0]['id_bill'] ?>

            </div>
            <div class="card-body">
                <p><strong>Nguoi nhan:</strong> <?= $orderDetail[0]['receiver_name'] ?></p>
                <p><strong>Dien thoai:</strong> <?= $orderDetail[0]['receiver_phone'] ?></p>
                <p><strong>Dia chi:</strong> <?= $orderDetail[0]['receiver_address'] ?></p>
                <p><strong>Ngay mua:</strong> <?= $orderDetail[0]['purchase_date'] ?></p>
                <p><strong>Trang thai:</strong> <?= getOderStatus($orderDetail[0]['status']) ?></p>

                <?php if (in_array($orderDetail[0]['status'],[0, 1])): ?>
                    <form action="?act=cancelOrder" method="post">
                        <input type="hidden" name="id_bill" value="<?= $orderDetail[0]['id_bill'] ?>">
                        <button type="submit" class="btn btn-danger" name="cancel" onclick="return confirm('Ban co chan muon huy don hang')">Huy don hang</button>
                    
                    </form>
                    <?php endif; ?>
            </div>
        </div>
<h3 class="mt-4">Danh sach san pham</h3>
<table class="table">
<thead>
    <tr>
        <th>Anh</th>
        <th>Tên sản phẩm</th>
        <th>Mau</th>
        <th>Gia</th>
        <th>So luong</th>
        <th>Thanh tien</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($orderDetail as $detail): ?>
        <tr>
            <td><img src="admin/images/<?= $detail['img_product'] ?>" alt="Anh san pham" style="width: 50px; height: 50px; object-fit:cover;"></td>
            <td><?= $detail['name_product'] ?></td>
            <td><?= $detail['name_color'] ?></td>
            <td><?= number_format($detail['price']) ?>d</td>
        </tr>
        <?php endforeach; ?>
</tbody>
</table>

<div class="text-end mt-3">
    <strong>Tong tien:</strong>
    <?= number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $orderDetail))) ?> d

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