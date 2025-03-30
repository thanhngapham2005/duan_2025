<?php
class payModel {
    public $conn;
    function __construct() {
        $this->conn = connDBAss();
    }

    function saveOrder($id_customer, $receiver_name, $receiver_phone, $receiver_address, $cartItems) {
        try {
            // Bắt đầu transaction để đảm bảo toàn bộ thao tác thành công
            $this->conn->beginTransaction();

            // Thêm đơn hàng vào bảng `bills`
            $sql_bill = "INSERT INTO bills (id_customer, receiver_name, receiver_phone, receiver_address, status, purchase_date) 
                          VALUES (:id_customer, :receiver_name, :receiver_phone, :receiver_address, 0, CURRENT_TIMESTAMP)";
            $stmt_bill = $this->conn->prepare($sql_bill);
            $stmt_bill->bindParam(':id_customer', $id_customer, PDO::PARAM_INT);
            $stmt_bill->bindParam(':receiver_name', $receiver_name, PDO::PARAM_STR);
            $stmt_bill->bindParam(':receiver_phone', $receiver_phone, PDO::PARAM_STR);
            $stmt_bill->bindParam(':receiver_address', $receiver_address, PDO::PARAM_STR);
            if (!$stmt_bill->execute()) {
                print_r($stmt_bill->errorInfo());
                exit;
            }
            
            $id_bill = $this->conn->lastInsertId();
            if (!$id_bill) {
                throw new Exception("Lỗi: Không thể tạo đơn hàng.");
            }

            // Duyệt từng sản phẩm trong giỏ hàng
            foreach ($cartItems as $item) {
                $id_product = $item['id'];
                $name_product = $item['name'];
                $price = $item['price'];
                $quantity = $item['quantity'];
                $variant_text = $item['color'];

                // Lấy ID của biến thể sản phẩm
                $sql_get_variant = "SELECT pv.id_variant FROM product_variant pv 
                                   JOIN variant v ON pv.id_variant = v.id_variant
                                   WHERE pv.id_product = :id_product AND v.name_color = :variant_text";
                $stmt_get_variant = $this->conn->prepare($sql_get_variant);
                $stmt_get_variant->bindParam(':id_product', $id_product, PDO::PARAM_INT);
                $stmt_get_variant->bindParam(':variant_text', $variant_text, PDO::PARAM_STR);
                $stmt_get_variant->execute();
                $id_variant = $stmt_get_variant->fetchColumn();

                if (!$id_variant) {
                    throw new Exception("Không tìm thấy biến thể '$variant_text' cho sản phẩm '$name_product'.");
                }

                // Kiểm tra số lượng sản phẩm trong kho
                $sql_check_product = "SELECT amount FROM products WHERE id_product = :id_product";
                $stmt_check_product = $this->conn->prepare($sql_check_product);
                $stmt_check_product->bindParam(':id_product', $id_product, PDO::PARAM_INT);
                $stmt_check_product->execute();
                $available_amount = $stmt_check_product->fetchColumn();

                if ($available_amount < $quantity) {
                    throw new Exception("Sản phẩm '$name_product' không đủ số lượng trong kho.");
                }

                // Kiểm tra số lượng biến thể sản phẩm
                $sql_check_variant = "SELECT quantity FROM product_variant WHERE id_product = :id_product AND id_variant = :id_variant";
                $stmt_check_variant = $this->conn->prepare($sql_check_variant);
                $stmt_check_variant->bindParam(':id_product', $id_product, PDO::PARAM_INT);
                $stmt_check_variant->bindParam(':id_variant', $id_variant, PDO::PARAM_INT);
                $stmt_check_variant->execute();
                $available_variant_quantity = $stmt_check_variant->fetchColumn();

                if ($available_variant_quantity < $quantity) {
                    throw new Exception("Sản phẩm '$name_product' với màu '$variant_text' không đủ số lượng trong kho.");
                }

                // Thêm chi tiết đơn hàng vào bảng `detail_bills`
                $sql_detail = "INSERT INTO detail_bills (id_bill, id_product, id_variant, name_product, price, quantity) 
                               VALUES (:id_bill, :id_product, :id_variant, :name_product, :price, :quantity)";
                $stmt_detail = $this->conn->prepare($sql_detail);
                $stmt_detail->bindParam(':id_bill', $id_bill, PDO::PARAM_INT);
                $stmt_detail->bindParam(':id_product', $id_product, PDO::PARAM_INT);
                $stmt_detail->bindParam(':id_variant', $id_variant, PDO::PARAM_INT);
                $stmt_detail->bindParam(':name_product', $name_product, PDO::PARAM_STR);
                $stmt_detail->bindParam(':price', $price, PDO::PARAM_INT);
                $stmt_detail->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt_detail->execute();
            }

            // Nếu tất cả thành công, commit transaction
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            // Nếu có lỗi, rollback transaction
            $this->conn->rollBack();
            $_SESSION['payment_status'] = 'error';
            $_SESSION['payment_message'] = $e->getMessage();
            return false;
        }
    }
}
