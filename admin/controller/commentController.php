<?php
class CommentController
{
    private $commentModel;
    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }
    public function listComments()
    {
        $comments = $this->commentModel->getAllComments();
        require_once 'view/listComments.php';
    }
    public function deleteComment($id_comment)
    {
        if ($this->commentModel->deleteComment($id_comment)) {
            header("Location: ?act=listComments");
        } else {
            echo "Xóa không thành công";
        }
    }
    function toggleCensorship($id_comment, $current_status)
    {
        $new_status = $current_status == 0 ? 1 : 0;
        if ($this->commentModel->updateCensorship($id_comment, $new_status)) {
            header("Location: ?act=listComments");
        } else {
            echo "Cập nhật không thành công";
        }
    }
}