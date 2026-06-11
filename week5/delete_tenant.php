<?php

include 'database/connection.php';

$id = $_GET['id'];

mysqli_query(
$conn,
"DELETE FROM tenants WHERE id='$id'"
);

header("Location: view_tenants.php");

?>