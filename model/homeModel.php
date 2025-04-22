<?php
class homeModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connDBAss();
    }
    function topProduct()
    {
        $sql = "SELECT * FROM products order by view desc limit 6";
        return $this->conn->query($sql)->fetchAll();
    }
    
    function getNewestProducts($limit = 3) {
        try {
            // Sử dụng id_product để sắp xếp thay vì created_at
            // vì id_product cao hơn thường là sản phẩm mới hơn
            $sql = "SELECT * FROM products 
                    WHERE censorship = 0 
                    ORDER BY id_product DESC 
                    LIMIT " . $limit;
            
            return $this->conn->query($sql)->fetchAll();
        } catch (PDOException $e) {
            error_log("Lỗi lấy sản phẩm mới nhất: " . $e->getMessage());
            return [];
        }
    }
    
    function getProductNames() {
        try {
            $sql = "SELECT name FROM products WHERE status = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            error_log("Lỗi lấy tên sản phẩm: " . $e->getMessage());
            return [];
        }
    }
    
    function searchProducts($keyword) {
        try {
            $sql = "SELECT * FROM products 
                    WHERE name LIKE :keyword 
                    AND censorship = 0 
                    ORDER BY id_product DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['keyword' => "%$keyword%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi tìm kiếm sản phẩm: " . $e->getMessage());
            return [];
        }
    }
}
