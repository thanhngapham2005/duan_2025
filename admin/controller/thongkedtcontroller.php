<?php
class thongkedtcontroller{
    public $thongkedtModel;
    function __construct()
    {
        $this->thongkedtModel = new thongkedtModel();
    }
    function listThongkedt(){
        $thongkedt = $this->thongkedtModel->thongkedt();
        require_once 'view/listthongkedt.php';
    }
    function bieudodt(){
        $thongkedt = $this->thongkedtModel->thongkedt();
        require_once 'view/bieudodt.php';
    }
    
    
}