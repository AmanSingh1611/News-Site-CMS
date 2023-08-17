<?php
include "config.php";

$user_id = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id={$user_id}";

if (mysqli_query($conn, $sql)) {
    header("location: {$hostname}/news-template/admin/users.php");
} else {
    echo "<p style='color=red;text-align:center'>User Already Exist</p>";
}
mysqli_close($conn);
?>