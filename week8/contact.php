<?php
session_start();
include 'database/connection.php';

$success = false;

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if(!empty($name) && !empty($email) && !empty($subject) && !empty($message)){

        $sql = "INSERT INTO contact_messages (name, email, subject, message) 
                VALUES ('$name', '$email', '$subject', '$message')";

        if(mysqli_query($conn, $sql)){
            $success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>BomaHomes - Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            max-width: 550px;
            width: 100%;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h1 {
            font-size: 32px;
            color: #2d3436;
            margin: 0;
        }
        
        .logo h1 span {
            color: #6c5ce7;
        }
        
        .logo p {
            color: #636e72;
            margin-top: 5px;
        }
        
        h2 {
            font-size: 24px;
            color: #2d3436;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .subtitle {
            color: #636e72;
            margin-bottom: 30px;
            font-size: 15px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .form-group label .required {
            color: #e17055;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #dfe6e9;
            border-radius: 10px;
            font-size: 16px;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #6c5ce7;
        }
        
        .form-group textarea {
            height: 120px;
            resize: vertical;
        }
        
        button {
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
        
        button:hover {
            background: #5f3dc4;
        }
        
        .success-box {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .success-box .icon {
            font-size: 48px;
            display: block;
            margin-bottom: 10px;
        }
        
        .success-box h3 {
            margin-bottom: 5px;
        }
        
        .nav-links {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 15px 0 25px 0;
            flex-wrap: wrap;
        }
        
        .nav-links a {
            color: #6c5ce7;
            text-decoration: none;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
            transition: background 0.3s ease;
            font-size: 13px;
        }
        
        .nav-links a:hover {
            background: #f8f9fa;
        }
        
        .nav-links a.home {
            background: #6c5ce7;
            color: white;
        }
        
        .nav-links a.home:hover {
            background: #5f3dc4;
        }
        
        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #f1f2f6;
        }
        
        .contact-info .item {
            text-align: center;
        }
        
        .contact-info .item .icon {
            font-size: 24px;
            display: block;
            margin-bottom: 5px;
        }
        
        .contact-info .item .label {
            font-size: 12px;
            color: #b2bec3;
        }
        
        .contact-info .item .value {
            font-size: 14px;
            color: #2d3436;
            font-weight: 600;
        }
        
        .admin-link {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: #b2bec3;
        }
        
        .admin-link a {
            color: #6c5ce7;
            text-decoration: none;
        }
        
        .admin-link a:hover {
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
            
            .form-group input,
            .form-group textarea {
                padding: 12px 14px;
                font-size: 14px;
            }
            
            button {
                font-size: 16px;
                padding: 14px;
            }
            
            .contact-info {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
            
            .nav-links a {
                font-size: 12px;
                padding: 5px 12px;
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
        <a href="../week3/index.php" class="home">🏠 Home</a>
        <a href="login.php">🔐 Login</a>
        <a href="register.php">📋 Register</a>
        <a href="contact.php" style="background: #00b894; color: white;">📧 Contact</a>
    </div>

    <?php if($success): ?>
        <div class="success-box">
            <span class="icon">✅</span>
            <h3>Message Sent Successfully!</h3>
            <p>Thank you for contacting us. We will get back to you soon.</p>
            <br>
            <a href="contact.php" style="background: #6c5ce7; color: white; padding: 10px 25px; text-decoration: none; border-radius: 8px; display: inline-block;">
                Send Another Message
            </a>
        </div>
    <?php else: ?>
        <h2>📧 Contact Us</h2>
        <p class="subtitle">Have questions or feedback? Send us a message.</p>

        <form method="POST">

            <div class="form-group">
                <label>Your Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label>Email Address <span class="required">*</span></label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Subject <span class="required">*</span></label>
                <input type="text" id="subject" name="subject" placeholder="Enter subject" required>
            </div>

            <div class="form-group">
                <label>Message <span class="required">*</span></label>
                <textarea id="message" name="message" placeholder="Type your message here..." required></textarea>
            </div>

            <button type="submit" name="submit">📤 Send Message</button>

        </form>
    <?php endif; ?>

    <div class="contact-info">
        <div class="item">
            <span class="icon">📞</span>
            <div class="label">Phone</div>
            <div class="value">+254 700 000 000</div>
        </div>
        <div class="item">
            <span class="icon">📧</span>
            <div class="label">Email</div>
            <div class="value">info@bomahomes.com</div>
        </div>
        <div class="item">
            <span class="icon">📍</span>
            <div class="label">Location</div>
            <div class="value">Nairobi, Kenya</div>
        </div>
        <div class="item">
            <span class="icon">🕐</span>
            <div class="label">Hours</div>
            <div class="value">Mon-Fri 8AM-5PM</div>
        </div>
    </div>

    <div class="admin-link">
        🔒 <a href="view_messages.php">View Messages</a> (Admin Only)
    </div>

</div>

</body>
</html>