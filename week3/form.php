<!DOCTYPE html>
<html>
<head>
    <title>Form Validation Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            width: 500px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h2 {
            color: #2d3436;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #636e72;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #dfe6e9;
            border-radius: 8px;
            box-sizing: border-box;
        }
        input:focus {
            outline: none;
            border-color: #6c5ce7;
        }
        input.error {
            border-color: #e17055;
        }
        input.success {
            border-color: #00b894;
        }
        button {
            background: #6c5ce7;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
        }
        button:hover {
            background: #5f3dc4;
        }
        .back {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #6c5ce7;
            text-decoration: none;
        }
        .back:hover {
            text-decoration: underline;
        }
        .error-msg {
            color: #e17055;
            font-size: 13px;
            margin-top: 5px;
        }
        .success-msg {
            color: #00b894;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📝 Form Validation Demo</h2>
    <form id="demoForm" onsubmit="return validateForm()">
        <div class="form-group">
            <label>Username</label>
            <input type="text" id="username" placeholder="Enter username (min 3 chars)" onkeyup="validateField('username', 3)">
            <div id="usernameError" class="error-msg"></div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" id="email" placeholder="Enter your email" onkeyup="validateEmail()">
            <div id="emailError" class="error-msg"></div>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="tel" id="phone" placeholder="Enter phone number" onkeyup="validatePhone()">
            <div id="phoneError" class="error-msg"></div>
        </div>

        <button type="submit">Submit Form</button>
    </form>

    <a href="index.php" class="back">← Back to Home</a>
</div>

<script>
function validateField(id, minLength) {
    let input = document.getElementById(id);
    let error = document.getElementById(id + "Error");
    
    if(input.value.length < minLength && input.value.length > 0) {
        input.className = "error";
        error.textContent = "❌ Minimum " + minLength + " characters required";
        error.className = "error-msg";
        return false;
    } else if(input.value.length >= minLength) {
        input.className = "success";
        error.textContent = "✅ Valid";
        error.className = "success-msg";
        return true;
    }
    input.className = "";
    error.textContent = "";
    return false;
}

function validateEmail() {
    let email = document.getElementById("email");
    let error = document.getElementById("emailError");
    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if(email.value.length > 0) {
        if(pattern.test(email.value)) {
            email.className = "success";
            error.textContent = "✅ Valid email";
            error.className = "success-msg";
            return true;
        } else {
            email.className = "error";
            error.textContent = "❌ Invalid email format";
            error.className = "error-msg";
            return false;
        }
    }
    email.className = "";
    error.textContent = "";
    return false;
}

function validatePhone() {
    let phone = document.getElementById("phone");
    let error = document.getElementById("phoneError");
    let pattern = /^[0-9]{10,15}$/;
    
    if(phone.value.length > 0) {
        if(pattern.test(phone.value)) {
            phone.className = "success";
            error.textContent = "✅ Valid phone number";
            error.className = "success-msg";
            return true;
        } else {
            phone.className = "error";
            error.textContent = "❌ Enter 10-15 digits only";
            error.className = "error-msg";
            return false;
        }
    }
    phone.className = "";
    error.textContent = "";
    return false;
}

function validateForm() {
    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;

    if(username.length < 3) {
        alert("❌ Username must be at least 3 characters");
        return false;
    }

    if(!email.includes("@") || !email.includes(".")) {
        alert("❌ Please enter a valid email");
        return false;
    }

    if(phone.length < 10) {
        alert("❌ Phone number must be at least 10 digits");
        return false;
    }

    alert("✅ Form submitted successfully! (Demo)");
    return false;
}
</script>
</body>
</html>