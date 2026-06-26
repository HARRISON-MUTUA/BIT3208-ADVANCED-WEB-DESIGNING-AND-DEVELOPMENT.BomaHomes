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

        if($row['is_active'] == 0){
            echo "<script>alert('Your account has been suspended. Contact admin.');</script>";
        } else if(password_verify($password, $row['password'])){

            $_SESSION['user'] = $row['fullname'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'] ?? 'landlord';

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container{
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        .logo{
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h1{
            font-size: 32px;
            color: #2d3436;
            margin: 0;
        }
        
        .logo h1 span{
            color: #6c5ce7;
        }
        
        .logo p{
            color: #636e72;
            margin-top: 5px;
        }
        
        h2{
            font-size: 24px;
            color: #2d3436;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .form-group{
            margin-bottom: 20px;
        }
        
        .form-group label{
            display: block;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .form-group input{
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #dfe6e9;
            border-radius: 10px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus{
            outline: none;
            border-color: #6c5ce7;
        }
        
        button{
            width: 100%;
            padding: 16px;
            background: #6c5ce7;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        
        button:hover{
            background: #5f3dc4;
        }
        
        .register-link{
            margin-top: 25px;
            text-align: center;
            font-size: 15px;
            color: #636e72;
        }
        
        .register-link a{
            color: #6c5ce7;
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover{
            text-decoration: underline;
        }
        
        .role-info{
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #b2bec3;
        }
        
        .nav-links {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 15px 0 20px 0;
            flex-wrap: wrap;
        }
        
        .nav-links a {
            color: #6c5ce7;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }
        
        .nav-links a:hover {
            text-decoration: underline;
        }

        /* ===== RESPONSIVE: MOBILE ===== */
        @media (max-width: 480px) {
            .container {
                padding: 25px 20px;
            }
            
            .logo h1 {
                font-size: 26px;
            }
            
            h2 {
                font-size: 20px;
            }
            
            .form-group input {
                padding: 12px 14px;
                font-size: 14px;
            }
            
            button {
                font-size: 16px;
                padding: 14px;
            }
            
            .register-link {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <h1>🏠 Boma<span>Homes</span></h1>
        <p>Property Management System</p>
    </div>
    
    <div class="nav-links">
        <a href="../week3/index.php">🏠 Home</a>
        <a href="register.php">📋 Register</a>
        <a href="contact.php">📧 Contact</a>
    </div>
    
    <h2>Login to Your Account</h2>
    
    <form method="POST">
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" name="login">Login</button>
    </form>
    
    <div class="register-link">
        Don't have an account? <a href="register.php">Register Here</a>
    </div>
    <div class="role-info">
        <i class="fas fa-info-circle"></i> Landlords and Admins login here
    </div>
</div>
</body>
</html>