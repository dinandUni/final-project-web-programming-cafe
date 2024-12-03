<?php 
    // cek apakah id dan image_name sudah di set atau belum
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        // get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != ""){
            $path = "../images/food/".$image_name;

            $remove = unlink($path);

            if($remove == false){
                $_SESSION['remove'] = "<div class='error'>Failed to remove image file</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        // remove the data from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res == true){
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else{
        // redirect to manage-food.php
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>