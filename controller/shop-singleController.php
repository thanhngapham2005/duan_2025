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
            if (!isset($_SESSION['user']['id_user'])) {
                throw new Exception('Vui lòng đăng nhập');
            }

            // 2. Validate
            $content = trim($_POST['content'] ?? '');
            if (empty($content)) throw new Exception('Nội dung trống');

            $rating = (int)($_POST['rating'] ?? 0);
            if ($rating < 1 || $rating > 5) throw new Exception('Rating 1-5 sao');

            $id_product = (int)($_POST['id_product'] ?? 0);
            if ($id_product <= 0) throw new Exception('Sản phẩm không hợp lệ');

            // 3. Gọi Model
            $success = $this->detailModel->addComment(
                $id_product,
                $_SESSION['user']['id_user'],
                htmlspecialchars($content, ENT_QUOTES, 'UTF-8'),
                $rating
            );

            if (!$success) {
                throw new Exception('Không thể lưu bình luận');
            }

            // 4. Trả về response
            ob_clean();
            echo json_encode([
                'success' => true,
                'data' => [
                    'userName' => $_SESSION['user']['full_name'] ?? 'Bạn',
                    'content' => $content,
                    'rating' => $rating,
                    'date' => date('d/m/Y H:i')
                ]
            ]);
            exit;
        } catch (Exception $e) {
            ob_clean();
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }
}
