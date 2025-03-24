<?php
class variantModel{
    public $conn;

    function __construct(){
        $this->conn = connDBAss();
    }
    function insert_variant($tenloai){
        $sql = "INSERT INTO variant(name_color) VALUES(:tenloai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai' => $tenloai]);
    }
    function check_variant_exists($tenloai){
        $sql = "SELECT COUNT(*) as count FROM variant WHERE name_color = :tenloai";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai' => $tenloai]);
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
        $sql = "SELECT * FROM variant ORDER BY id_variant DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function loadone_variant($id_variant){
        $sql = "SELECT * FROM variant WHERE id_variant = :id_variant";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_variant' => $id_variant]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function update_variant($id_variant, $tenloai){
        $sql = "UPDATE variant SET name_color = :tenloai WHERE id_variant = :id_variant";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai' => $tenloai, ':id_variant' => $id_variant]);
    }
}