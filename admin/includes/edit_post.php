<?php
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $select_posts_by_id = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }
}

if (isset($_POST['update_post'])) {
    $post_author = $_POST['author'];
    $post_title = $_POST['title'];
    $post_category_id = $_POST['category_id'];
    $post_status = $_POST['status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['content'];
    $post_tags = $_POST['tags'];

    move_uploaded_file($post_image_temp, "../images/{$post_image}");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
        $select_image = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET post_category_id ='{$post_category_id}', post_title = '{$post_title}', post_author = '{$post_author}', post_date = now(), post_image = '{$post_image}', post_content = '{$post_content}', post_tags = '{$post_tags}', post_status = '{$post_status}' WHERE post_id = {$the_post_id}";
    $update_post = mysqli_query($conn, $query);
    confirm($update_post);
    header("Location: ./posts.php");
}
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_Category">Post Category</label>
        <br>
        <select class="form-control form-control-sm" name="category_id" id="post_category" aria-label=".form-select-sm example">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($conn, $query);

            confirm($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }

            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" value="<?php echo $post_status; ?>" class="form-control" name="status">
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <br>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $post_content ?></textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit" name="update_post">Update Post</button>
    </div>

</form>