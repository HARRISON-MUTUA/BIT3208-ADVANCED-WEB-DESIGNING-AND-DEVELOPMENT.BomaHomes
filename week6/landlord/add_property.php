<?php
include("../config/connection.php");

$message="";

if(isset($_POST['save'])){

$title=$_POST['title'];
$location=$_POST['location'];
$price=$_POST['price'];
$bedrooms=$_POST['bedrooms'];
$bathrooms=$_POST['bathrooms'];
$description=$_POST['description'];

$image=$_FILES['image']['name'];
$tmp=$_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"../assets/images/".$image);

$landlord_id=1;

$sql="INSERT INTO properties
(landlord_id,title,location,price,bedrooms,bathrooms,description,image)

VALUES

('$landlord_id','$title','$location','$price','$bedrooms','$bathrooms','$description','$image')";

if(mysqli_query($conn,$sql)){

$message="<div class='alert alert-success'>Property Added Successfully</div>";

}else{

$message="<div class='alert alert-danger'>Failed</div>";

}

}
?>

<!DOCTYPE html>

<html>

<head>

<title>Add Property</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Add Property</h2>

<?php echo $message;?>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="title" class="form-control mb-3" placeholder="Property Title" required>

<input type="text" name="location" class="form-control mb-3" placeholder="Location" required>

<input type="number" name="price" class="form-control mb-3" placeholder="Price" required>

<input type="number" name="bedrooms" class="form-control mb-3" placeholder="Bedrooms">

<input type="number" name="bathrooms" class="form-control mb-3" placeholder="Bathrooms">

<textarea name="description" class="form-control mb-3" placeholder="Description"></textarea>

<input type="file" name="image" class="form-control mb-3">

<button class="btn btn-success" name="save">

Save Property

</button>

<a href="view_properties.php" class="btn btn-primary">

View Properties

</a>

</form>

</div>

</body>

</html>