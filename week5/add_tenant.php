<?php

include 'database/connection.php';

if(isset($_POST['add'])){

    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $house_no = $_POST['house_no'];
    $rent = $_POST['rent'];

    $sql = "INSERT INTO tenants(fullname,phone,house_no,rent)
            VALUES('$fullname','$phone','$house_no','$rent')";

    mysqli_query($conn,$sql);

    header("Location: view_tenants.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Add Tenant</title>
</head>
<body>

<h2>Add Tenant</h2>

<form method="POST">

<input type="text" name="fullname" placeholder="Full Name" required>

<br><br>

<input type="text" name="phone" placeholder="Phone Number" required>

<br><br>

<input type="text" name="house_no" placeholder="House Number" required>

<br><br>

<input type="number" name="rent" placeholder="Rent Amount" required>

<br><br>

<button type="submit" name="add">
Add Tenant
</button>

</form>

</body>
</html>