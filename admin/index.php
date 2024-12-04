<?php 
include('part/menu.php'); 
require_once('../config/constants.php');
?>

<!-- Main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="padding-bottom: 40px;">Dashboard</h1>

        <?php 
        // Query to get the count of categories
        $sql_categories = "SELECT COUNT(*) AS count FROM tbl_category";
        $res_categories = mysqli_query($conn, $sql_categories);
        $count_categories = mysqli_fetch_assoc($res_categories)['count'];

        // Query to get the count of food items
        $sql_food = "SELECT COUNT(*) AS count FROM tbl_food";
        $res_food = mysqli_query($conn, $sql_food);
        $count_food = mysqli_fetch_assoc($res_food)['count'];

        // Query to get the count of orders
        $sql_orders = "SELECT COUNT(*) AS count FROM tbl_order";
        $res_orders = mysqli_query($conn, $sql_orders);
        $count_orders = mysqli_fetch_assoc($res_orders)['count'];

        // Query to get the count of admins
        $sql_admins = "SELECT COUNT(*) AS count FROM tbl_admin";
        $res_admins = mysqli_query($conn, $sql_admins);
        $count_admins = mysqli_fetch_assoc($res_admins)['count'];
        ?>

        <div class="col-4 text-center" style="margin-left: 160px;">
            <h1><?php echo $count_categories; ?></h1>
            <br>
            Categories
        </div>

        <div class="col-4 text-center">
            <h1><?php echo $count_food; ?></h1>
            <br>
            Food
        </div>

        <div class="col-4 text-center">
            <h1><?php echo $count_admins; ?></h1>
            <br>
            Admins
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Main End -->

<?php include('part/footer.php'); ?>
