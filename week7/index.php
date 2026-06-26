<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>BomaHomes - Week 4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #2d3436;
            text-align: center;
        }
        h1 span {
            color: #6c5ce7;
        }
        .subtitle {
            text-align: center;
            color: #636e72;
            margin-bottom: 30px;
        }
        .nav-links {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        .nav-links a {
            background: #6c5ce7;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease;
        }
        .nav-links a:hover {
            background: #5f3dc4;
        }
        .nav-links a.contact {
            background: #00b894;
        }
        .nav-links a.contact:hover {
            background: #00a381;
        }
        .welcome-box {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
        }
        .welcome-box h2 {
            color: #2d3436;
        }
        .welcome-box p {
            color: #636e72;
        }
        hr {
            margin: 30px 0;
            border: none;
            border-top: 2px solid #f1f2f6;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .feature {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .feature .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .feature h4 {
            color: #2d3436;
            margin-bottom: 5px;
        }
        .feature p {
            color: #636e72;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>🏠 Boma<span>Homes</span></h1>
    
    <!-- Navigation -->
    <div class="nav-links">
        <a href="../week3/index.php">🏠 Home</a>
        <a href="login.php">🔐 Login</a>
        <a href="register.php">📋 Register</a>
        <a href="contact.php" class="contact">📧 Contact</a>
    </div>

    <hr>

    <?php if(isset($_SESSION['user'])): ?>
        <!-- Logged In -->
        <div class="welcome-box">
            <h2>👋 Welcome back, <?php echo $_SESSION['user']; ?>!</h2>
            <p>You are logged in. Go to your dashboard.</p>
            <br>
            <a href="../week5/dashboard.php" style="background: #6c5ce7; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; display: inline-block;">
                Go to Dashboard →
            </a>
        </div>
    <?php else: ?>
        <!-- Not Logged In -->
        <div class="welcome-box">
            <h2>Welcome to BomaHomes</h2>
            <p>Your property management solution.</p>
            <br>
            <a href="login.php" style="background: #6c5ce7; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; display: inline-block; margin: 5px;">
                Login
            </a>
            <a href="register.php" style="background: #00b894; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; display: inline-block; margin: 5px;">
                Register
            </a>
        </div>
    <?php endif; ?>

    <hr>

    <!-- Features -->
    <h3 style="text-align: center; color: #2d3436;">What We Offer</h3>
    <div class="features">
        <div class="feature">
            <div class="icon">🏠</div>
            <h4>Property Management</h4>
            <p>Manage all your properties in one place</p>
        </div>
        <div class="feature">
            <div class="icon">👥</div>
            <h4>Tenant Management</h4>
            <p>Keep track of all your tenants</p>
        </div>
        <div class="feature">
            <div class="icon">💰</div>
            <h4>Payment Tracking</h4>
            <p>Monitor rent payments easily</p>
        </div>
        <div class="feature">
            <div class="icon">📊</div>
            <h4>Reports</h4>
            <p>Generate income reports</p>
        </div>
    </div>

</div>

</body>
</html>