
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
                
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <h2><?= isset($category_name) ? $category_name : 'Tất cả sản phẩm' ?></h2>
                </div>
                <div class="col-md-6 pb-4">
                    <div class="d-flex">
                        <select class="form-control" id="sortSelect">
                            <option value="featured">Nổi bật</option>
                            <option value="asc">Giá: Thấp đến cao</option>
                            <option value="desc">Giá: Cao đến thấp</option>
                            <option value="az">Tên: A đến Z</option>
                            <option value="za">Tên: Z đến A</option>
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
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="?act=shop_single&id=<?= $value['id_product'] ?>" class="h3 text-decoration-none"><?= $value['name'] ?></a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý sắp xếp sản phẩm
    const sortSelect = document.getElementById('sortSelect');
    if(sortSelect) {
        sortSelect.addEventListener('change', function() {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort', this.value);
            window.location.href = currentUrl.toString();
        });
        
        // Đặt giá trị select dựa trên tham số URL
        const urlParams = new URLSearchParams(window.location.search);
        const sortParam = urlParams.get('sort');
        if(sortParam) {
            sortSelect.value = sortParam;
        }
    }
});
</script>

