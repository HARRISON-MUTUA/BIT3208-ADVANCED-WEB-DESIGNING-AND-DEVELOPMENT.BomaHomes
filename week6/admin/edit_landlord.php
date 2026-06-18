<?php
include("../config/connection.php");

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $national_id = mysqli_real_escape_string($conn,$_POST['national_id']);

    mysqli_query($conn,"UPDATE users SET

    fullname='$fullname',
    email='$email',
    phone='$phone',
    national_id='$national_id'

    WHERE id='$id'");

    header("Location:view_landlords.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Landlord</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Edit Landlord</h2>

<form method="POST">

<div class="mb-3">
<label>Full Name</label>
<input type="text" name="fullname" class="form-control" value="<?php echo $row['fullname']; ?>" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
</div>

<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
</div>

<div class="mb-3">
<label>National ID</label>
<input type="text" name="national_id" class="form-control" value="<?php echo $row['national_id']; ?>" required>
</div>

<button type="submit" name="update" class="btn btn-primary">
Update Landlord
</button>

<a href="view_landlords.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</body>
</html>