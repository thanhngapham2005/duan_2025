<?php
echo "<script>console.log('Shop view loaded');</script>";
?>
<style>
    .card-img {
        aspect-ratio: 4 / 3;
        object-fit: contain;
        max-height: 250px;
        width: 100%;
    }
</style>
<?php
require_once 'layout/head.php';
require_once 'layout/topnav.php';
require_once 'layout/header.php';

?>



<!-- Start Content -->
<div class="container py-5">
    <div class="row">


        <div class="col-lg-3">
            
            <ul class="list-unstyled templatemo-accordion">
                <!-- <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Sale
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Sport</a></li>
                        <li><a class="text-decoration-none" href="#">Luxury</a></li>
                    </ul>
                </li> -->
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        <h1 class="h2 pb-4">Danh mục</h1>
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseThree" class="collapse list-unstyled pl-3">
                        <?php foreach ($category as $key => $value) {
                        ?>
                        

                            <li><a class="text-decoration-none"
                                    href="?act=shop&id_category=<?= $value['id_category'] ?>"><?= $value['name_cat'] ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <h2>Tất cả sản phẩm</h2>
                </div>
                <div class="col-md-6 pb-4">
                    <div class="d-flex">
                        <select class="form-control">
                            <option>Featured</option>
                            <option>A to Z</option>
                            <option>Item</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <?php
                if (!empty($product)) {
                    foreach ($product as $key => $value) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-4 product-wap rounded-0">
                        <div class="card rounded-0">
                      
                            <img class="card-img rounded-0 img-fluid w-100" style="height: 200px; object-fit: cover;"
                                src="admin/images/<?= $value['img_product'] ?>">
                            <div
                                class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li><a class="btn btn-success text-white mt-2"
                                            href="?act=shop_single&id=<?= $value['id_product'] ?>"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a class="btn btn-success text-white mt-2" href="index.php?act=cart"><i
                                                class="fas fa-cart-plus"></i></a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="card-body">
                            <a href="?act=shop_single" class="h3 text-decoration-none"><?= $value['name'] ?></a>
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul>
                            <p class="text-center mb-0"><?= number_format($value['price']) ?>đ</p>
                        </div>
                    </div>
                </div>
                <?php }
                } else { ?>
                <p class="text-center">Không tìm thấy sản phẩm nào.</p>
                <?php } ?>
            </div>
            <!-- <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#" tabindex="-1">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" href="#">3</a>
                        </li>
                    </ul>
                </div> -->
        </div>

    </div>
</div>
<!-- End Content -->


<?php
require_once 'layout/scripts.php';
require_once 'layout/footer.php'
?>