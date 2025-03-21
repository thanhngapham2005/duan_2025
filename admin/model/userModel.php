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
    public function checkuser($email, $password)
    {
        $conn = connDBAss();
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Add more methods for updateUser as needed
    }
}