<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../week4/login.php");
    exit();
}

include 'database/connection.php';

$user_id = $_SESSION['user_id'];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM tenants WHERE id = $id AND landlord_id = $user_id");
    $tenant = mysqli_fetch_assoc($result);
    
    if(!$tenant){
        header("Location: view_tenants.php");
        exit();
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $rent_amount = $_POST['rent_amount'];
    $payment_status = $_POST['payment_status'];

    $sql = "UPDATE tenants SET 
            fullname='$fullname', 
            email='$email', 
            phone='$phone', 
            rent_amount='$rent_amount', 
            payment_status='$payment_status' 
            WHERE id=$id AND landlord_id=$user_id";
    
    if(mysqli_query($conn, $sql)){
        header("Location: view_tenants.php?updated=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tenant</title>
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
        h2 { color: #2d3436; margin-bottom: 10px; }
        h2 i { color: #6c5ce7; }
        .subtitle { color: #636e72; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px; }
        input, select {
            width: 100%;
            padding: 12px;
            border: 2px solid #dfe6e9;
            border-radius: 8px;
            box-sizing: border-box;
        }
        input:focus, select:focus { outline: none; border-color: #6c5ce7; }
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
        button:hover { background: #5f3dc4; }
        .back {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #6c5ce7;
            text-decoration: none;
        }
        .back:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <h2><i class="fas fa-user-edit"></i> Edit Tenant</h2>
    <p class="subtitle">Update tenant information</p>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $tenant['id']; ?>">

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($tenant['fullname']); ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($tenant['email']); ?>" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="tel" name="phone" value="<?php echo htmlspecialchars($tenant['phone'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label>Rent Amount (KSh)</label>
            <input type="number" name="rent_amount" value="<?php echo $tenant['rent_amount']; ?>" required>
        </div>

        <div class="form-group">
            <label>Payment Status</label>
            <select name="payment_status">
                <option value="paid" <?php echo $tenant['payment_status'] == 'paid' ? 'selected' : ''; ?>>Paid</option>
                <option value="pending" <?php echo $tenant['payment_status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="overdue" <?php echo $tenant['payment_status'] == 'overdue' ? 'selected' : ''; ?>>Overdue</option>
            </select>
        </div>

        <button type="submit" name="update">Update Tenant</button>
    </form>

    <a href="view_tenants.php" class="back"><i class="fas fa-arrow-left"></i> Back to Tenants</a>
</div>
</body>
</html>