<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../week4/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>BomaHomes Dashboard</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

        body{
            font-family: Arial;
            background: Blue;
        }

        .dashboard{
            width: 400px;
            background: Green;
            margin: 80px auto;
            padding: 20px;
            border-radius: 5px;
        }

        a{
            text-decoration: none;
        }

        .btn{
            display: block;
            background: green;
            color: white;
            padding: 12px;
            margin-top: 10px;
            text-align: center;
            border-radius: 5px;
        }

        .logout{
            background: red;
        }

    </style>

</head>
<body>

<div class="dashboard">

<h1>Welcome <?php echo $_SESSION['user']; ?></h1>

<h3>BomaHomes Tenant and Landlord System</h3>

<hr>

<h2>Tenant Management</h2>

<a href="add_tenant.php" class="btn">
Add Tenant
</a>

<a href="view_tenants.php" class="btn">
View Tenants
</a>

<hr>

<a href="../week4/logout.php" class="btn logout">
Logout
</a>

</div>

</body>
</html>