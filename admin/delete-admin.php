<?php
    include('../config/constants.php');

    //Cari id admin untuk di hapus
    $id = $_GET['id'];

    //Query buat hapus admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute query
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to Deleted Admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>