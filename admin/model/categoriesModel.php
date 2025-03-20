<?php
class categoriesModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connDBAss();// Giả sử hàm này trả về kết nối PDO
    }
    public function insert_categories($tenloai){
        $sql = "INSERT INTO categories(name_cat) VALUES(:tenloai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai'=>$tenloai]);
    }
    public function check_categories_exists($tenloai){
        $sql = "SELECT COUNT(*) FROM categories WHERE name_cat = :tenloai";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tenloai'=>$tenloai]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] >0;// Nếu tồn tại thì trả về true
    }
    public function loadall_categories(){
        $sql = "SELECT * FROM categories ORDER BY id_category DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}