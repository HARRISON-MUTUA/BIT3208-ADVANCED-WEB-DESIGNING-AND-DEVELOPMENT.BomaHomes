<?php

include 'database/connection.php';

$result = mysqli_query($conn,"SELECT * FROM tenants");

?>

<!DOCTYPE html>
<html>
<head>
<title>View Tenants</title>
</head>
<body>

<h2>Tenant List</h2>

<table border="1">

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
<td><?php echo $row['fullname']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['house_no']; ?></td>
<td><?php echo $row['rent']; ?></td>

<td>

<a href="edit_tenant.php?id=<?php echo $row['id']; ?>">
Edit
</a>

|

<a href="delete_tenant.php?id=<?php echo $row['id']; ?>">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>