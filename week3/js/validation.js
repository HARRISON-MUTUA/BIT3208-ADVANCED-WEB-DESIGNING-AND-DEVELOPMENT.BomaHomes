function validateForm(){

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if(email == ""){
        alert("Email Required");
        return false;
    }

    if(password == ""){
        alert("Password Required");
        return false;
    }

    if(password.length < 6){
        alert("Password must be at least 6 characters");
        return false;
    }

    return true;
}