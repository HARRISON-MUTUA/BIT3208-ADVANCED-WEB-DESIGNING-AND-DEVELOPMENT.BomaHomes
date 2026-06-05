
<?php
include 'database/connection.php';

if(isset($_POST['register'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO landlords(fullname,email,password)
            VALUES('$fullname','$email','$password')";

    $result = mysqli_query($conn, $sql);

    if($result){

        header("Location: login.php");
        exit();

    }else{
        echo "Registration Failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>BomaHomes Register</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

        #strength{
            font-weight: bold;
            margin-top: 5px;
        }

    </style>

</head>
<body>

<div class="container">

<h2>Landlord Registration</h2>

<form method="POST">

<input type="text"
name="fullname"
placeholder="Full Name"
required>

<input type="email"
name="email"
placeholder="Email"
required>

<input type="password"
id="password"
name="password"
placeholder="Password"
required
minlength="6"
onkeyup="checkStrength()">

<p id="strength"></p>

<button type="submit" name="register">
Register
</button>

</form>

<p>
Already have an account?
<a href="login.php">Login Here</a>
</p>

</div>

<script>

function checkStrength(){

    let password = document.getElementById("password").value;
    let strength = document.getElementById("strength");

    if(password.length < 6){

        strength.innerHTML = "Weak Password";
        strength.style.color = "red";

    }
    else if(
        password.match(/[A-Z]/) &&
        password.match(/[a-z]/) &&
        password.match(/[0-9]/) &&
        password.match(/[^A-Za-z0-9]/)
    ){

        strength.innerHTML = "Very Strong Password";
        strength.style.color = "green";

    }
    else{

        strength.innerHTML = "Medium Password";
        strength.style.color = "orange";

    }
}

</script>

</body>
</html>