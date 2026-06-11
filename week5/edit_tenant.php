<?php

include 'database/connection.php';

$id = $_GET['id'];

$result = mysqli_query(
$conn,
"SELECT * FROM tenants WHERE id='$id'"
);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $house_no = $_POST['house_no'];
    $rent = $_POST['rent'];

    mysqli_query(
    $conn,
    "UPDATE tenants
    SET fullname='$fullname',
    phone='$phone',
    house_no='$house_no',
    rent='$rent'
    WHERE id='$id'"
    );

    header("Location: view_tenants.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Tenant</title>
</head>
<body>

<form method="POST">

<input type="text"
name="fullname"
value="<?php echo $row['fullname']; ?>">

<br><br>

<input type="text"
name="phone"
value="<?php echo $row['phone']; ?>">

<br><br>

<input type="text"
name="house_no"
value="<?php echo $row['house_no']; ?>">

<br><br>

<input type="number"
name="rent"
value="<?php echo $row['rent']; ?>">

<br><br>

<button type="submit" name="update">
Update Tenant
</button>

</form>

</body>
</html>