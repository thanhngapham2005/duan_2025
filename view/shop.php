<!DOCTYPE html>
<html lang="en">

<?php
include 'layout/head.php';
?>

<body>
    <!-- Start Top Nav -->
    <?php
    include 'layout/topnav.php';
    ?>

    <!-- Close Top Nav -->


    <!-- Header -->
    <?php include 'layout/header.php'; ?>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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



    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3">
                <h1 class="h2 pb-4">Categories</h1>
                <ul class="list-unstyled templatemo-accordion">
                    <!-- <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Gender
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul class="collapse show list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="#">Men</a></li>
                            <li><a class="text-decoration-none" href="#">Women</a></li>
                        </ul>
                    </li> -->
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Danh mục sản phẩm
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                           <?php
                           
                            foreach ($category as $value){
                            ?>
                            <li><a class="text-decoration-none" href="?act=shop_cat&id=<?= $value['id_category'] ?>"><?= $value['name_cat'] ?></a></li>
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
                       <h2>Tat ca san pham</h2>
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
                    <div class="col-md-4">
                        <?php
                        if (!empty($product)) {
                            foreach ($product as $key => $value) {
                        
                        ?>
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="assets/img/<?= $value['img_product'] ?>">
                                <div  class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white mt-2" href="?act=shop_single&id=<?= $value['id_product'] ?>"><i
                                        class="far fa-eye">
                                            
                                        </i></a></li>
                                        <li><a class="btn btn-success text-white mt-2"
                                                href="index.php?act=cart"><i
                                                    class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="?act=shop_single" class="h3 text-decoration-none"><?= $value['name'] ?></a>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
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
                <?php
                }
                }else{ ?>
                    <p class="text-center">Không có sản phẩm.</p>
                <?php } ?>
            </div>
        </div>
    
    </div>
    <!--End Brands-->


    <!-- Start Footer -->
    <?php
    require_once 'layout/scripts.php';
    require_once 'layout/footer.php'
    ?>
    <!-- End Footer -->

    <!-- Start Script -->
    
    <!-- End Script -->
</body>

</html>
