<?php
include 'database/connection.php';

if(isset($_POST['register'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO landlords (fullname, email, password, role, is_active) 
            VALUES ('$fullname', '$email', '$password', 'landlord', 1)";
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
            max-width: 500px;
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
            margin-bottom: 10px;
            text-align: center;
        }
        
        .subtitle{
            color: #636e72;
            margin-bottom: 30px;
            font-size: 15px;
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
        
        .login-link{
            margin-top: 25px;
            text-align: center;
            font-size: 15px;
            color: #636e72;
        }
        
        .login-link a{
            color: #6c5ce7;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover{
            text-decoration: underline;
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
        
        #strength {
            margin-top: 8px;
            font-weight: bold;
            font-size: 13px;
        }
        
        .weak { color: #e17055; }
        .medium { color: #fdcb6e; }
        .strong { color: #00b894; }

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
            
            .login-link {
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
        <a href="login.php">🔐 Login</a>
        <a href="contact.php">📧 Contact</a>
    </div>
    
    <h2>Create Your Account</h2>
    <p class="subtitle">Join BomaHomes and start managing your properties</p>
    
    <form method="POST">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullname" placeholder="Enter your full name" required>
        </div>
        
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required minlength="6" onkeyup="checkStrength()">
            <p id="strength"></p>
        </div>
        
        <button type="submit" name="register">Create Account</button>
    </form>
    
    <div class="login-link">
        Already have an account? <a href="login.php">Login Here</a>
    </div>
</div>

<script>
function checkStrength() {
    let password = document.getElementById("password").value;
    let strength = document.getElementById("strength");

    if(password.length === 0) {
        strength.innerHTML = "";
        return;
    }

    if(password.length < 6) {
        strength.innerHTML = "❌ Weak - Use at least 6 characters";
        strength.className = "weak";
        return;
    }

    let score = 0;
    if(password.match(/[a-z]/)) score++;
    if(password.match(/[A-Z]/)) score++;
    if(password.match(/[0-9]/)) score++;
    if(password.match(/[^A-Za-z0-9]/)) score++;
    if(password.length >= 8) score++;

    if(score >= 5) {
        strength.innerHTML = "✅ Very Strong Password";
        strength.className = "strong";
    } else if(score >= 3) {
        strength.innerHTML = "🟡 Medium Password";
        strength.className = "medium";
    } else {
        strength.innerHTML = "🔴 Weak Password";
        strength.className = "weak";
    }
}
</script>

</body>
</html>