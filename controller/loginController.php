<?php

require_once 'model/userModel.php';

class LoginController
{
    function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = checkLogin($email, $password);

            // var_dump($user); // Debug
            // exit();
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
                exit();
            } else {
                $error = "Email hoặc mật khẩu không đúng";
            }
        }
        require_once 'view/login.php';
    }
}