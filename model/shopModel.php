<?php
include_once __DIR__ . '/../commoms/function.php';
class shopModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connDBAss();
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
    function cat_pro($id) {
        $sql = "SELECT * FROM products WHERE id_category = :id_category";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_category', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
}