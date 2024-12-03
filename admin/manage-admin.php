<?php include('part/menu.php'); ?>

<!-- Main -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br /><br />

        <!-- Button add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>1. </td>
                <td>Gamaliel</td>
                <td>Abiezer</td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr>

            <tr>
                <td>2. </td>
                <td>Cindy</td>
                <td>Kebo</td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr>

            <tr>
                <td>3. </td>
                <td>Eric</td>
                <td>Tantrum</td>
                <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
        </table>

    </div>
</div>
<!-- Main End -->

<?php include('part/footer.php'); ?>