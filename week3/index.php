<!DOCTYPE html>
<html>
<head>
    <title>BomaHomes Form Validation</title>

    <link rel="stylesheet" href="css/style.css">

    <script src="js/validation.js"></script>

</head>
<body>

<div class="container">

<h2>BomaHomes Login Form</h2>

<form action="validation.php" method="POST" onsubmit="return validateForm()">

<input type="email" id="email" name="email" placeholder="Enter Email">

<input type="password" id="password" name="password" placeholder="Enter Password">

<button type="submit">Submit</button>

</form>

</div>

</body>
</html>