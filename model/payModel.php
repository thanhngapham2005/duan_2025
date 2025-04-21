<?php
class payModel {
    public $conn;
    function __construct() {
        $this->conn = connDBAss();
    }

    function saveOrder($id_customer, $receiver_name, $receiver_phone, $receiver_address, $cartItems, $discount_code = null, $discount_amount = 0) {
        try {
            $this->conn->beginTransaction();
            
            // Lấy thông tin mã giảm giá
            $discount_code_id = null;
            if($discount_code) {
                $sql_discount = "SELECT id FROM discount_codes WHERE code = :code";
                $stmt_discount = $this->conn->prepare($sql_discount);
                $stmt_discount->bindParam(':code', $discount_code, PDO::PARAM_STR);
                $stmt_discount->execute();
                $discount_code_id = $stmt_discount->fetchColumn();
            }

            // Đảm bảo discount_amount là số
            $discount_amount = (int)$discount_amount;

            // Thêm đơn hàng vào bảng `bills`
            $sql_bill = "INSERT INTO bills (id_customer, receiver_name, receiver_phone, receiver_address, status, purchase_date, discount_code_id, discount_amount) 
                      VALUES (:id_customer, :receiver_name, :receiver_phone, :receiver_address, 0, CURRENT_TIMESTAMP, :discount_code_id, :discount_amount)";

            // $sql_bill = "INSERT INTO bills (id_customer, receiver_name, receiver_phone, receiver_address, status, 
            //             purchase_date, discount_code_id, discount_amount) 
            //             VALUES (:id_customer, :receiver_name, :receiver_phone, :receiver_address, 0, 
            //             CURRENT_TIMESTAMP, :discount_code_id, :discount_amount)";

            
            $stmt_bill = $this->conn->prepare($sql_bill);
            $stmt_bill->bindParam(':id_customer', $id_customer, PDO::PARAM_INT);
            $stmt_bill->bindParam(':receiver_name', $receiver_name, PDO::PARAM_STR);
            $stmt_bill->bindParam(':receiver_phone', $receiver_phone, PDO::PARAM_STR);
            $stmt_bill->bindParam(':receiver_address', $receiver_address, PDO::PARAM_STR);
            $stmt_bill->bindParam(':discount_code_id', $discount_code_id, PDO::PARAM_INT);
            $stmt_bill->bindParam(':discount_amount', $discount_amount, PDO::PARAM_INT);

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
    
    // Thêm phương thức lấy thông tin mã giảm giá
    function getDiscountInfo($code) {
        $sql = "SELECT * FROM discount_codes WHERE code = :code";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Thêm phương thức lấy danh sách mã giảm giá có sẵn
    function getAvailableDiscountCodes($id_customer = null) {
        $sql = "SELECT * FROM discount_codes";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm phương thức lưu thông tin thanh toán MOMO
    function luuThanhToanMomo($maDonHang, $soTien, $thongTinThanhToan) {
        try {
            $sql = "INSERT INTO momo_payments (order_id, amount, trans_id, payment_date) 
                    VALUES (:order_id, :amount, :trans_id, CURRENT_TIMESTAMP)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':order_id' => $maDonHang,
                ':amount' => $soTien,
                ':trans_id' => $thongTinThanhToan['transId']
            ]);
            
            return true;
        } catch (Exception $e) {
            error_log("Lỗi lưu thanh toán MOMO: " . $e->getMessage());
            return false;
        }
    }

    // Thêm phương thức cập nhật trạng thái đơn hàng
    function capNhatTrangThaiDonHang($maDonHang, $trangThai) {
        try {
            $sql = "UPDATE bills SET status = :status WHERE id_bill = :id_bill";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':status' => $trangThai,
                ':id_bill' => $maDonHang
            ]);
            
            return true;
        } catch (Exception $e) {
            error_log("Lỗi cập nhật trạng thái đơn hàng: " . $e->getMessage());
            return false;
        }
    }
}