<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'super_admin'){
    header("Location: dashboard.php");
    exit();
}

include 'database/connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM landlords WHERE id = $id");
    $landlord = mysqli_fetch_assoc($result);
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    
    $sql = "UPDATE landlords SET fullname='$fullname', email='$email' WHERE id=$id";
    mysqli_query($conn, $sql);
    
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Landlord</title>
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
        label { display: block; font-weight: 600; margin-bottom: 8px; }
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #dfe6e9;
            border-radius: 8px;
            box-sizing: border-box;
        }
        input:focus { outline: none; border-color: #6c5ce7; }
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
    <h2><i class="fas fa-user-edit"></i> Edit Landlord</h2>
    <p class="subtitle">Update landlord information</p>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $landlord['id']; ?>">
        
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($landlord['fullname']); ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($landlord['email']); ?>" required>
        </div>

        <button type="submit" name="update">Update Landlord</button>
    </form>

    <a href="dashboard.php" class="back"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>
</body>
</html>