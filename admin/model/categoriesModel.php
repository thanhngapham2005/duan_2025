<?php

class categoriesModel
{
    public $conn;
    function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=duan", "root", "", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Lỗi kết nối: " . $e->getMessage());
        }
    }



    function insert_categories($tenloai){
        $sql = "INSERT INTO categories(name_cat) VALUES(:tenloai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai'=>$tenloai]);
    }
   function check_categories_exists($tenloai){
        $sql = "SELECT COUNT(*) as count FROM categories WHERE name_cat = :tenloai";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai'=>$tenloai]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;// Nếu tồn tại thì trả về true
    }
     function loadall_categories(){
        $sql = "SELECT * FROM categories ORDER BY id_category DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_categories($id_category) {
        $sql = "DELETE FROM categories WHERE id_category = :id_category"; // Sửa SQL
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id_category' => $id_category]); // Sửa key trong execute()
    }
    
    function loadone_categories($id_category){
        $sql = "SELECT * FROM categories WHERE id_category = :id_category";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_category' => $id_category]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function update_categories($id_category, $tenloai){
        $sql = "UPDATE categories SET name_cat = :tenloai WHERE id_category = :id_category";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai' => $tenloai,  ':id_category' => $id_category]);
    }

}
?>
