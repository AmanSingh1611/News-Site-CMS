<?php
include "config.php";
if(isset($_FILES['fileToUpload'])){
    $errors = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $arr = explode('.', $file_name);
    $file_ext= end($arr);
    $extensions = array("jpeg","jpg","png","avif","webp");

    if(in_array($file_ext,$extensions)===false){
        $errors[] = "Please Choose a JPEG,JPG, WEBP or PNG file.";
    }

    if($file_size>10485760){
        $errors[] = "File size must be 2mb or lower.";
    }
    $new_name = $file_name . "-" . time();
    $target="upload/" . $file_name."-".time();
    if(empty($errors)==true){
        move_uploaded_file($file_tmp, $target);
    }

    else{
        print_r($errors);
        die();
    }
}
    
    
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date = date("d M, Y");
    session_start();
    $author = $_SESSION['user_id'];
    //echo $file_name;
    $sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('{$title}','{$description}',$category,'{$date}','{$author}','{$new_name}');UPDATE category SET post=post+1 WHERE category_id={$category};";
    
    if(mysqli_multi_query($conn,$sql)){
        header("location: {$hostname}/news-template/admin/post.php");
    }
    else{
        echo "<div class='alert alert-danger'>Query Failed</div>";
    }
?>