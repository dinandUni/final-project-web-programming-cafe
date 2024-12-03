<?php 
include('part/menu.php'); 

// Helper function for redirection with a message
function redirect_with_message($url, $message, $type = 'success') {
    $_SESSION[$type] = "<div class='$type'>$message</div>";
    header("location:$url");
    exit;
}

// Fetch category details
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Secure integer casting

    // Prepared statement to fetch category
    $stmt = $conn->prepare("SELECT * FROM tbl_category WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = htmlspecialchars($row['title']);
        $current_image = $row['image'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        redirect_with_message(SITEURL . 'admin/manage-category.php', 'Category not found', 'error');
    }
    $stmt->close();
} else {
    redirect_with_message(SITEURL . 'admin/manage-category.php', 'Invalid access', 'error');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php if ($current_image): ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" alt="Current Image" width="100px">
                        <?php else: ?>
                            <div class="error">Image not added</div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image" accept="image/*"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php echo ($featured == "Yes") ? "checked" : ""; ?>> Yes
                        <input type="radio" name="featured" value="No" <?php echo ($featured == "No") ? "checked" : ""; ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php echo ($active == "Yes") ? "checked" : ""; ?>> Yes
                        <input type="radio" name="active" value="No" <?php echo ($active == "No") ? "checked" : ""; ?>> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = intval($_POST['id']);
            $title = htmlspecialchars($_POST['title']);
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            $image_name = $current_image; // Default to current image
            if (!empty($_FILES['image']['name'])) {
                $image_name = "Category_" . rand(000, 999) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $upload_path = "../images/category/" . $image_name;

                // Validate and upload new image
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    // Remove old image if it exists
                    if ($current_image && file_exists("../images/category/" . $current_image)) {
                        unlink("../images/category/" . $current_image);
                    }
                } else {
                    redirect_with_message(SITEURL . 'admin/manage-category.php', 'Failed to upload new image', 'error');
                }
            }

            // Update category in the database
            $stmt = $conn->prepare("UPDATE tbl_category SET title = ?, image = ?, featured = ?, active = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $title, $image_name, $featured, $active, $id);

            if ($stmt->execute()) {
                redirect_with_message(SITEURL . 'admin/manage-category.php', 'Category updated successfully');
            } else {
                redirect_with_message(SITEURL . 'admin/manage-category.php', 'Failed to update category', 'error');
            }

            $stmt->close();
        }
        ?>
    </div>
</div>

<?php include('part/footer.php'); ?>
