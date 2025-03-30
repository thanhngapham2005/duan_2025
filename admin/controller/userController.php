<?php
// usercontroller.php

require_once __DIR__ . '/../model/userModel.php';

class UserController
{
    public function listUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        require_once __DIR__ . '/../view/listUser.php';
    }

    public function addUser()
    {
        require_once __DIR__ . '/../view/addUser.php';
    }

    public function insertUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $userModel = new UserModel();
            $result = $userModel->insertUser($email, $password);

            if ($result) {
                $_SESSION['success_message'] = "Đăng ký thành công! Đang chuyển hướng...";
            } else {
                $_SESSION['error_message'] = "Đăng ký thất bại! Vui lòng thử lại.";
            }

            header("Location: index.php?act=listUser");
            exit();
        }
    }


    public function deleteUser($id_user)
    {
        $userModel = new UserModel();
        $userModel->deleteUser($id_user);
        header("Location: index.php?act=listUser");
        exit();
    }
    public function logout()
    {
        session_destroy();
        header("Location: ../");
        exit();
    }
    public function showUser($id_user)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserById($id_user);

        if (!$user) {
            die("Người dùng không tồn tại!");
        }

        require_once __DIR__ . '/../view/showUser.php';
    }
    public function editUser($id_user)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserById($id_user);
        require_once __DIR__ . '/../view/editUser.php';
    }

    public function updateUser($id_user)
    {

        $role = $_POST['role'];

        $userModel = new UserModel();
        $userModel->updateUser($id_user, $role);

        header("Location: index.php?act=listUser");
        exit();
    }


    // Add more methods for editUser and updateUser as needed
}