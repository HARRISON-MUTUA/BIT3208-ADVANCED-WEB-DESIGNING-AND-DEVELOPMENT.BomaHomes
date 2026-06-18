<?php
include("../config/connection.php");

$properties = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM properties"));
$tenants = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE role='tenant'"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Landlord Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Landlord Dashboard</h2>

<div class="row">

<div class="col-md-6">

<div class="card bg-primary text-white">

<div class="card-body">

<h3><?php echo $properties; ?></h3>

<p>Properties</p>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card bg-success text-white">

<div class="card-body">

<h3><?php echo $tenants; ?></h3>

<p>Tenants</p>

</div>

</div>

</div>

</div>

<br>

<a href="add_property.php" class="btn btn-success">Add Property</a>

<a href="view_properties.php" class="btn btn-primary">View Properties</a>

<a href="add_tenant.php" class="btn btn-warning">Register Tenant</a>

<a href="view_tenants.php" class="btn btn-dark">View Tenants</a>

</div>

</body>
</html>