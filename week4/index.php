<!DOCTYPE html>
<html>
<head>
    <title>BomaHomes</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: blue;
        }

        .container{
            width: 80%;
            margin: 80px auto;
            background-color: white;
            padding: 50px;
            text-align: center;
            border: 1px solid lightgray;
            border-radius: 5px;
        }

        h1{
            color: black;
            font-size: 48px;
            margin-bottom: 10px;
        }

        p{
            color: gray;
            font-size: 20px;
            margin-bottom: 40px;
        }

        .btn{
            display: inline-block;
            width: 150px;
            padding: 15px;
            margin: 10px;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            font-size: 18px;
        }

        .register{
            background-color: green;
            color: white;
        }

        .register:hover{
            background-color: darkgreen;
        }

        .login{
            background-color: white;
            color: black;
            border: 1px solid gray;
        }

        .login:hover{
            background-color: whitesmoke;
        }

        .footer{
            text-align: center;
            margin-top: 40px;
            color: gray;
        }

    </style>

</head>
<body>

<div class="container">

    <h1>BomaHomes</h1>

    <p>
        Tenant and Landlord Management System
    </p>

    <a href="register.php" class="btn register">
        Register
    </a>

    <a href="login.php" class="btn login">
        Login
    </a>

</div>

<div class="footer">
    © 2026 BomaHomes. All rights reserved.
</div>

</body>
</html>