<?php
require_once 'layout/head.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php
$status = $_GET['resultCode'] ?? null;
$orderId = $_GET['orderId'] ?? null;
$amount = $_GET['amount'] ?? null;

if (isset($status) && $status == 0) { // Kiểm tra thanh toán thành công
    unset($_SESSION['mycart']); // Xóa giỏ hàng
    echo "<script>
        alert('Thanh toán thành công');
        window.location.href = 'index.php?act=order';
    </script>";
}
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

    <!-- Content Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Danh sách sản phẩm trong giỏ hàng -->
                <div class="col-lg-6 px-5 py-4">
                    <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Các sản phẩm bạn đã chọn</h3>
                    <div class="box_show_cart">
                        <?php
                        $total = 0;
                        if (!empty($_SESSION['mycart'])) {
                            foreach ($_SESSION['mycart'] as $index => $item) {
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                        ?>
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <img src="admin/images/<?= $item['img'] ?>" width="150" class="img-fluid"
                                    alt="<?= $item['name'] ?>">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <a href="index.php?act=deleteToCart&id=<?= $item['id'] ?>" class="float-end text-black">
                                    <i class="fas fa-times"></i>
                                </a>
                                <h5 class="text-primary"><?= htmlspecialchars($item['name']) ?></h5>
                                <h6 style="color: #9e9e9e">Thương hiệu: <?= htmlspecialchars($item['brand']) ?></h6>
                                <h6 style="color: #9e9e9e;">Màu: <?= htmlspecialchars($item['color']) ?></h6>
                                <div class="d-flex align-items-center">
                                    <p class="fw-bold mb-0 me-5 pe-3">
                                        <?= number_format($subtotal) ?>đ
                                    </p>
                                    <span>Số lượng: <strong><?= (int)$item['quantity'] ?></strong></span>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                            echo "<p class='text-center text-danger'>Giỏ hàng của bạn đang trống!</p>";
                        }
                        ?>
                    </div>
                    <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1">

                    <!-- Thêm phần mã giảm giá -->
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="discount_code" class="form-control" placeholder="Nhập mã giảm giá">
                            <button class="btn btn-outline-primary" type="button" id="apply_discount">Áp dụng</button>
                        </div>
                        <div id="discount_message" class="mt-2"></div>
                    </div>

                    <!-- Hiển thị danh sách mã giảm giá có sẵn -->
                    <?php if (!empty($discountCodes)): ?>
                    <div class="mb-3">
                        <h6 class="fw-bold">Mã giảm giá có sẵn:</h6>
                        <div class="d-flex flex-wrap">
                            <?php foreach ($discountCodes as $code): ?>
                            <div class="discount-code-item me-2 mb-2 p-2 border rounded" style="cursor: pointer;"
                                data-code="<?= htmlspecialchars($code['code']) ?>">
                                <span class="badge bg-primary"><?= htmlspecialchars($code['code']) ?></span>
                                <small>Giảm <?= $code['discount_percentage'] ?>%</small>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">
                        <h5 class="fw-bold mb-0">Tổng tiền:</h5>
                        <h5 class="fw-bold mb-0" id="total_amount"><?= number_format($total) ?>đ</h5>
                    </div>

                    <!-- Hiển thị giảm giá và thành tiền sau giảm giá -->
                    <div id="discount_info" style="display: none;">
                        <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #ffebee;">
                            <h5 class="fw-bold mb-0">Giảm giá:</h5>
                            <h5 class="fw-bold mb-0" id="discount_amount">0đ</h5>
                        </div>
                        <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e8f5e9;">
                            <h5 class="fw-bold mb-0">Thành tiền:</h5>
                            <h5 class="fw-bold mb-0" id="final_amount"><?= number_format($total) ?>đ</h5>
                        </div>
                    </div>
                </div>

                <!-- Thông tin thanh toán -->
                <div class="col-lg-6 px-5 py-4">
                    <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Thông tin thanh toán</h3>
                    <form onsubmit="return confirm('Xác nhận đặt hàng')" action="index.php?act=payment" method="POST"
                        class="mb-5">
                        <?php
                        $customer_info = $_SESSION['user']['customer_info'] ?? [
                            'full_name' => '',
                            'phone' => '',
                            'address' => ''
                        ];
                        ?>

                        <label for="receiver_name" class="form-label">Tên người nhận</label>
                        <div class="form-outline mb-4">
                            <input type="text" name="receiver_name" id="receiver_name"
                                class="form-control form-control-lg"
                                value="<?= htmlspecialchars($customer_info['full_name']) ?>" required>
                        </div>

                        <label for="receiver_phone" class="form-label">Số điện thoại người nhận</label>
                        <div class="form-outline mb-4">
                            <input type="text" name="receiver_phone" id="receiver_phone"
                                class="form-control form-control-lg"
                                value="<?= htmlspecialchars($customer_info['phone']) ?>" required
                                pattern="(03|05|07|08|09)[0-9]{8}"
                                title="Số điện thoại Việt Nam hợp lệ gồm 10 số và bắt đầu bằng 03, 05, 07, 08, 09">
                        </div>

                        <label for="receiver_address" class="form-label">Địa chỉ giao hàng</label>
                        <div class="form-outline mb-4">
                            <input type="text" name="receiver_address" id="receiver_address"
                                class="form-control form-control-lg"
                                value="<?= htmlspecialchars($customer_info['address']) ?>" required>
                        </div>

                        <input type="submit" class="btn btn-primary btn-block btn-lg" name="order_cart"
                            value="Thanh toán tiền mặt">
                    </form>

                    <form action="view/confirm_momo.php" method="POST">
                        <input type="submit" name="momo" class="btn btn-danger" value="Thanh toán MoMo">
                        <input type="hidden" name="total_amount" value="<?= $total ?>">
                        <input type="hidden" name="receiver_name"
                            value="<?= htmlspecialchars($customer_info['full_name']) ?>">
                        <input type="hidden" name="receiver_phone"
                            value="<?= htmlspecialchars($customer_info['phone']) ?>">
                        <input type="hidden" name="receiver_address"
                            value="<?= htmlspecialchars($customer_info['address']) ?>">
                    </form>

                    <h5 class="fw-bold mt-4">
                        <a href="?act=shop"><i class="fas fa-angle-left me-2"></i>Quay lại mua sắm</a>
                    </h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Footer -->
    <?php include 'layout/footer.php'; ?>
    <!-- End Footer -->

    <!-- Start Script -->
    <?php include 'layout/scripts.php'; ?>
    <!-- End Script -->


    <?php if (isset($_SESSION['payment_status'])): ?>
    <div class="modal fade show animate__animated <?= ($_SESSION['payment_status'] === 'success') ? 'animate__fadeIn' : 'animate__shakeX'; ?>"
        id="paymentSuccessPopup" tabindex="-1" role="dialog" aria-labelledby="paymentSuccessPopupLabel"
        style="display: block;" inert>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img id="img"
                        src="images/<?= ($_SESSION['payment_status'] === 'success') ? 'success.gif' : 'comp_3.gif'; ?>"
                        alt="<?= ($_SESSION['payment_status'] === 'success') ? 'Thanh toán thành công' : 'Có lỗi xảy ra'; ?>"
                        style="width: 100%; height: auto;">

                    <p><?= $_SESSION['payment_message']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>
    <script>
    var paymentSuccessPopup = new bootstrap.Modal(document.getElementById('paymentSuccessPopup'));

    // Hiển thị modal
    paymentSuccessPopup.show();

    // Đóng popup tự động sau 3 giây và redirect

    setTimeout(function() {

        paymentSuccessPopup.hide(); // Đóng modal sau 3 giây
        window.location.href = 'index.php?act=shop';
    }, 2000);
    <?php

        unset($_SESSION['payment_status']);
        unset($_SESSION['payment_message']);
        ?>
    </script>

</body>

</html>