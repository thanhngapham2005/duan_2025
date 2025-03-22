<?php

require_once 'commoms/function.php';

function checkLogin($email, $password)
{
    try {
        $conn = connDBAss();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $stmt = $conn->prepare("SELECT * FROM customers WHERE id_user = ?");
            $stmt->execute([$user['id_user']]);
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($customer) {
                $user['customer_info'] = $customer;
            }
            return $user;
        }
        return false;
    } catch (PDOException $e) {
        return false;
    }
}


function checkEmailExists($email)
{
    try {
        $conn = connDBAss();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        return false;
    }
}

function registerUser($fullname, $email, $password)
{

    try {
        $conn = connDBAss();
        $conn->beginTransaction();

        $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, 0)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->execute([$email, $hashedPassword]);
        $userId = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO customers (id_user, full_name, address, phone)
     VALUES (?, ?, '','' )");
        $stmt->execute([$userId, $fullname]);
        $conn->commit();
        return true;
    } catch (PDOException $e) {
        if ($conn) {
            $conn->rollBack();
        }
        return false;
    }
}

function updateUserProfile($userId, $fullname, $address, $phone, $password = null)
{
    try {
        $conn = connDBAss();
        $stmt = $conn->prepare("UPDATE customers SET full_name = ?,
         address = ?, phone = ? WHERE id_user = ?");
        $stmt->execute([$fullname, $address, $phone, $userId]);
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id_user = ?");
            $stmt->execute([$hashedPassword, $userId]);
        }

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function getUserProfile($email)
{
    try {
        $conn = connDBAss();
        $sql = "SELECT u.email, c.full_name, c.address, c.phone, u.password 
            FROM users u
            JOIN customers c ON u.id_user = c.id_user
            WHERE u.email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

// Compare this snippet from controller/logoutController.php: