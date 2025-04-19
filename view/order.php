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
    
    <!-- Close Content -->

    <!-- Start Article -->
    <section class="py-5">
      <div class="container my-5">
        <h2 class="mb-4">Đơn hàng của tôi </h2>

        <ul class="nav nav-tabs mb-4" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-orders-tab" data-bs-toggle="tab" data-bs-target="#all-orders"
               type="button" role="tab" aria-controls="all-orders" aria-selected="true">Tất cả đơn </button>
            </li>
            
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="pending-payment-tab" data-bs-toggle="tab" data-bs-target="#pending-payment"
               type="button" role="tab" aria-controls="pending-payment" aria-selected="false">Chờ lấy hàng </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link " id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing"
               type="button" role="tab" aria-controls="processing" aria-selected="false">Đã lấy hàng </button>
            </li>

          
            
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping"
               type="button" role="tab" aria-controls="shipping" aria-selected="false">Đang vận chuyển </button>
            </li>

            

            <li class="nav-item" role="presentation">
                <button class="nav-link " id="successful-delivery-tab" data-bs-toggle="tab" data-bs-target="#successful-delivery"
               type="button" role="tab" aria-controls="successful-delivery" aria-selected="false">Giao hàng thành công </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link " id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled"
               type="button" role="tab" aria-controls="cancelled" aria-selected="false">Đã hủy </button>
            </li>
        </ul>

        <div class="nav-item" role="orderTabsContent">
        <div class="tab-pane fade show active" id="all-orders" role="tabpanel" aria-labelledby="all-orders-tab">
            <?php   renderOrders($order); ?>
        </div>
            <?php foreach ($orderStatus as $status => $ordersStaus): ?>
                <div class="tab-pane fade" id="<?= $tabIds[$status]; ?>" role="tabpanel"
                aria-labelledby="<?= $tabIds[$status]; ?>-tab">
                <?php renderOrders($ordersStaus); ?>
                </div>
            <?php endforeach; ?>

        </div>
      </div>

      </div>
    </section>
    <!-- End Article -->
    <section class="py-5">
       
    </section>                                            

    <!-- Start Footer -->
    <?php include 'layout/footer.php'; ?>
    <!-- End Footer -->

    <!-- Start Script -->
    <?php include 'layout/scripts.php'; ?>
    <!-- End Slider Script -->

</body>

</html>