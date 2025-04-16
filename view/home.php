<!DOCTYPE html>
<html lang="en">
<style>
    .card-img {
    aspect-ratio: 4 / 3;
    object-fit: contain;
    max-height: 250px;
    width: 100%;
}

</style>
<?php include 'layout/head.php'; ?>

<body>
    <!-- Start Top Nav -->
    <?php include 'layout/topnav.php'; ?>
    <!-- Close Top Nav -->


    <!-- Header -->
    <?php include 'layout/header.php'; ?>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade" id="templatemo_search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Tìm kiếm sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body py-4">
                <form action="index.php" method="get">
                    <div class="input-group">
                        <input type="hidden" name="act" value="search">
                        <input list="productList" type="text" class="form-control form-control-lg"
                            id="inputModalSearch" name="q" placeholder="Nhập tên sản phẩm..." required>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fa fa-search me-1"></i> Tìm kiếm
                        </button>
                    </div>
                    <datalist id="productList">
                        <?php foreach ($product as $value): ?>
                            <option value="<?= htmlspecialchars($value ) ?>">
                        <?php endforeach; ?>
                    </datalist>
                </form>
            </div>
        </div>
    </div>
</div>




    <!-- Start Banner Hero -->
    <?php include 'layout/banner.php'; ?>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->

    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Sản phẩm nổi bật</h1>
                </div>
            </div>
            <div class="row">
                <?php foreach( $topPro as $key => $value){
                    ?>
                        <div class="col-12 col-md-4 mb-4">
                            <div class="card h-100">
                                <a href="?act=shop_single&id=<?= $value['id_product'] ?>">
                                    <img src="admin/images/<?= $value['img_product'] ?>" class="card-img" alt="...">
                                </a>
                                <div class="card-body">
                                    <ul class="list-unstyled d-flex justify-content-between">
                                        <li>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-muted fa fa-star"></i>
                                            <i class="text-muted fa fa-star"></i>
                                        </li>
                                        <li class="text-muted text-right"><?= number_format($value['price']) ?>đ</li>
                                    </ul>
                                    <a href="?act=shop_single&id=<?= $value['id_product'] ?>" class="h2 text-decoration-none text-dark"><?= $value['name'] ?></a>
                                    <p class="card-text"><?= $value['description'] ?></p>
                                    <p class="text-muted">Lượt xem (<?= $value['view'] ?>)</p>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- End Featured Product -->


    <!-- Start Footer -->
    <?php include 'layout/footer.php'; ?>
    <!-- End Footer -->

    <!-- Start Script -->
    <?php include 'layout/scripts.php'; ?>
    <!-- End Script -->
</body>

</html>