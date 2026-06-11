
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
            echo "<script>alert('Wrong Password');</script>";
        }

    }else{
        echo "<script>alert('User Not Found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>BomaHomes Login</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background-color: Blue;
            margin: 0;
        }

        .container{
            width: 85%;
            min-height: 500px;
            margin: 20px auto;
            background-color: Green;
            border: 1px solid gray;
            padding: 40px;
            box-sizing: border-box;
        }

        h2{
            font-size: 48px;
            margin-bottom: 50px;
        }

        .form-row{
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
        }

        input{
            width: 240px;
            padding: 15px;
            border: 1px solid gray;
            font-size: 16px;
            box-sizing: border-box;
        }

        button{
            width: 120px;
            padding: 15px;
            background-color: white;
            border: 1px solid gray;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover{
            background-color: whitesmoke;
        }

        .register-link{
            margin-top: 50px;
            font-size: 18px;
        }

        .register-link a{
            color: black;
        }

        @media(max-width: 768px){

            .form-row{
                flex-direction: column;
                align-items: flex-start;
            }

            input{
                width: 100%;
            }

            button{
                width: 100%;
            }

            h2{
                font-size: 36px;
            }
        }

    </style>

</head>
<body>

<div class="container">

    <h2>Landlord Login</h2>

    <form method="POST">

        <div class="form-row">

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

        </div>

    </form>

    <div class="register-link">

        Don't have an account?

        <a href="register.php">
            Register Here
        </a>

    </div>

</div>

</body>
</html>