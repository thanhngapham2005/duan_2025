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
        try {
            $conn = connDBAss();
            $conn->beginTransaction();

            // Thêm user vào bảng users
            $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, 0)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            // Lấy ID của user vừa tạo
            $userId = $conn->lastInsertId();

            // Thêm user vào bảng customers (để fullname, address, phone rỗng)
            $stmt = $conn->prepare("INSERT INTO customers (id_user, full_name, address, phone) VALUES (:id_user, '', '', '')");
            $stmt->bindParam(':id_user', $userId);
            $stmt->execute();

            $conn->commit();
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            return false;
        }
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


    public function updateUser($id, $role)
    {
        $conn = connDBAss();

        // Kiểm tra kiểu dữ liệu của role
        if (!is_numeric($role)) {
            $role = ($role === 'admin') ? 2 : 0;  // Chuyển đổi admin = 1, user = 0
        }


        // Cập nhật bảng users
        $query = "UPDATE users 
              SET role = :role 
              WHERE id_user = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}