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
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $userModel = new UserModel();
        $userModel->insertUser($email, $password);

        header("Location: index.php?act=listUser");
        exit();
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
        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $role = $_POST['role'];

        $userModel = new UserModel();
        $userModel->updateUser($id_user, $email, $full_name, $phone, $address, $role);

        header("Location: index.php?act=listUser");
        exit();
    }


    // Add more methods for editUser and updateUser as needed
}
