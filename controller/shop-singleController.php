<?php
class detailController{
    public $detailModel;
    function __construct()
    {
        $this->detailModel = new detailModel();
    } 

    function detail($id){
        // $this->detailModel->updateView($id);
        $productOne = $this->detailModel->findProductById($id);
        // $comments = $this->detailModel->allComment($id);
        $product_variant = $this->detailModel->product_variant($id);

        $ratingData = $this->detailModel->getAverageRating($productOne['id_product']);
        $avgRating = isset($ratingData['avg_rating']) ? (float) $ratingData['avg_rating'] : 0;
        // $totalRatings = isset($ratingData['total_ratings']) ? (int) $ratingData['total_ratings'] : 0;

        $relatedProducts = $this->detailModel->relatedProduct($productOne['id_category'], $id);
        require_once 'view/shop-single.php';
    }
}