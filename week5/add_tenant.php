<?php
include 'database/connection.php';

if(isset($_POST['save'])){

    $tenant_name = $_POST['tenant_name'];
    $phone = $_POST['phone'];
    $house_number = $_POST['house_number'];
    $rent_amount = $_POST['rent_amount'];

    $sql = "INSERT INTO tenants(
            tenant_name,
            phone,
            house_number,
            rent_amount
            )

            VALUES(
            '$tenant_name',
            '$phone',
            '$house_number',
            '$rent_amount'
            )";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Tenant Added Successfully";
    }else{
        echo "Failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Tenant</title>

    <style>

        

body{
    font-family: Arial;
    background-color: lightgray;
}

.container{
    width: 500px;
    background-color: white;
    margin: 60px auto;
    padding: 30px;
    box-sizing: border-box;
    border-radius: 5px;
}

input{
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border: 1px solid gray;
    border-radius: 4px;
    box-sizing: border-box;
}

button{
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    background-color: green;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover{
    background-color: darkgreen;
}

a{
    text-decoration: none;
    color: blue;
}

h2{
    color: black;
}

</style>
</head>
<body>

<div class="container">

<h2>Add Tenant</h2>

<form method="POST">

<input type="text"
name="tenant_name"
placeholder="Tenant Name"
required>

<input type="text"
name="phone"
placeholder="Phone Number"
required>

<input type="text"
name="house_number"
placeholder="House Number"
required>

<input type="text"
name="rent_amount"
placeholder="Rent Amount"
required>

<button type="submit" name="save">
Save Tenant
</button>

</form>

<br>

<a href="dashboard.php">
Back to Dashboard
</a>

</div>

</body>
</html>