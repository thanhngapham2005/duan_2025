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
    
}
