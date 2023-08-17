
<?php
include "config.php";
//$hostname = "";
session_start();

session_unset();

session_destroy();

header("Location: {$hostname}/news-template/admin/");

?>