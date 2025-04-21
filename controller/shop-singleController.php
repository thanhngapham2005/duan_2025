<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
class detailController
{
    public $detailModel;

    function __construct()
    {
        $this->detailModel = new detailModel();
    }

    function detail($id)
    {
        $productOne = $this->detailModel->findProductById($id);
        $comments = $this->detailModel->allComment($id);
        $product_variant = $this->detailModel->product_variant($id);
        $relatedProducts = $this->detailModel->relatedProduct($productOne['id_category'], $id);

        require_once 'view/shop-single.php';
    }

    function addComment()
    {
        header('Content-Type: application/json');

        try {
            // 1. Kiểm tra đăng nhập
            if (!isset($_SESSION['user'])) {
                throw new Exception('Vui lòng đăng nhập để bình luận');
            }

            // 2. Validate dữ liệu
            $content = trim($_POST['content'] ?? '');
            $rating = (int)($_POST['rating'] ?? 0);
            $id_product = (int)($_POST['id_product'] ?? 0);

            if (empty($content)) {
                throw new Exception('Vui lòng nhập nội dung bình luận');
            }
            if ($rating < 1 || $rating > 5) {
                throw new Exception('Vui lòng chọn số sao đánh giá (1-5 sao)');
            }
            if ($id_product <= 0) {
                throw new Exception('Sản phẩm không hợp lệ');
            }

            // 3. Gọi Model để lưu bình luận
            $success = $this->detailModel->addComment(
                $id_product,
                $_SESSION['user']['id_user'],
                $content,
                $rating
            );

            if (!$success) {
                throw new Exception('Không thể lưu bình luận');
            }

            // 4. Trả về response thành công
            echo json_encode([
                'success' => true,
                'data' => [
                    'userName' => $_SESSION['user']['full_name'],
                    'content' => $content,
                    'rating' => $rating,
                    'date' => date('Y-m-d H:i:s')
                ],
                'message' => 'Bình luận thành công!'
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        exit;
    }
}
