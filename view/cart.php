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
    <section class="py-5">
        <div class="container">
        <div class="container py-5">

    <h2 class="h2 text-success mb-4">Giỏ hàng của bạn</h2>
    
    <?php
    if (!isset($_SESSION['mycart']) || empty($_SESSION['mycart'])) {
        echo '<p>Giỏ hàng của bạn đang trống.</p>';
    } else {
        echo '<table class="table">';
        echo '<thead>

        <tr>
          <th>STT</th>
          <th>Tên sản phẩm</th>
          <th>Hình ảnh</th>
          <th>Thương hiệu</th>
          <th>Màu sắc</th>
          <th>Giá</th>
          <th>Số lượng</th>
          <th>Thành tiền</th>
          <th>Hành động</th>
        </tr>
        </thead>';
        echo '<tbody>';

        $total = 0;
        $index = 0;
        foreach($_SESSION['mycart'] as $key => $value) {
            $index++;
            $subtotal = $value['price'] * $value['quantity'];
            $total += $subtotal;
            echo '<tr>';
            echo '<td>' . $index . '</td>';
            echo '<td>' . htmlspecialchars($value['name']) . '</td>';
            echo '<td><img src="admin/images/' . htmlspecialchars($value['img']) . '" width="50"></td>';
            echo '<td>' . htmlspecialchars($value['brand']) . '</td>';
            echo '<td>' . htmlspecialchars($value['color']) . '</td>';
            echo '<td>' . number_format($value['price']) . 'đ</td>';
            echo '<td>' . htmlspecialchars($value['quantity']) . '</td>';
            echo '<td>' . number_format($subtotal) . 'đ</td>';
            echo '<td><a href="index.php?act=deleteToCart&id=' . $value['id'] . '" class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\')">Xóa</a></td>';

            echo '</tr>';
        }
        echo '<tr>
        <td colspan="7" class="text-right"><strong>Tổng tiền</strong></td>
        <td><strong>' . number_format($total) . 'đ</strong></td>
        <td></td>
        </tr>';
        echo '</tbody>';
        echo '</table>';
    }
    ?>
    <br>
    <?php if (isset($_SESSION['user'])): ?>
    <a href="?act=pay" class="btn btn-primary">Thanh toán</a>
<?php else: ?>
    <a href="index.php?act=login" class="btn btn-primary" onclick="alert('Bạn cần đăng nhập để thanh toán!');">Thanh toán</a>

<?php endif; ?>

    <a href="?act=shop" class="btn btn-primary">Mua thêm</a>
</div>
            <!--Start Carousel Wrapper-->
            <div id="carousel-related-product">

            </div>
        </div>
    </section>
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
