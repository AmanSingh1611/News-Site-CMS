<?php 
include "config.php";

$category_id = $_GET['id'];

$sql = "DELETE FROM category WHERE category_id={$category_id}";

if (mysqli_query($conn, $sql)) {
    header("location: {$hostname}/news-template/admin/category.php");
} else {
    echo "<p style='color=red;text-align:center'>User Already Exist</p>";
}
mysqli_close($conn);

?>