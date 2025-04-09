<?php
class discountModel{
    public $conn;

    public function __construct()
    {
        $this->conn = connDBAss();
    }
    function getAll($status = null){
        if($status !== null){
            $sql = "SELECT * FROM discount_codes WHERE status = ? ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$status]);
            return $stmt->fetchAll();
        }else{
            $sql = "SELECT * FROM discount_codes ORDER BY created_at DESC";
            return $this->conn->query($sql)->fetchAll();
        }
    }
    function findById($id){
        $sql = "SELECT * FROM discount_codes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    function create($data){
        $sql = "INSERT INTO discount_codes (id, code, discount_percentage, max_discount, min_order_value,
                start_date, end_date, usage_limit, used_count, status, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['id'], $data['code'], $data['discount_percentage'], $data['max_discount'], $data['min_order_value'],
            $data['start_date'], $data['end_date'], $data['usage_limit'], $data['used_count'], 
            $data['status'], $data['created_at'], $data['updated_at']
        ]);
    }
    function update($id, $data){
        $sql = "UPDATE discount_codes SET code=?, discount_percentage=?, max_discount=?, min_order_value=?,
                start_date=?, end_date=?, usage_limit=?, used_count=?, status=?, updated_at=?
                WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['code'], $data['discount_percentage'], $data['max_discount'], $data['min_order_value'], 
            $data['start_date'], $data['end_date'], $data['usage_limit'], $data['used_count'], 
            $data['status'], $data['updated_at'], $id
        ]);
    }
    function delete($id){
        $sql = "DELETE FROM discount_codes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}