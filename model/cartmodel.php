<?php
require_once __DIR__ . '/../commoms/function.php'; // Đảm bảo bạn có file này để kết nối database

class CartModel {
    private $conn;

    public function __construct() {
        $this->conn = connDBAss(); // Kết nối database
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($id_bill,$id_customer, $receiver_name, $receiver_phone, $receiver_address, $status, $purchase_date) {
        $query = "INSERT INTO cart (id_bill, id_customer,, receiver_name, receiver_phone, receiver_address, status, purchase_date) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id_bill, $id_customer, $receiver_name, $receiver_phone, $receiver_address, $status, $purchase_date]);
    }

    // Lấy danh sách giỏ hàng của user
    public function getCart($user_id) {
        $query = "SELECT * FROM cart WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function deleteToCart($cart, $id_bill) {
        $query = "DELETE FROM cart WHERE id = ? AND id_bill = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$cart, $id_bill]);
    }

    // Xóa toàn bộ giỏ hàng của user
    public function clearCart($user_id) {
        $query = "DELETE FROM cart WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$user_id]);
    }
}
