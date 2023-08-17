<?php include "header.php";
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    include "config.php";
    $catid = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $catname = mysqli_real_escape_string($conn, $_POST['cat_name']);
    $sql = "UPDATE category SET category_name='{$catname}' WHERE category_id='{$id}'" or die("query Failed");

    if (mysqli_query($conn, $sql)) {
        header("Location:{$hostname}/news-template/admin/category.php");
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                include "config.php";

                $sql = "SELECT * FROM category WHERE category_id={$id}";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0):
                    while ($arr = mysqli_fetch_assoc($result)):
                        ?>
                        <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="cat_id" class="form-control" value="<?=$arr['category_id']?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?=$arr['category_name']?>" placeholder="" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>