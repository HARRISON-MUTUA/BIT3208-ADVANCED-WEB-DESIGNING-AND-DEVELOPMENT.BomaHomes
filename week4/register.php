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

    <style>

        body{
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: Blue;
        }

       
        .header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: white;
            border-bottom: 1px solid lightgray;
        }

        
        .home-link{
            text-decoration: none;
            color: black;
            font-size: 16px;
        }

        .container{
            background-color: Green;
            min-height: 500px;
            padding: 40px;
        }

        .container h2{
            font-size: 48px;
            margin-bottom: 10px;
        }

        .subtitle{
            color: #444;
            margin-bottom: 50px;
            font-size: 18px;
        }

        .form-row{
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        .form-group{
            flex: 1;
            min-width: 250px;
        }

        label{
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input{
            width: 100%;
            padding: 15px;
            border: 1px solid gray;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        #strength{
            margin-top: 8px;
            font-weight: bold;
        }

        button{
            margin-top: 25px;
            width: 140px;
            padding: 12px;
            background-color: white;
            color: black;
            border: 1px solid gray;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover{
            background-color: whitesmoke;
        }

        .login-link{
            margin-top: 20px;
            font-size: 16px;
        }

        .login-link a{
            color: black;
        }

        
        .footer{
            text-align: center;
            padding: 20px;
            background-color: white;
            border-top: 1px solid lightgray;
        }

        @media(max-width: 900px){

            .form-row{
                flex-direction: column;
            }

            .container h2{
                font-size: 36px;
            }

        }

    </style>

</head>
<body>


<!-- Main Content -->
<div class="container">

    <h2>Landlord Registration</h2>

    <p class="subtitle">
        Create an account to list and manage your properties.
    </p>

    <form method="POST">

        <div class="form-row">

            <div class="form-group">

                <label>Full Name</label>

                <input type="text"
                       name="fullname"
                       placeholder="Enter your full name"
                       required>

            </div>

            <div class="form-group">

                <label>Email</label>

                <input type="email"
                       name="email"
                       placeholder="Enter your email"
                       required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input type="password"
                       id="password"
                       name="password"
                       placeholder="Enter your password"
                       required
                       minlength="6"
                       onkeyup="checkStrength()">

                <p id="strength"></p>

            </div>

        </div>

        <button type="submit" name="register">
            Register
        </button>

    </form>

    <div class="login-link">

        Already have an account?

        <a href="login.php">
            Login Here
        </a>

    </div>

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