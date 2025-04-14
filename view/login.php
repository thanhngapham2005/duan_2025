<?php require_once 'layout/header.php'; ?>
<?php include 'layout/head.php'; ?>
<div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Đăng nhập</h3>
                </div>
                <div class="card-body">
                    <!-- Kiểm tra lỗi và hiển thị thông báo -->
                    <?php if (!empty($error)) : ?>

                    <div class="alert alert-danger"><?php echo $error; ?></div>

                    <?php endif; ?>

                    <form action="index.php?act=login" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label for="remember" class="form-check-label">Ghi nhớ tài khoản</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Đăng nhập</button>
                        <a href="?act=register" class="btn btn-link">Chưa có tài khoản? Đăng ký ngay</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>
<?php require_once 'layout/scripts.php'; ?>