<?php
include 'database/connection.php';

$sql = "SELECT * FROM tenants";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Tenants</title>
</head>
<body>

<h2>Tenant Records</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>House</th>
    <th>Rent</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['tenant_name']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['house_number']; ?></td>

<td><?php echo $row['rent_amount']; ?></td>

<td>
<a href="edit_tenant.php?id=<?php echo $row['id']; ?>">Edit</a>

<a href="delete_tenant.php?id=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>

<?php } ?>

</table>

</body>
</html>