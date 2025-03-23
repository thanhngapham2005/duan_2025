<?php require_once 'model/userModel.php';
class RegisterController
{
    function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password != $confirm_password) {
                $error = "Mat khau khong trung khop";
            } elseif (checkEmailExists($email)) {
                $error = "Email da ton tai";
            } else {
                if (registerUser($fullname, $email, $password)) {

                    header('Location: ?act=login');
                    exit;
                } else {
                    $error = "Dang ky that bai";
                }
            }
        }
        require_once 'view/register.php';
    }
}
