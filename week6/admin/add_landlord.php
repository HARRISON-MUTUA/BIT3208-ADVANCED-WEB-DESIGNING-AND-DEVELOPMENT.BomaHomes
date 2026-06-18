<?php
include("../config/connection.php");

$message = "";

if(isset($_POST['add_landlord'])){

    $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $national_id = mysqli_real_escape_string($conn,$_POST['national_id']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "landlord";

    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check)>0){
        $message = "<div class='alert alert-danger'>Email already exists.</div>";
    }else{

        $insert = mysqli_query($conn,"INSERT INTO users(fullname,email,phone,national_id,password,role)
        VALUES('$fullname','$email','$phone','$national_id','$password','$role')");

        if($insert){
            $message = "<div class='alert alert-success'>Landlord Added Successfully.</div>";
        }else{
            $message = "<div class='alert alert-danger'>Error adding landlord.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Landlord</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Add Landlord</h2>

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">
<label>Full Name</label>
<input type="text" name="fullname" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control" required>
</div>

<div class="mb-3">
<label>National ID</label>
<input type="text" name="national_id" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="add_landlord" class="btn btn-success">
Add Landlord
</button>

<a href="view_landlords.php" class="btn btn-primary">
View Landlords
</a>

</form>

</div>

</body>
</html>