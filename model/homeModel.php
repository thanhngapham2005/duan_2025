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
        $sql = "SELECT * FROM products ORDER BY view DESC LIMIT 8";
        return $this->conn->query($sql)->fetchAll();
    }
}
