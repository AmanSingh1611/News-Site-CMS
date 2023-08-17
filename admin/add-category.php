<?php include "header.php"; 
include "config.php";
if (isset($_POST['save'])) {
    $cat = mysqli_real_escape_string($conn, $_POST['cat']);
    //fetch username from database
    $post = 0;
    $sql1 = "SELECT * FROM category WHERE category_name='{$cat}'";
    $result1 = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($result1)>0){
        echo "<p style='color=red;text-align:center'>Category Already Exist</p>";
    } else {
        $sql = "INSERT INTO category (category_name,post) VALUES ('{$cat}','{$post}')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location:{$hostname}/news-template/admin/category.php");
        }
    }

}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
