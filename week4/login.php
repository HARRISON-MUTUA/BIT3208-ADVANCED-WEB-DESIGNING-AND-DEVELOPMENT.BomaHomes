
<?php
session_start();

include 'database/connection.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM landlords WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){

            $_SESSION['user'] = $row['fullname'];

            header("Location: ../week5/dashboard.php");
            exit();

        }else{
            echo "Wrong Password";
        }

    }else{
        echo "User Not Found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>BomaHomes Login</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Landlord Login</h2>

<form method="POST">

<input type="email"
name="email"
placeholder="Email"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<button type="submit" name="login">
Login
</button>

</form>

<p>
Don't have an account?
<a href="register.php">Register Here</a>
</p>

</div>

</body>
</html>