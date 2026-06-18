<?php
include("../config/connection.php");

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM users WHERE id='$id'");
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$fullname=$_POST['fullname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$national_id=$_POST['national_id'];

mysqli_query($conn,"UPDATE users SET

fullname='$fullname',

email='$email',

phone='$phone',

national_id='$national_id'

WHERE id='$id'");

header("Location:view_tenants.php");

}
?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Tenant</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Edit Tenant</h2>

<form method="POST">

<input type="text" name="fullname" class="form-control mb-3" value="<?php echo $row['fullname'];?>">

<input type="email" name="email" class="form-control mb-3" value="<?php echo $row['email'];?>">

<input type="text" name="phone" class="form-control mb-3" value="<?php echo $row['phone'];?>">

<input type="text" name="national_id" class="form-control mb-3" value="<?php echo $row['national_id'];?>">

<button class="btn btn-primary" name="update">

Update Tenant

</button>

</form>

</div>

</body>

</html>