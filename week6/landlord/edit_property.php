<?php
include("../config/connection.php");

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM properties WHERE id='$id'");
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$title=$_POST['title'];
$location=$_POST['location'];
$price=$_POST['price'];
$status=$_POST['status'];

mysqli_query($conn,"UPDATE properties SET

title='$title',

location='$location',

price='$price',

status='$status'

WHERE id='$id'");

header("Location:view_properties.php");

}
?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Property</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Edit Property</h2>

<form method="POST">

<input type="text" name="title" class="form-control mb-3" value="<?php echo $row['title'];?>">

<input type="text" name="location" class="form-control mb-3" value="<?php echo $row['location'];?>">

<input type="number" name="price" class="form-control mb-3" value="<?php echo $row['price'];?>">

<select name="status" class="form-control mb-3">

<option>Available</option>

<option>Occupied</option>

</select>

<button class="btn btn-primary" name="update">

Update Property

</button>

</form>

</div>

</body>

</html>