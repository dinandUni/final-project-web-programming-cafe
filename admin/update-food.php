<?php include('partials/menu.php')?>

<?php 
    if(isset($_GET['id'])){
        //Get all details
        $id = $_GET['id'];

        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        //execute Query
        $res2 = mysqli_query($conn, $sql2);

        //Ambil satu baris data dari db
        $row2 = mysqli_fetch_assoc($res2);

        $title = $row2['title'];
        $descriptiom = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }else{
        //SITEURL -> Variable global untuk menyimpan URL
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" me""thod="POST" enctype="multipart/form-data">
            <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Description</td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $decription; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                    <?php 
                        if($current_image == ""){
                        echo "<div class='eror'>Image not Available.</div>";
                        }else{
                            ?>
                            <img src="<?php echo SITEURL; ?>image/food/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category" >
                        <?php 
                            //Query to Get Active Categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //Ecxecute the Query
                            $res = mysqli_query($conn, $sql);
                            $cont = mysqli_num_rows($res);

                            if($count>0){
                                while($row=mysqli_fetch_assoc($res)){
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }else{
                                echo "<option value='0'>Category Not Available.</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="Featured" value="Yes"> Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="Featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<php echo $current_image; ?>">
                    <input type="submit" name="submit" value="Update" class="btn-secondary">
                </td>
            </tr>

            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])){
                //1. Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $decription = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Uploade the image if selected

                //Check whether upload button is clicked or not
                if(isset($_FILES['image']['name'])){
                    //Upload Button Clicked
                    $image_name = $_FILES['image']['name'];//New Image Name

                    //Check whether the file is available or not
                    if($image_name!=""){
                        //Image is Available
                        //A. Uploading New Image
                        //Rename the Image
                        $ext = end(explode(',', $image_name)); //Gets the extentions of the image

                        $image_name = "Food-Name-".rand(0000, 9999).','.$ext; //This be will rename image

                        //Get the Source Path and Destination Path
                        $src_path = $_FILES['image']['tmp_name'];//Source Part
                        $dest_path = "../images/food/".$image_name;//Destination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path;

                        //Check whether the image is uploaded or not
                        if($upload=false){
                            //Failed to upload
                            $_SESSION['upload'] = "<div class='error'>Failled to Upload new Image.</div>";
                            //Redirect to Manage Food
                            header('location:'.SITEURL.'admin.manage-food.php');
                            //Stop the Process
                            die();
                        }

                        //3. Remove the image if new image is uploaded and current image exits
                        //B. Remove current"" Image if Available
                        if($current_image!=""){
                            //Current image if Available
                            //Remove the image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false){
                                //Failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
                                //Redirect to manage food
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //Stop the process
                                die();
                            }
                        }
                    }else{
                        $image_name = $current_image;
                    }
                }else{
                    $image_name = $current_image;
                }


                //4. Update the  Food in Database
                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $pride,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //execute Query
                $res3 = mysqli_query($conn, $sql3);

                //Check whether the query is executed or not
                if($res3==true){
                    //Query executed and Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }else{
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='eror'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>

    </div>
</div>
<?php include('partials/footer.php')?>