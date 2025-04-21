<!DOCTYPE html>
<html lang="en">

<!-- Thêm link CSS cho Leaflet vào phần head -->
<?php include 'layout/head.php'; ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<body>
    <!-- Start Top Nav -->
    <?php include 'layout/topnav.php'; ?>
    <!-- Close Top Nav -->


    <!-- Header -->
    <?php include 'layout/header.php'; ?>
    <!-- Close Header -->

    <!-- Modal Search -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Tìm kiếm ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Start Content Page -->
    <div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">Liên Hệ Với Chúng Tôi</h1>
            <p>Hãy để lại thông tin, chúng tôi sẽ liên hệ với bạn sớm nhất có thể</p>
        </div>
    </div>

    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row">
            <!-- Thông tin liên hệ -->
            <div class="col-md-4 mb-5">
                <h3 class="h3 mb-4">Thông Tin Liên Hệ</h3>
                <div class="d-flex mb-3">
                    <i class="fa fa-map-marker-alt mt-1 me-3" style="font-size: 1.2rem;"></i>
                    <div>
                        <h5 class="mb-1">Địa Chỉ</h5>
                        <p class="mb-0">123 Đường ABC, Quận XYZ, TP. Hà Nội</p>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <i class="fa fa-phone-alt mt-1 me-3" style="font-size: 1.2rem;"></i>
                    <div>
                        <h5 class="mb-1">Điện Thoại</h5>
                        <p class="mb-0">+84 123 456 789</p>
                    </div>
                </div>
                <div class="d-flex">
                    <i class="fa fa-envelope mt-1 me-3" style="font-size: 1.2rem;"></i>
                    <div>
                        <h5 class="mb-1">Email</h5>
                        <p class="mb-0">info@example.com</p>
                    </div>
                </div>
            </div>

            <!-- Form liên hệ -->
            <div class="col-md-8">
                <form class="row g-3" method="post" role="form">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-12">
                        <label for="subject" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="col-12">
                        <label for="message" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success btn-lg px-4">Gửi tin nhắn</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sửa lại phần Map -->
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div id="map" style="height: 400px; width: 100%; border-radius: 10px;"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tọa độ của Hà Nội
        var map = L.map('map').setView([21.028511, 105.804817], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Thêm marker và popup
        L.marker([21.028511, 105.804817]).addTo(map)
            .bindPopup('<strong>Inno Shop</strong><br>72 Miếu Đầm, Mễ Trì, Nam Từ Liêm, Hà Nội')
            .openPopup();

        // Tắt zoom bằng scroll để tránh conflict với scroll trang
        map.scrollWheelZoom.disable();
    });
    </script>
    <!-- End Map -->

    <!-- Start Footer -->
    <?php include 'layout/footer.php'; ?>
    <!-- End Footer -->

    <!-- Start Script -->
    <?php include 'layout/scripts.php'; ?>
    <!-- End Script -->
</body>
</html>