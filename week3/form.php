<!DOCTYPE html>
<html>
<head>
    <title>Form Validation</title>

    <script>

    function validateForm(){

        let name =
        document.forms["myForm"]["name"].value;

        let email =
        document.forms["myForm"]["email"].value;

        if(name == ""){
            alert("Name Required");
            return false;
        }

        if(email == ""){
            alert("Email Required");
            return false;
        }

        return true;
    }

    function checkStrength(){

        let password =
        document.getElementById("password").value;

        let strength =
        document.getElementById("strength");

        if(password.length < 6){

            strength.innerHTML =
            "Weak Password";

            strength.style.color =
            "red";
        }

        else{

            strength.innerHTML =
            "Strong Password";

            strength.style.color =
            "green";
        }
    }

    </script>

</head>
<body>

<h2>User Form</h2>

<form
name="myForm"
action="validation.php"
method="POST"
onsubmit="return validateForm()">

<input
type="text"
name="name"
placeholder="Full Name">

<br><br>

<input
type="email"
name="email"
placeholder="Email">

<br><br>

<input
type="password"
id="password"
name="password"
placeholder="Password"
onkeyup="checkStrength()">

<p id="strength"></p>

<button type="submit">
Submit
</button>

</form>

</body>
</html>