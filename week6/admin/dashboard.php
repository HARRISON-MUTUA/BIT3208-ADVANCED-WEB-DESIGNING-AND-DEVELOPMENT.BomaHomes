<?php
include("../config/connection.php");

$landlords=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE role='landlord'"));
$tenants=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE role='tenant'"));
$properties=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM properties"));
$messages=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM messages"));
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h1 class="mb-4">Administrator Dashboard</h1>

<div class="row">

<div class="col-md-3">
<div class="card text-center bg-primary text-white">
<div class="card-body">
<h2><?php echo $landlords; ?></h2>
<p>Landlords</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center bg-success text-white">
<div class="card-body">
<h2><?php echo $tenants; ?></h2>
<p>Tenants</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center bg-warning text-dark">
<div class="card-body">
<h2><?php echo $properties; ?></h2>
<p>Properties</p>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center bg-danger text-white">
<div class="card-body">
<h2><?php echo $messages; ?></h2>
<p>Messages</p>
</div>
</div>
</div>

</div>

<div class="mt-5">

<a href="add_landlord.php" class="btn btn-success">Add Landlord</a>

<a href="view_landlords.php" class="btn btn-primary">Manage Landlords</a>

<a href="view_messages.php" class="btn btn-dark">View Messages</a>

</div>

</div>

</body>

</html>