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
    
    // Hàm này không cần thiết vì đã có allCategory
    function get_all_categories() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    
    // Thêm hàm lấy tên danh mục theo ID
    function getCategoryName($id) {
        $sql = "SELECT name_cat FROM categories WHERE id_category = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['name_cat'] : 'Không tìm thấy';
    }
}

