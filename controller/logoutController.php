<?php
class logoutController
{
    function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
