<?php
class thongkeslController
{
    public $thongkeslModel;
    function __construct()
    {
        $this->thongkeslModel = new thongkeslModel();
    }
    function listThongkesl()
{
    $thongkesl = $this->thongkeslModel->thongkesl();
    require_once 'view/listthongkesl.php';
}

    function bieudosl(){
        $thongkesl = $this->thongkeslModel->thongkesl();
        require_once 'view/bieudosl.php';
    }
}

?>