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

    // Add more methods for editUser and updateUser as needed
}