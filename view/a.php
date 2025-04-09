<?php
require_once 'layout/header.php';
?>

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
            echo '<td><img src="../images/' . htmlspecialchars($value['img_product']) . '" alt="" width="50px"></td>';
            echo '<td>' . htmlspecialchars($value['brand']) . '</td>';
            echo '<td>' . htmlspecialchars($value['color']) . '</td>';
            echo '<td>' . number_format($value['price']) . 'đ</td>';
            echo '<td>' . htmlspecialchars($value['quantity']) . '</td>';
            echo '<td>' . number_format($subtotal) . 'đ</td>';
            echo '<td><a href="index.php?act=deleteCart&id=' . $value['id'] . '" class="btn btn-danger">Xóa</a></td>';
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
    <a href="?act=pay" class="btn btn-primary">Thanh toán</a>
    <a href="?act=shop" class="btn btn-primary">Mua thêm</a>
</div>

<script>
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                e.preventDefault();
            }
        });
    });
</script>

<?php
require_once 'layout/footer.php';
?>
