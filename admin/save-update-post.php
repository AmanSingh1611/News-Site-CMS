<?php
include "config.php";
if (empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old-image'];
} else {
    $errors = array();
    $file_name = empty($file_name)?$_FILES["new-image"]['name']:$file_name;
    echo $file_name;
    $file_size = $_FILES["new-image"]['size'];
    $file_tmp = $_FILES["new-image"]['tmp_name'];
    $file_type = $_FILES["new-image"]['type'];
    $arr=explode('.', $file_name);
    $file_ext = end($arr);
    //echo $file_ext;
    $extensions = array("jpeg", "jpg", "png","avif","webp");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Please Choose a JPEG,JPG,AVIF,WEBP or PNG file.";
    }

    if ($file_size > 10485760) {
        $errors[] = "File size must be 10 mb or lower.";
    }
    $new_name=$file_name."-".time();
    $target="upload/" . $file_name."-".time();
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp,  $target);
    } else {
        print_r($errors);
        die();
    }
}

$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$desc = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
$post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
$old_cat= mysqli_real_escape_string($conn, $_POST['old-category']);

$sql = "UPDATE post SET title='{$title}',category={$category},post.description='{$desc}',post_img='{$new_name}' WHERE post_id={$post_id};UPDATE category SET post=post-1 WHERE category_id=$old_cat;UPDATE category SET post=post+1 WHERE category_id=$category;";

$result = mysqli_multi_query($conn, $sql) or die("Query Failed:");

if($result){
    header("location: {$hostname}/news-template/admin/post.php");
}else{
    echo "Query Failed";
}

?>