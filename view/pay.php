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
                    <form onsubmit="return confirm('Xac nhan dat hang')" action="index.php?act=payment" method="POST" class="mb-5">
                        <?php
                        // Đảm bảo $_SESSION['user']['customer_info'] tồn tại
                        $customer_info = $_SESSION['user']['customer_info'] ?? [
                            'full_name' => '',
                            'phone' => '',
                            'address' => ''
                        ];
                        ?>
                        
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

                            

                            <input type="text" name="receiver_phone" id="receiver_phone" class="form-control form-control-lg"
                                value="<?= htmlspecialchars($customer_info['phone']) ?>" required pattern="(03|05|07|08|09)[0-9]{8}" title="Số điện thoại Việt Nam hợp lệ gồm 10 số và bắt đầu bằng 03, 05, 07, 08, 09" >

                        </div>

                        <label for="receiver_address" class="form-label">Địa chỉ giao hàng</label>
                        <div class="form-outline mb-4">
                            <input type="text" name="receiver_address" id="receiver_address"
                                class="form-control form-control-lg"
                                value="<?= htmlspecialchars($customer_info['address']) ?>" required>
                        </div>


                        


<div class="mt-4 d-flex flex-wrap gap-2 ">
  <button type="submit" name="cod" class="btn btn-warning">Thanh toán COD</button>
  <a href="index.php?act=online_checkout" name="payUrl" class="btn btn-danger">Thanh toán MoMo</a>
  <button type="submit" name="vnpay" class="btn btn-success">Thanh toán VnPay</button>
  <button type="submit" class="btn btn-primary">Thanh toán tiền mặt</button>
</div>

<br>
<br>




                            <br>
                            <br>
                        <input type="submit" class="btn btn-primary btn-block btn-lg" name="order_cart"
                            value="Đặt hàng">

                        <h5 class="fw-bold mt-4">
                            <a href="?act=shop"><i class="fas fa-angle-left me-2"></i>Quay lại mua sắm</a>
                        </h5>
                    </form>
                </div>
            </div>
        </div>
    </section>
  
    <!-- Start Footer -->
    <?php include 'layout/footer.php'; ?>
    <!-- End Footer -->


    <!-- Modal thông báo kết quả thanh toán -->
    <div class="modal fade" id="paymentSuccessPopup" tabindex="-1" aria-labelledby="paymentSuccessPopupLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentSuccessPopupLabel">
                        <?php if (isset($_SESSION['payment_status']) && $_SESSION['payment_status'] === 'success'): ?>
                            <i class="fas fa-check-circle text-success"></i> Thành công
                        <?php else: ?>
                            <i class="fas fa-exclamation-circle text-danger"></i> Thông báo
                        <?php endif; ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($_SESSION['payment_message'])): ?>
                        <p><?= $_SESSION['payment_message'] ?></p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Start Script -->
    <?php include 'layout/scripts.php'; ?>
    <!-- End Script -->
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const applyDiscountBtn = document.getElementById('apply_discount');
        const discountCodeInput = document.getElementById('discount_code');
        const discountMessage = document.getElementById('discount_message');
        const hiddenDiscountCode = document.getElementById('hidden_discount_code');
        const totalAmount = document.getElementById('total_amount');
        const discountInfo = document.getElementById('discount_info');
        const discountAmount = document.getElementById('discount_amount');
        const finalAmount = document.getElementById('final_amount');
        
        // Lấy tổng tiền từ hiển thị
        let total = <?= $total ?>;
        let discountApplied = false; // Biến để kiểm tra đã áp dụng mã giảm giá chưa
        
        console.log('Script loaded, total:', total);
        console.log('Apply button:', applyDiscountBtn);
        
        // Xử lý khi click vào nút áp dụng mã giảm giá
        applyDiscountBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định
            console.log('Apply button clicked');
            
            // Chỉ kiểm tra nếu đã áp dụng mã giảm giá thành công
            if (discountApplied) {
                discountMessage.innerHTML = '<span class="text-warning">Bạn đã áp dụng mã giảm giá cho đơn hàng này. Vui lòng tạo đơn hàng mới để sử dụng mã khác.</span>';
                return;
            }
            
            applyDiscountCode();
        });
        
        // Xử lý khi click vào mã giảm giá có sẵn
        const discountCodeItems = document.querySelectorAll('.discount-code-item');
        console.log('Discount code items:', discountCodeItems.length);
        
        discountCodeItems.forEach(item => {
            item.addEventListener('click', function() {
                // Chỉ kiểm tra nếu đã áp dụng mã giảm giá thành công
                if (discountApplied) {
                    discountMessage.innerHTML = '<span class="text-warning">Bạn đã áp dụng mã giảm giá cho đơn hàng này. Vui lòng tạo đơn hàng mới để sử dụng mã khác.</span>';
                    return;
                }
                
                const code = this.getAttribute('data-code');
                console.log('Discount code clicked:', code);
                discountCodeInput.value = code;
                applyDiscountCode();
            });
        });
        
        // Hàm áp dụng mã giảm giá
        function applyDiscountCode() {
            const code = discountCodeInput.value.trim();
            console.log('Applying discount code:', code);
            
            if (!code) {
                discountMessage.innerHTML = '<span class="text-danger">Vui lòng nhập mã giảm giá</span>';
                return;
            }
            
            // Gửi request kiểm tra mã giảm giá
            console.log('Sending request to check discount code');
            
            fetch('index.php?act=checkDiscountCode', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'discount_code=' + encodeURIComponent(code) + '&total=' + total
            })
            .then(response => {
                console.log('Response received:', response);
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);
                
                if (data.status === 'success') {
                    // Đánh dấu đã áp dụng mã giảm giá thành công
                    discountApplied = true;
                    
                    // Hiển thị thông tin giảm giá
                    discountMessage.innerHTML = '<span class="text-success">Áp dụng mã giảm giá thành công!</span>';
                    hiddenDiscountCode.value = code;
                    
                    // Hiển thị thông tin giảm giá
                    discountInfo.style.display = 'block';
                    discountAmount.textContent = new Intl.NumberFormat('vi-VN').format(data.discount_amount) + 'đ';
                    finalAmount.textContent = new Intl.NumberFormat('vi-VN').format(data.final_total) + 'đ';
                    
                    // Vô hiệu hóa input và nút áp dụng
                    discountCodeInput.disabled = true;
                    applyDiscountBtn.disabled = true;
                    
                    // Thêm lớp CSS để hiển thị trạng thái đã áp dụng
                    discountCodeItems.forEach(item => {
                        if (item.getAttribute('data-code') === code) {
                            item.classList.add('active-discount');
                            item.style.backgroundColor = '#e8f5e9';
                            item.style.borderColor = '#4caf50';
                        } else {
                            item.style.opacity = '0.5';
                            item.style.cursor = 'not-allowed';
                        }
                    });
                } else {
                    discountMessage.innerHTML = '<span class="text-danger">' + data.message + '</span>';
                    hiddenDiscountCode.value = '';
                    discountInfo.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                discountMessage.innerHTML = '<span class="text-danger">Đã xảy ra lỗi khi kiểm tra mã giảm giá</span>';
            });
        }
        
        <?php if (isset($_SESSION['payment_status'])): ?>
        // Script xử lý popup thông báo
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
        <?php endif; ?>
    });
    </script>

</body>

</html>