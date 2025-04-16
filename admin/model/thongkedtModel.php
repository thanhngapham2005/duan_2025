<?php
class thongkedtModel{
    public $conn;
    function __construct()
    {
        $this->conn = connDBAss();
    }
    function thongkedt(){
        $sql = "
        SELECT 
            categories.id_category AS id_category, 
            categories.name_cat AS name_cat, 
            SUM(products.amount) AS total_quantity, -- Tổng số lượng sản phẩm còn trong kho
            SUM(detail_bills.price) AS total_revenue -- Tổng doanh thu
        FROM 
            products
        LEFT JOIN 
            categories
        ON 
            products.id_category = categories.id_category
        LEFT JOIN 
            detail_bills
        ON 
            products.id_product = detail_bills.id_product -- Giả sử hai bảng liên kết qua id_product
        GROUP BY 
            categories.id_category, 
            categories.name_cat
        ORDER BY 
            categories.id_category DESC
    ";
        return $this->conn->query($sql)->fetchAll();
    }
}
?>