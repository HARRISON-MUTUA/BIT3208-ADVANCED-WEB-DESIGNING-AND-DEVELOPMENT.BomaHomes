<?php
include("../config/connection.php");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

header("Location:view_landlords.php");
exit();
?>