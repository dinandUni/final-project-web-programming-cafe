<?php 
    include('../config/constants.php');

    // cek apakah id dan image_name sudah di set atau belum
    if(isset($_GET['id']) AND isset($_GET['image'])){
        // get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image'];

        if($image_name != ""){
            $path = "../images/category/".$image_name;

            $remove = unlink($path);

            if($remove == false){
                $_SESSION['remove'] = "<div class='error'>Failed to remove image file</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        // remove the data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res == true){
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Failed to delete Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        // redirect to manage-food.php
        header('location:'.SITEURL.'admin/manage-category.php');

    }
?>