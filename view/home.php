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
                                <a href="shop-single&id=<?= $value['id_product'] ?>">
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