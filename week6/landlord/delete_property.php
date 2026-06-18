<?php

include("../config/connection.php");

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM properties WHERE id='$id'");

header("Location:view_properties.php");

exit();

?>