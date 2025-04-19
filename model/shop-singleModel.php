<?php
class detailModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connDBAss();
    }
    function product_variant($id)
    {
        // Sửa truy vấn để lấy thông tin dung lượng và màu sắc từ bảng variant
        $sql = "SELECT pv.*, v.*, v.name_color, v.name_capacity as capacity 
                FROM product_variant pv 
                JOIN variant v ON pv.id_variant = v.id_variant 
                WHERE pv.id_product = :id_product";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_product', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function findProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id_product=$id";
        return $this->conn->query($sql)->fetch();
    }
    // function updateView($id){
    //     $sql = "UPDATE products SET view = view + 1 WHERE id_product=$id";
    //     return $this->conn->query($sql);
    // }
    function relatedProduct($id_category, $id_product)
    {
        $sql = "SELECT * FROM products WHERE id_category = :id_category AND id_product != :id_product LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_category' => $id_category, 'id_product' => $id_product]);
        return $stmt->fetchAll();
    }
    function allComment($id)
    {
        $sql = "SELECT * FROM comments JOIN customers ON comments.id_user=customers.id_user WHERE id_product=$id";
        return $this->conn->query($sql)->fetchAll();
    }
    // function getAverageRating($id_product)
    // {
    //     $sql = "SELECT AVG(point) as avg_rating, COUNT(point) as total_ratings FROM rates WHERE id_product = $id_product";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute();
    //     return $stmt->fetch();
    // }

    function addComment($id_product, $id_user, $content, $rating)
    {
        try {
            // 1. Kiểm tra kết nối
            if (!$this->conn) {
                throw new Exception('Không thể kết nối database');
            }

            // 2. Chuẩn bị query theo ĐÚNG cấu trúc bảng
            $sql = "INSERT INTO comments 
                (id_product, id_user, content, rating, day_post, censorship) 
                VALUES 
                (:id_product, :id_user, :content, :rating, NOW(), 0)";

            $stmt = $this->conn->prepare($sql);

            // 3. Bind parameters
            $stmt->bindParam(':id_product', $id_product, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);

            // 4. Thực thi
            if ($stmt->execute()) {
                return true;
            } else {
                $error = $stmt->errorInfo();
                error_log("SQL Error: " . $error[2]);
                return false;
            }
        } catch (PDOException $e) {
            error_log("PDOException: " . $e->getMessage());
            return false;
        }
    }


    function hasPurchasedProduct($id_pro)
    {
        // Kiểm tra cả trường hợp chưa login (session không có user)
        if (!isset($_SESSION['user'])) {
            return false;
        }

        $id_user = $_SESSION['user']['id_user'];

        $sql = "SELECT COUNT(*) 
            FROM bills b
            JOIN detail_bills db ON b.id_bill = db.id_bill
            WHERE b.id_customer IN (
                SELECT id_customer FROM customer WHERE id_user = ?
            )
            AND db.id_product = ?
            AND b.status = 5"; // Giả sử status=5 là đơn hàng đã hoàn thành

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_user, $id_pro]);
        return $stmt->fetchColumn() > 0;
    }
    function commentLimitReached($id_user, $id_pro)
    {
        $sql = "SELECT COUNT(*) 
            FROM comments 
            WHERE id_user = ? 
            AND id_product = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_user, $id_pro]);
        return $stmt->fetchColumn() >= 2; // Trả về true nếu >= 2 comment
    }
}
