<?php
include("../config/connection.php");

$result=mysqli_query($conn,"SELECT * FROM messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Contact Messages</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Customer Messages</h2>

<table class="table table-bordered table-striped">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Message</th>

<th>Date</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['fullname']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['message']; ?></td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>