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
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="admin/images/<?= $productOne['img_product'] ?>" alt="Card image cap"
                            id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"><?= $productOne['name'] ?></h1>
                            <p class="h3 py-2"><?= number_format($productOne['price']) ?>đ</p>
                            <p class="py-2">
                                <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $avgRating) {
                                            echo '<i class="fa fa-star text-warning"></i>'; // Sao đầy
                                        } elseif ($i - $avgRating < 1) {
                                            echo '<i class="fa fa-star-half-alt text-warning"></i>'; // Sao nửa
                                        } else {
                                            echo '<i class="fa fa-star text-secondary"></i>'; // Sao trống
                                        }
                                    }                                    
                                ?>
                                <span class="list-inline-item text-dark"><?= $avgRating ?></span>
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
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong id="remaining-quantity"><?= $product_variant[0]['quantity'] ?></strong></p>
                                </li>
                                <li class="list-inline-item pb-3">
                                    <li class="list-inline-item text-right">
                                        Số lượng
                                    </li>
                                    <li class="list-inline-item"><span class="btn btn-succcess" id="btn-minus">-</span></li>
                                    <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                    <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                    </li>
                            </ul>

                            <form action="index.php?act=addToCart" method="POST">
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
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                    </div>
                                    <!-- <form action="index.php?act=addToCart" method="POST"> -->
                                    <input type="hidden" name="productId" value="<?= $productOne['id_product'] ?>">
                                    <input type="hidden" name="name" value="<?= $productOne['name'] ?>">
                                    <input type="hidden" name="price" value="<?= $productOne['price'] ?>">
                                    <input type="hidden" name="brand" value="<?= $productOne['firms'] ?>">
                                    <input type="hidden" name="product-quanity" id="product-quanity" value="1">
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
                <?php foreach($relatedProducts as $product): ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img  style="height: 200px; object-fit: cover;" src="admin/images/<?= $product['img_product'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $product['name'] ?></h5>
                                <p class="card-text text-success"><?= number_format($product['price']) ?>đ</p>
                                <a href="index.php?act=shop_single&id=<?= $product['id_product'] ?>" class="btn-btn-primary">Xem chi tiết</a>
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

</body>

</html>