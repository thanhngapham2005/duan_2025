<?php
class thongkeslModel{
    public $conn;
    function __construct()
    {
        $this->conn = connDBAss();
    }
    function thongkesl()
    {
        $sql = "SELECT 
    categories.id_category AS id_category, 
    categories.name_cat AS name_cat, 
    SUM(products.amount) AS total_quantity, 
    IFNULL(SUM(detail_bills.quantity), 0) AS sold_quantity  -- Tổng số lượng đã bán của các sản phẩm trong danh mục
FROM 
    products
LEFT JOIN 
    categories
ON 
    products.id_category = categories.id_category
LEFT JOIN 
    detail_bills
ON 
    products.id_product = detail_bills.id_product
GROUP BY 
    categories.id_category, 
    categories.name_cat
ORDER BY 
    categories.id_category DESC;
";

        return $this->conn->query($sql)->fetchAll();
    }

}