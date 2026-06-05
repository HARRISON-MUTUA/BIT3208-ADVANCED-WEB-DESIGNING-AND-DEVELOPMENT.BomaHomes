<?php
include 'database/connection.php';

$id = $_GET['id'];

$sql = "SELECT * FROM tenants WHERE id='$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $tenant_name = $_POST['tenant_name'];
    $phone = $_POST['phone'];

    $update = "UPDATE tenants 
               SET tenant_name='$tenant_name',
               phone='$phone'
               WHERE id='$id'";

    mysqli_query($conn, $update);

    header("Location: view_tenants.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tenant</title>
</head>
<body>

<h2>Edit Tenant</h2>

<form method="POST">

<input type="text" name="tenant_name"
value="<?php echo $row['tenant_name']; ?>">

<input type="text" name="phone"
value="<?php echo $row['phone']; ?>">

<button type="submit" name="update">Update</button>

</form>

</body>
</html>