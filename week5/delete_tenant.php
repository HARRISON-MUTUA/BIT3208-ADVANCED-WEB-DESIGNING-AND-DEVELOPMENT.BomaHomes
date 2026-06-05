<?php
include 'database/connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM tenants WHERE id='$id'";

mysqli_query($conn, $sql);

header("Location: view_tenants.php");
?>