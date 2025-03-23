<?php
// usermodel.php

require_once __DIR__ . '/../../commoms/function.php'; // Include your database connection file

class UserModel
{
    public function getAllUsers()
    {
        $conn = connDBAss();
        $query = "SELECT id_user, email FROM users";
        $stmt = $conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertUser($email, $password)
    {
        $conn = connDBAss();
        $query = "INSERT INTO users (email, password, role) VALUES (:email, :password, 0)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }

    public function deleteUser($id)
    {
        $conn = connDBAss();
        $query = "DELETE FROM users WHERE id_user = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    function checkUser($email, $password)
    {
        try {
            $conn = connDBAss();
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra user có tồn tại và mật khẩu có đúng không
            if ($user && password_verify($password, $user['password'])) {
                return $user; // Trả về thông tin user nếu mật khẩu đúng
            }

            return false; // Trả về false nếu tài khoản không tồn tại hoặc mật khẩu sai
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getUserById($id)
    {
        $conn = connDBAss();
        $query = "SELECT 
                u.id_user, 
                u.email, 
                u.password, 
                u.role, 
                c.full_name, 
                c.phone, 
                c.address
              FROM users u
              LEFT JOIN customers c ON u.id_user = c.id_user
              WHERE u.id_user = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateUser($id, $email, $full_name, $phone, $address, $role)
    {
        $conn = connDBAss();

        // Kiểm tra kiểu dữ liệu của role
        if (!is_numeric($role)) {
            $role = ($role === 'admin') ? 2 : 0;  // Chuyển đổi admin = 1, user = 0
        }


        // Cập nhật bảng users
        $query = "UPDATE users 
              SET email = :email, role = :role 
              WHERE id_user = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Cập nhật bảng customers
        $query_customer = "UPDATE customers 
                       SET full_name = :full_name, phone = :phone, address = :address 
                       WHERE id_user = :id";

        $stmt_customer = $conn->prepare($query_customer);
        $stmt_customer->bindParam(':full_name', $full_name);
        $stmt_customer->bindParam(':phone', $phone);
        $stmt_customer->bindParam(':address', $address);
        $stmt_customer->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_customer->execute();
    }
}