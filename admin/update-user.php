<?php include "header.php"; 

//code for form updation

if(isset($_POST['submit'])){
    include "config.php";
    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname = mysqli_real_escape_string($conn,$_POST['f_name']) ;
    $lname = mysqli_real_escape_string($conn,$_POST['l_name']);
    $user = mysqli_real_escape_string($conn,$_POST['username']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);
    //$password = mysqli_real_escape_string($conn,$_POST['password']);
    
    //fetch username from database using user id
    $sql = "UPDATE user SET first_name='{$fname}',last_name='{$lname}',username='{$user}',role='{$role}' WHERE user_id='{$userid}'";
    
    if(mysqli_query($conn,$sql)){
        header("Location:{$hostname}/news-template/admin/users.php");
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php
                  include "config.php";
                  $id = $_GET['id'];

                  $sql = "SELECT * FROM USER WHERE user_id={$id}";
                  $result=mysqli_query($conn,$sql);
                  if(mysqli_num_rows($result)>0):
                    while($arr=mysqli_fetch_assoc($result)):
                  ?>

                  <form  action="<?php $_SERVER['PHP_SELF'];?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?=$arr['user_id']?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?=$arr['first_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?=$arr['last_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?=$arr['username']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?=$arr['role']?>">
                              <option value="0"<?php if ($arr['role'] == 0) {
                                  echo "selected";
                              }?>>normal User</option>
                              <option value="1" <?php if ($arr['role'] == 1) {
                                  echo "selected";
                              }?>>Admin</option>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php 
                    endwhile;
                  endif;
                  ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
