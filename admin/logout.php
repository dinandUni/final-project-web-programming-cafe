<?php
    include('../config/constants.php');

    //Mengapus Session
    session_destroy();

    //Mengarahkan ke Login Page
    header('location'.SITEURL.'admin/login.php');
?>