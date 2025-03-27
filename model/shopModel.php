<?php
require_once __DIR__ . '/../commoms/function.php';
class shopModel{

    public $conn;
    function __construct()
    {
        $this->conn = connDBAss();
    }
    function cat_pro($id) {
        $sql="SELECT * FROM products WHERE id_category = $id";
        return $this->conn->query($sql)->fetchAll();
    }
    function allCategory()
    {
        $sql = "SELECT * FROM categories";
        $result = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    function allProduct(){
        $sql = "SELECT * FROM products ORDER BY id_product DESC";
        $result = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function searchProducts($search) {
        $sql = "SELECT * FROM products WHERE name LIKE :search";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['search' => '%' . $search . '%']);
        return $stmt->fetchAll();
    }
    
}

