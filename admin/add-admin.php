<?php include('part/menu.php');?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>

            <br><br>

            <form action="" method="post">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Your Username"></td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary"> 
                        </td>
                    </tr>

                </table>
                
            </form>

        </div>
    </div>
    
<?php include('part/footer.php');?>


<?php

    // Process for database storage
    if (isset($_POST['submit'])) 
    {
        // Get data from form
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']); // Note: MD5 is not secure for passwords

        // SQL Query to save to Database
        $sql = "INSERT INTO tb_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        // Execute Query and save Data to Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // Check if insertion was successful
        if($res==TRUE)
        {
            echo "Data Inserted Successfully";
        }
        else
        {
            echo "Failed to Insert Data";
        }
    }
    
?>