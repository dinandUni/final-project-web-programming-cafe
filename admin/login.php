<?php include('../config/constants.php')?>

<html>
    <head>
        <title>Login - Food Order</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
            
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset ($_SESSION['no-login-message']);
                }
            
            ?>

            <br><br>

            <!-- Login -->

            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
            </form>

            <!-- Login End -->

            <p class="text-center">Created By - <a href="https://github.com/dinandUni/final-project-web-programming-cafe.git">CSS Belakangan</a></p>
        </div>

    </body>
</html>

<?php

    //Check wheter the Submit Button is Clicked or Not
    if(isset($_POST['submit']))
    {
        //Proses buat login - Nya
        //Ngambil data dari form Login
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //SQL buat cek user pakai username sama password bisa atau ga
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        //Execute Query
        $res = mysqli_query($conn, $sql);

        //Count rows to check wheter the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // User ada dan Login berhasil
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;

            // Melanjutkan ke Home Page/ Dashboard
            header('location'.SITEURL.'admin/login.php');
        }
        else
        {
            // User ada dan Login berhasil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
            // Melanjutkan ke Home Page/ Dashboard
            header('location'.SITEURL.'admin/login.php');
        }
    }

?>
