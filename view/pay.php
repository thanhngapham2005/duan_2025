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
                            <input type="text" id="discount_code" name="discount_code" class="form-control" placeholder="Nhập mã giảm giá">
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
                            <div class="discount-code-item me-2 mb-2 p-2 border rounded" 
                                 style="cursor: pointer;" 
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
                    <form id="payment-form" class="mb-5">
                        <?php
                        $customer_info = $_SESSION['user']['customer_info'] ?? [
                            'full_name' => '',
                            'phone' => '',
                            'address' => ''
                        ];
                        ?>

                        <!-- Thêm input ẩn để lưu giá trị discount_amount -->
                        <input type="hidden" id="hidden_discount_amount" name="discount_amount" value="0">

                        <!-- Thiếu input ẩn để lưu mã giảm giá -->
                        <input type="hidden" id="hidden_discount_code" name="discount_code" value="">
                        
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

                        <div class="d-flex gap-2">
                            <button type="button" onclick="submitCashPayment()" class="btn btn-primary btn-lg flex-grow-1">
                                Thanh toán tiền mặt
                            </button>
                            <button type="button" onclick="submitMomoPayment()" class="btn btn-danger btn-lg flex-grow-1">
                                Thanh toán MOMO
                            </button>
                        </div>
                    </form>

                    <h5 class="fw-bold mt-4">
                        <a href="?act=shop"><i class="fas fa-angle-left me-2"></i>Quay lại mua sắm</a>
                    </h5>
                </div>

                <!-- Thêm script xử lý -->
                <script>
                function submitCashPayment() {
                    const form = document.getElementById('payment-form');
                    if (form.checkValidity()) {
                        if (confirm('Xác nhận đặt hàng')) {
                            const formData = new FormData(form);
                            formData.append('order_cart', 'true');
                            
                            // Thêm thông tin giảm giá
                            formData.append('discount_code', $('#hidden_discount_code').val());
                            formData.append('discount_amount', $('#hidden_discount_amount').val());
                            
                            // Tạo form mới và submit
                            const submitForm = document.createElement('form');
                            submitForm.method = 'POST';
                            submitForm.action = 'index.php?act=payment';
                            
                            for (const [key, value] of formData.entries()) {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = key;
                                input.value = value;
                                submitForm.appendChild(input);
                            }
                            
                            document.body.appendChild(submitForm);
                            submitForm.submit();
                        }
                    } else {
                        form.reportValidity();
                    }
                }

                function submitMomoPayment() {
                    const form = document.getElementById('payment-form');
                    if (form.checkValidity()) {
                        // Tạo form mới cho MOMO
                        const momoForm = document.createElement('form');
                        momoForm.method = 'POST';
                        momoForm.action = 'view/confirm_momo.php';
                        
                        // Thêm các trường dữ liệu
                        const formData = new FormData(form);
                        const fields = {
                            'momo': 'true',
                            'total_amount': '<?= $total ?>',
                            'receiver_name': formData.get('receiver_name'),
                            'receiver_phone': formData.get('receiver_phone'),
                            'receiver_address': formData.get('receiver_address')
                        };
                        
                        for (const [key, value] of Object.entries(fields)) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = key;
                            input.value = value;
                            momoForm.appendChild(input);
                        }
                        
                        document.body.appendChild(momoForm);
                        momoForm.submit();
                    } else {
                        form.reportValidity();
                    }
                }
                </script>
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
        $(document).ready(function() {
            // Xử lý khi click vào mã giảm giá có sẵn
            $('.discount-code-item').click(function() {
                var code = $(this).data('code');
                $('#discount_code').val(code);
                $('#apply_discount').click(); // Tự động áp dụng mã
            });
            
            $('#apply_discount').click(function() {
                var code = $('#discount_code').val();
                if (code.trim() === '') {
                    $('#discount_message').html('<span class="text-danger">Vui lòng nhập mã giảm giá</span>');
                    return;
                }
                
                // Gửi AJAX request để kiểm tra mã giảm giá
                $.ajax({
                    url: 'index.php?act=checkDiscountCode',
                    type: 'POST',
                    data: {
                        discount_code: code,
                        total: <?= $total ?>
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            var discountAmount = response.discount_amount;
                            var finalTotal = response.final_total;
                            
                            // Hiển thị thông tin giảm giá
                            $('#discount_message').html('<span class="text-success">Mã giảm giá hợp lệ: -' + formatCurrency(discountAmount) + '</span>');
                            
                            // Cập nhật các trường ẩn
                            $('#hidden_discount_code').val(code);
                            $('#hidden_discount_amount').val(discountAmount);
                            
                            // Hiển thị phần giảm giá
                            $('#discount_info').show();
                            $('#discount_amount').text('-' + formatCurrency(discountAmount));
                            $('#final_amount').text(formatCurrency(finalTotal));
                        } else {
                            $('#discount_message').html('<span class="text-danger">' + response.message + '</span>');
                            $('#hidden_discount_code').val('');
                            $('#hidden_discount_amount').val(0);
                            $('#discount_info').hide();
                        }
                    },
                    error: function() {
                        $('#discount_message').html('<span class="text-danger">Có lỗi xảy ra, vui lòng thử lại</span>');
                    }
                });
            });
            
            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN').format(amount) + 'đ';
            }
        });
    </script>
    
</body>

</html>
