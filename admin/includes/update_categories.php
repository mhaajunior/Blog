<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>
        <?php
        if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
            $select_categories_id = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
        ?>

                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" type="text" name="cat_title" class="form-control">

        <?php }
        } ?>

        <?php //update query
        if (isset($_POST['update_category'])) {
            $the_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
            $update_query = mysqli_query($conn, $query);

            confirm($update_query);
        }
        ?>

    </div>
    <div class="form-group">
        <button class="btn btn-warning" type="submit" name="update_category">Update Category</button>
    </div>
</form>