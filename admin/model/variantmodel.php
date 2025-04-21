<?php
class variantModel{
    public $conn;

    function __construct(){
        $this->conn = connDBAss();
    }
    function insert_variant($tenloai, $dungluong){
        $sql = "INSERT INTO variant(name_color, name_capacity) VALUES(:tenloai, :dungluong)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai' => $tenloai, ':dungluong' => $dungluong]);
    }
    function check_variant_exists($tenloai, $dungluong){
        $sql = "SELECT COUNT(*) as count FROM variant WHERE name_color = :tenloai AND name_capacity = :dungluong";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai' => $tenloai, ':dungluong' => $dungluong]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    function delete_variant($id_variant) {
        try {
            $sql = "DELETE FROM variant WHERE id_variant = :id_variant";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id_variant' => $id_variant]);
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { 
                
                return "Không thể xoá biến thể vì vẫn còn sản phẩm thuộc danh mục này.";
            }
            return "Lỗi xảy ra khi xoá biến thể: " . $e->getMessage();
        }
    }
    
    function loadall_variant(){
        // Sửa câu truy vấn để bao gồm cả cột name_capacity
        $sql = "SELECT id_variant, name_color, name_capacity FROM variant ORDER BY id_variant DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function loadone_variant($id_variant){
        $sql = "SELECT * FROM variant WHERE id_variant = :id_variant";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_variant' => $id_variant]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function update_variant($id_variant, $tenloai, $dungluong){
        $sql = "UPDATE variant SET name_color = :tenloai, name_capacity = :dungluong WHERE id_variant = :id_variant";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai' => $tenloai, ':dungluong' => $dungluong, ':id_variant' => $id_variant]);
    }
}