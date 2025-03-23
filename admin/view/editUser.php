<?php
require_once 'layout/header.php';
require_once 'layout/css.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa thông tin người dùng</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4" style="padding: 20px; border-radius: 10px; background: #fff;">
            <div class="card-body">
                <h1 style="font-size: 24px; color: #333; margin-bottom: 20px;">Sửa thông tin người dùng</h1>
                <form action="index.php?act=updateUser&id_user=<?= $user['id_user'] ?>" method="post"
                    style="display: flex; flex-direction: column; gap: 15px;">

                    <label for="email" style="font-weight: bold; color: #555;">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required
                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">



                    <label for="full_name" style="font-weight: bold; color: #555;">Họ và tên:</label>
                    <input type="text" id="full_name" name="full_name"
                        value="<?= htmlspecialchars($user['full_name']) ?>" required
                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">

                    <label for="phone" style="font-weight: bold; color: #555;">Số điện thoại:</label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required
                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">

                    <label for="address" style="font-weight: bold; color: #555;">Địa chỉ:</label>
                    <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>"
                        required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">

                    <label for="role" style="font-weight: bold; color: #555;">Chức vụ:</label>
                    <select id="role" name="role"
                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">
                        <option value="2" <?= ($user['role'] == 2) ? 'selected' : '' ?>>Admin</option>
                        <option value="0" <?= ($user['role'] == 0) ? 'selected' : '' ?>>User</option>
                    </select>

                    <input type="submit" value="Cập nhật người dùng"
                        style="background: #007bff; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">
                </form>

            </div>
            <a href="index.php?act=listUser"
                style="display: block; margin-top: 15px; color: #007bff; text-decoration: none; font-weight: bold;">
                Quay lại danh sách người dùng
            </a>
        </div>
    </div>
</body>

</html>
<?php
require_once 'layout/footer.php';
?>