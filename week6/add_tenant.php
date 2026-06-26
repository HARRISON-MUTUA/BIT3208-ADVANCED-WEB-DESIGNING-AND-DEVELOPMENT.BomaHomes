<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../week4/login.php");
    exit();
}

include 'database/connection.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['add_tenant'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $rent_amount = $_POST['rent_amount'];
    $payment_status = $_POST['payment_status'];

    $sql = "INSERT INTO tenants (landlord_id, fullname, email, phone, rent_amount, payment_status) 
            VALUES ('$user_id', '$fullname', '$email', '$phone', '$rent_amount', '$payment_status')";
    
    if(mysqli_query($conn, $sql)){
        header("Location: dashboard.php?success=1");
        exit();
    } else {
        $error = "Failed to add tenant";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Tenant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            width: 500px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h2 {
            color: #2d3436;
            margin-bottom: 10px;
        }
        h2 i {
            color: #6c5ce7;
        }
        .subtitle {
            color: #636e72;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: 2px solid #dfe6e9;
            border-radius: 8px;
            box-sizing: border-box;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #6c5ce7;
        }
        button {
            background: #6c5ce7;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
        }
        button:hover {
            background: #5f3dc4;
        }
        .back {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #6c5ce7;
            text-decoration: none;
        }
        .back:hover {
            text-decoration: underline;
        }
        .error {
            color: #e17055;
            padding: 10px;
            background: #f8d7da;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2><i class="fas fa-user-plus"></i> Add Tenant</h2>
    <p class="subtitle">Register a new tenant to your property</p>

    <?php if(isset($error)): ?>
        <div class="error"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullname" placeholder="Enter tenant's full name" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter tenant's email" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="tel" name="phone" placeholder="Enter phone number">
        </div>

        <div class="form-group">
            <label>Rent Amount (KSh)</label>
            <input type="number" name="rent_amount" placeholder="Enter monthly rent" required>
        </div>

        <div class="form-group">
            <label>Payment Status</label>
            <select name="payment_status">
                <option value="paid">Paid</option>
                <option value="pending">Pending</option>
                <option value="overdue">Overdue</option>
            </select>
        </div>

        <button type="submit" name="add_tenant">Add Tenant</button>
    </form>

    <a href="dashboard.php" class="back"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>
</body>
</html>