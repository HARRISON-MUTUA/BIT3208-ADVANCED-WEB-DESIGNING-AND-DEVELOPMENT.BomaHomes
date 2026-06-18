<?php
include("../config/connection.php");

$message="";

if(isset($_POST['save'])){

$fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$phone=mysqli_real_escape_string($conn,$_POST['phone']);
$national_id=mysqli_real_escape_string($conn,$_POST['national_id']);
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);

$check=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check)>0){

$message="<div class='alert alert-danger'>Email already exists.</div>";

}else{

mysqli_query($conn,"INSERT INTO users(fullname,email,phone,national_id,password,role)

VALUES

('$fullname','$email','$phone','$national_id','$password','tenant')");

$message="<div class='alert alert-success'>Tenant Registered Successfully.</div>";

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register Tenant</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Register Tenant</h2>

<?php echo $message; ?>

<form method="POST">

<input type="text" name="fullname" class="form-control mb-3" placeholder="Full Name" required>

<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

<input type="text" name="phone" class="form-control mb-3" placeholder="Phone Number" required>

<input type="text" name="national_id" class="form-control mb-3" placeholder="National ID" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button class="btn btn-success" name="save">

Register Tenant

</button>

<a href="view_tenants.php" class="btn btn-primary">

View Tenants

</a>

</form>

</div>

</body>
</html>