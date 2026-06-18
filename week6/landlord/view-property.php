<?php
include("../config/connection.php");

$result=mysqli_query($conn,"SELECT * FROM properties");
?>

<!DOCTYPE html>

<html>

<head>

<title>Properties</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Properties</h2>

<a href="add_property.php" class="btn btn-success mb-3">

Add Property

</a>

<table class="table table-bordered">

<tr>

<th>ID</th>

<th>Image</th>

<th>Title</th>

<th>Location</th>

<th>Price</th>

<th>Status</th>

<th>Action</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>

<img src="../assets/images/<?php echo $row['image']; ?>" width="100">

</td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['location']; ?></td>

<td>Ksh <?php echo number_format($row['price']); ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a href="edit_property.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">

Edit

</a>

<a href="delete_property.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">

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