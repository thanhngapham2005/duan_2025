<?php
class detailModel{
    public $conn;
    function __construct()
    {
        $this->conn = connDBAss();
    }
    function product_variant($id){
        $sql = "SELECT * FROM product_variant JOIN variant ON product_variant.id_variant=variant.id_variant WHERE id_product=$id";
        return $this->conn->query($sql)->fetchAll();
    }
    function findProductById($id){
        $sql = "SELECT * FROM products WHERE id_product=$id";
        return $this->conn->query($sql)->fetch();
    }
    // function updateView($id){
    //     $sql = "UPDATE products SET view = view + 1 WHERE id_product=$id";
    //     return $this->conn->query($sql);
    // }
    function relatedProduct($id_category, $id_product){
        $sql = "SELECT * FROM products WHERE id_category = :id_category AND id_product != :id_product LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_category' => $id_category, 'id_product' =>$id_product]);
        return $stmt->fetchAll();
    }
    // function allComment($id){
    //     $sql = "SELECT * FROM comments JOIN customers ON comments.id_user=customers.id_user WHERE id_product=$id";
    //     return $this->conn->query($sql)->fetchAll();
    // }
    function getAverageRating($id_product){
        $sql = "SELECT AVG(point) as avg_rating, COUNT(point) as total_ratings FROM rates WHERE id_product = $id_product";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
}