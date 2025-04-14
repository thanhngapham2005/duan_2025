<?php
class billModel{
    public $conn;


    public function __construct(){
        $this->conn = connDBAss();
    }
    function bill($status = null) {
        if ($status !== null) {

            $sql = "SELECT * FROM bills WHERE status = $status ORDER BY id_bill DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }else{
            $sql = "SELECT * FROM bills ORDER BY id_bill DESC";
            return $this->conn->query($sql)->fetchAll();
        }
    }
    function findBillById($id) {

        $sql = "SELECT * FROM detail_bills JOIN products ON detail_bills.id_product=products.id_product JOIN variant ON detail_bills.id_variant=variant.id_variant WHERE id_bill=$id";

        return $this->conn->query($sql)->fetchAll();
    }
    function billStatus($id) {
        $sql = "SELECT status FROM bills WHERE id_bill = $id";
        return $this->conn->query($sql)->fetch();
    }

    function updateBill($status, $id_bill){

        $sql = "UPDATE bills SET status = $status WHERE id_bill = $id_bill";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }

    function reduceQuantity($id){
        $sql = "SELECT id_product, id_variant, quantity FROM detail_bills WHERE id_bill = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $details = $stmt->fetchAll();
        foreach($details as $item){

            $id_product = $item['id_product'];
            $id_variant = $item['id_variant'];
            $quantity = $item['quantity'];


            $sqlProduct = "UPDATE products SET amount = amount - $quantity WHERE id_product = $id_product";
            $stmtProduct = $this->conn->prepare($sqlProduct);
            $stmtProduct->execute();

            $sqlVariant = "UPDATE product_variant SET quantity = quantity - $quantity WHERE id_product = $id_product AND id_variant = $id_variant";

            $stmtVariant = $this->conn->prepare($sqlVariant);
            $stmtVariant->execute();
        }
    }
}