<?php
session_start();
include("config/connection.php");

if(isset($_POST['login'])){

    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="SELECT * FROM users WHERE email='$email'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){

        $user=mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){

            $_SESSION['user_id']=$user['id'];
            $_SESSION['name']=$user['fullname'];
            $_SESSION['role']=$user['role'];

            if($user['role']=="Admin"){

                header("Location: admin/dashboard.php");

            }elseif($user['role']=="Landlord"){

                header("Location: landlord/dashboard.php");

            }else{

                header("Location: tenant/dashboard.php");

            }

            exit();

        }else{

            $error="Wrong Password";

        }

    }else{

        $error="Account not found";

    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h3>Login</h3>

</div>

<div class="card-body">

<?php

if(isset($error)){

echo "<div class='alert alert-danger'>$error</div>";

}

?>

<form method="POST">

<div class="mb-3">

<label>Email</label>

<input type="email" name="email" class="form-control" required>

</div>

<div class="mb-3">

<label>Password</label>

<input type="password" name="password" class="form-control" required>

</div>

<button class="btn btn-primary w-100" name="login">

Login

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>