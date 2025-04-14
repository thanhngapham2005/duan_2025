<!DOCTYPE html>
<html lang="en">

<style>
  
  #product-detail {
    width: 400px;
    height: 502px;
    object-fit: contain;
}
</style>
<?php
require_once 'layout/head.php';
?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let quantityInput = document.getElementById("product-quantity");
    let quantityDisplay = document.getElementById("var-value");
    let remainingQuantity = parseInt(document.getElementById("remaining-quantity").innerText);

    // Đồng bộ hiển thị ban đầu
    quantityDisplay.innerText = quantityInput.value;

    document.querySelector('.quantity-btn-plus').addEventListener("click", function () {
        let quantity = parseInt(quantityInput.value);
        if (quantity < remainingQuantity) {
            quantity++;
            quantityInput.value = quantity;
            quantityDisplay.innerText = quantity;
        }
    });

    document.querySelector('.quantity-btn-minus').addEventListener("click", function () {
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantity--;
            quantityInput.value = quantity;
            quantityDisplay.innerText = quantity;
        }
    });
});
</script>
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
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="admin/images/<?= $productOne['img_product'] ?>"
                            alt="Card image cap" id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"><?= $productOne['name'] ?></h1>
                            <p class="h3 py-2"><?= number_format($productOne['price']) ?>đ</p>
                            <p class="py-2">


                            </p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Thương hiệu:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?= $productOne['firms'] ?></strong></p>
                                </li>
                            </ul>

                            <h6>Mô tả:</h6>
                            <p><?= $productOne['description'] ?></p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Số lượng còn lại:</h6>
                                </li>
                                <li class="list-inline-item"><p class="text-muted"><strong id="remaining-quantity"><?= $product_variant[0]['quantity'] ?></strong></p>
                                </li>
                                <li class="list-inline-item pb-3">

                                    <li class="list-inline-item text-right">
                                        Số lượng
                                    </li>
                                    <li class="list-inline-item"><span class="btn btn-success quantity-btn-minus">-</span></li>
                                    <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                    <li class="list-inline-item"><span class="btn btn-success quantity-btn-plus">+</span></li>
                                </li>
                            </ul>

                            <form action="index.php?act=addToCart" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item">Màu :</li>
                                            <?php foreach ($product_variant as $key => $value): ?>
                                            <li class="list-inline-item">
                                                <label class="color-label">
                                                    <input type="radio" name="color" value="<?= $value['name_color'] ?>"
                                                        <?= $key === 0 ? 'checked' : '' ?>
                                                        data-quantity="<?= $value['quantity'] ?>">
                                                    <!-- Dữ liệu số lượng cho mỗi biến thể -->
                                                    <span><?= $value['name_color'] ?></span>
                                                </label>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                        </div>
                        <div class="row pb-3">
                            <div class="col d-grid">
                                <button type="submit" class="btn btn-success btn-lg" name="submit"
                                    value="buy">Buy</button>
                            </div>
                            <!-- <form action="index.php?act=addToCart" method="POST"> -->
                            <input type="hidden" name="productId" value="<?= $productOne['id_product'] ?>">
                            <input type="hidden" name="name" value="<?= $productOne['name'] ?>">
                            <input type="hidden" name="price" value="<?= $productOne['price'] ?>">
                            <input type="hidden" name="brand" value="<?= $productOne['firms'] ?>">
                            <input type="hidden" name="product-quantity" id="product-quantity" value="1">
                            <input type="hidden" name="img" value="<?= $productOne['img_product'] ?>">
                            <div class="col d-grid">
                                <button href="index.php?act=cart" type="submit" class="btn btn-success btn-lg"
                                    name="addtocart">Add To Cart</button>
                            </div>


                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Close Content -->

    <!-- Start Article -->
    <section class="py-5">
        <div class="container">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <!-- Khu vực HIỂN THỊ bình luận -->
                        <div id="reviewsList" class="mb-5">
                            <h4 class="mb-4">Đánh giá từ khách hàng</h4>

                            <!-- Bình luận mẫu (có thể xóa hoặc thay bằng dữ liệu từ database) -->
                            <?php
                            foreach ($comments as $comment) {
                                if ($comment['censorship'] == 1) {
                                    continue; // Bỏ qua bình luận đã bị ẩn
                                }
                            ?>
                            <div class="review-card card mb-3 p-3">
                                <div class="d-flex">
                                    <div class="review-avatar d-flex align-items-center justify-content-center me-3">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <h5><?= $comment['full_name'] ?></h5>
                                            <div class="review-star">
                                                <?php
                                                    $rating = (int)$comment['rating']; // Đảm bảo rating là số nguyên
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $rating) {
                                                            echo '<i class="fas fa-star"></i>'; // Sao đầy
                                                        } else {
                                                            echo '<i class="far fa-star"></i>'; // Sao rỗng
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <p class="mb-2"><?= $comment['content'] ?></p>
                                        <small class="text-muted"><?= $comment['day_post'] ?></small>
                                    </div>
                                </div>
                            </div>
                            <?php
                            } ?>

                        </div>

                        <!-- Form THÊM bình luận -->
                        <?php if (isset($_SESSION['user'])): ?>
                        <form id="reviewForm" class="p-4 border rounded bg-light" method="POST"
                            enctype="multipart/form-data">
                            <h4 class="mb-4">Thêm đánh giá của bạn</h4>

                            <!-- Rating sao -->
                            <div class="mb-4">
                                <label class="d-block mb-2">Bình chọn:</label>
                                <div class="rating">
                                    <i class="fas fa-star" data-rating="1"></i>
                                    <i class="fas fa-star" data-rating="2"></i>
                                    <i class="fas fa-star" data-rating="3"></i>
                                    <i class="fas fa-star" data-rating="4"></i>
                                    <i class="fas fa-star" data-rating="5"></i>
                                    <input type="hidden" name="rating" id="ratingValue" value="0">
                                </div>
                            </div>

                            <!-- Bình luận -->

                            <div class="mb-4">
                                <input type="hidden" name="id_product" value="<?= $productOne['id_product'] ?>">
                                <!-- Mã sản phẩm -->
                                <label for="comment" class="form-label">Bình luận *</label>
                                <textarea class="form-control textarea-comment" id="comment" name="content" rows="4"
                                    required></textarea>
                            </div>

                            <!-- Nút gửi -->
                            <button type="submit" class="btn btn-submit" name="post_comment">Gửi đánh giá</button>

                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Nhúng JS từ CDN -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Script xử lý form -->
            <script>
            $(document).ready(function() {
                // Xử lý rating sao
                $('.rating i').on('click', function() {
                    const rating = $(this).data('rating');
                    $('#ratingValue').val(rating);
                    $('.rating i').removeClass('active');
                    $(this).prevAll().addBack().addClass('active');
                });

                // Xử lý submit form
                $('#reviewForm').on('submit', function(e) {
                    e.preventDefault();

                    const content = $('#comment').val().trim();
                    const rating = $('#ratingValue').val();
                    const id_product = $('input[name="id_product"]').val();

                    console.log('Content:', content);
                    console.log('Rating:', rating);
                    console.log('Product ID:', id_product);

                    // Kiểm tra dữ liệu
                    if (!content) {
                        alert('Vui lòng nhập nội dung bình luận!');
                        return;
                    }

                    if (rating === '0') {
                        alert('Vui lòng chọn đánh giá sao!');
                        return;
                    }

                    if (!id_product) {
                        alert('Sản phẩm không hợp lệ!');
                        return;
                    }

                    // Sử dụng axios thay vì fetch để nhất quán
                    const formData = new FormData();
                    formData.append('content', content);
                    formData.append('rating', rating);
                    formData.append('id_product', id_product);

                    axios.post('?act=addComment', formData)
                        .then(function(response) {
                            console.log('Full response:', response);

                            const res = response.data;

                            if (res.success) {
                                // Thêm bình luận mới vào danh sách
                                const newReview = `
                <div class="review-card card mb-3 p-3">
                    <div class="d-flex">
                        <div class="review-avatar d-flex align-items-center justify-content-center me-3">
                            <i class="fas fa-user text-muted"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h5>${res.data.userName}</h5>
                                <div class="review-star">
                                    ${'<i class="fas fa-star"></i>'.repeat(res.data.rating)}
                                    ${'<i class="far fa-star"></i>'.repeat(5 - res.data.rating)}
                                </div>
                            </div>
                            <p class="mb-2">${res.data.content}</p>
                            <small class="text-muted">${res.data.date}</small>
                        </div>
                    </div>
                </div>
            `;

                                $('#reviewsList').prepend(newReview);
                                $('#comment').val('');
                                $('.rating i').removeClass('active');
                                $('#ratingValue').val('0');

                                alert(res.message ?? 'Đã gửi bình luận thành công!');
                            } else {
                                alert(res.message ?? 'Có lỗi xảy ra khi gửi bình luận');
                            }
                        })
                        .catch(function(error) {
                            console.error('Error:', error);
                            alert('Có lỗi khi gửi bình luận!');
                        });
                });
            });
            </script>

            <!--Start Carousel Wrapper-->
            <div id="carousel-related-product">

            </div>
        </div>
    </section>
    <!-- End Article -->
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4">Sản phẩm cùng loại</h2>
            <div class="row">
                <?php foreach ($relatedProducts as $product): ?>
                <div class=" col-md-3">
                    <div class="card">
                        <img style="height: 200px; object-fit: cover;" src="admin/images/<?= $product['img_product'] ?>"
                            class="card-img-top" alt="<?= $product['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text text-success"><?= number_format($product['price']) ?>đ</p>
                            <a href="index.php?act=shop_single&id=<?= $product['id_product'] ?>"
                            <a href="#" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <!-- Start Footer -->
    <?php include 'layout/footer.php'; ?>
    <!-- End Footer -->

    <!-- Start Script -->
    <?php include 'layout/scripts.php'; ?>
    <!-- End Slider Script -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>