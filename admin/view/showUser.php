<?php
require_once 'layout/header.php';
require_once 'layout/css.php';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

    <title>Chi tiết tài khoản</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <?php
        require_once 'layout/sidebar.php';
        ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Chi tiết tài khoản</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Xem tài khoản</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="card shadow mb-4" style="padding: 20px; border-radius: 10px; background: #fff;">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h1 style="font-size: 24px; color: #333; margin-bottom: 20px;">Thông tin người dùng</h1>

                            <?php if ($user): ?>
                            <div style="display: flex; flex-direction: column; gap: 15px;">
                                <div>
                                    <label style="font-weight: bold; color: #555;">ID:</label>
                                    <p
                                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9;">
                                        <?php echo $user['id_user']; ?></p>
                                </div>
                                <div>
                                    <label style="font-weight: bold; color: #555;">Họ tên:</label>
                                    <p
                                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9;">
                                        <?php echo $user['full_name']; ?></p>
                                </div>
                                <div>
                                    <label style="font-weight: bold; color: #555;">Email:</label>
                                    <p
                                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9;">
                                        <?php echo $user['email']; ?></p>
                                </div>
                                <div>
                                    <label style="font-weight: bold; color: #555;">Số điện thoại:</label>
                                    <p
                                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9;">
                                        <?php echo $user['phone']; ?></p>
                                </div>
                                <div>
                                    <label style="font-weight: bold; color: #555;">Địa chỉ:</label>
                                    <p
                                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9;">
                                        <?php echo $user['address']; ?></p>
                                </div>

                                <div>
                                    <label style="font-weight: bold; color: #555;">Vai trò:</label>
                                    <p
                                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9;">
                                        <?php echo ($user['role'] == 2) ? 'Admin' : 'User'; ?>
                                    </p>
                                </div>
                            </div>
                            <?php else: ?>
                            <p style="color: red; font-weight: bold;">Người dùng không tồn tại!</p>
                            <?php endif; ?>

                            <a href="index.php?act=listUser"
                                style="display: block; margin-top: 15px; color: #007bff; text-decoration: none; font-weight: bold;">
                                Quay lại danh sách người dùng
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            require_once 'layout/footer.php';
            ?>
        </div>
    </div>

</body>

</html>
<?php
require_once 'layout/scripts.php';
?>