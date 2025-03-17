<?php
ob_start();
session_start();
require_once __DIR__ . '/../commoms/function.php';

include 'view/layout/header.php';
include 'view/layout/footer.php';
include 'view/layout/navbar.php';
include 'view/layout/scripts.php';
include 'view/layout/topbar.php';
include 'view/dashboard.php';
ob_end_flush();