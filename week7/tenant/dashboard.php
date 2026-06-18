<?php

include("../includes/auth.php");

if($_SESSION['role']!="Tenant"){

    header("Location: ../login.php");
    exit();

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Tenant Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Tenant Dashboard</h2>

<hr>

<h4>Welcome <?php echo $_SESSION['name']; ?></h4>

<p>Role: <?php echo $_SESSION['role']; ?></p>

<a href="../logout.php" class="btn btn-danger">
Logout
</a>

</div>

</body>

</html>