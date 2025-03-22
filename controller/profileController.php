<?php
require_once 'model/userModel.php';
class ProfileController
{
    public function profile()
    {
        if ($_SESSION['user']) {
            $email = $_SESSION['user']['email'];
            $password = $_SESSION['user']['password'];
            $userProfile = getUserProfile($email, $password);
            if ($userProfile) {
                require_once 'view/profile.php';
            } else {
                $error = "Khoong tim thay thong tin nguoi dung";
            }
        } else {
            header('Location: ?act=login');
            exit;
        }
    }
    public function updateProfile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ?act=login');
            exit;
        }
        $fullname = $_POST['fullname'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $address = $_POST['address'] ?? null;

        if (empty($fullname) || empty($phone) || empty($address)) {
            $error = "Vui long nhap day du thong tin";
            return;
        }
        $userId = $_SESSION['user']['id_user'];

        $updateSuccess = updateUserProfile($userId, $fullname, $phone, $address);

        if ($updateSuccess) {
            $_SESSION['user']['fullname'] = $fullname;
            header('Location: ?act=profile');
            exit;
        } else {
            echo "Cap nhat thong tin that bai";
        }
    }
}
