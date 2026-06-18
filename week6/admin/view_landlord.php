<?php
include("../config/connection.php");

$result = mysqli_query($conn,"SELECT * FROM users WHERE role='landlord'");
?>

<!DOCTYPE html>
<html>

<head>

<title>View Landlords</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Registered Landlords</h2>

<a href="add_landlord.php" class="btn btn-success mb-3">
Add New Landlord
</a>

<table class="table table-bordered table-striped">

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>National ID</th>
<th>Action</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['fullname']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['national_id']; ?></td>

<td>

<a href="edit_landlord.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">

Edit

</a>

<a href="delete_landlord.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">

Delete

</a>

</td>

</tr>

<?php
}
?>

</table>

</div>

</body>

</html>