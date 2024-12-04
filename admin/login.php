<?php 
include('../config/constants.php'); 
// Check if session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

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
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <br><br>

        <!-- Login Form -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
        </form>
        <p class="text-center">Created By - <a href="https://github.com/dinandUni/final-project-web-programming-cafe.git">CSS Belakangan</a></p>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    // Sanitize input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM tbl_admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows == 1) {
        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username;
        header('location:' . SITEURL . 'admin/index.php');
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>
