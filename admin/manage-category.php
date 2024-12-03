<?php include('part/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <br /><br />


        <!-- Button add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_category";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            // nomor seri
            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>

                    <tr>
                        <td><?php echo $sn++ ?> </td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                                if($image_name != "") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="60px">
                                    <?php
                                } else {
                                    echo "<div class='error'>Image not added.</div>";

                                }
                            ?>
                        </td>
                        <td><?php echo $featured?></td>
                        <td><?php echo $active?></td>
                        <td>
                            <a href="#" class="btn-secondary">Update</a>
                            <a href="#" class="btn-danger">Delete</a>
                        </td>
                    </tr>

            <?php

                }
            } else {
                echo "<tr><td colspan='6'><div class='error'>No Category Added.</div></td></tr>";
            }
            ?>


        </table>
    </div>
</div>

<?php include('part/footer.php'); ?>