<?php
include 'database/connection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>BomaHomes - Week 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        h1 {
            color: #2d3436;
            text-align: center;
        }
        h1 span {
            color: #6c5ce7;
        }
        
        .nav-links {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 20px 0 30px 0;
            flex-wrap: wrap;
        }
        .nav-links a {
            background: #6c5ce7;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease;
            font-size: 14px;
        }
        .nav-links a:hover {
            background: #5f3dc4;
        }
        .nav-links a.contact {
            background: #00b894;
        }
        .nav-links a.contact:hover {
            background: #00a381;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2d3436;
        }
        input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #dfe6e9;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        input:focus {
            outline: none;
            border-color: #6c5ce7;
        }
        button {
            background: #6c5ce7;
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #5f3dc4;
        }
        
        .strength-container {
            margin-top: 8px;
        }
        #strength {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .strength-bar {
            width: 100%;
            height: 6px;
            background: #dfe6e9;
            border-radius: 3px;
            overflow: hidden;
        }
        .strength-bar-fill {
            height: 100%;
            width: 0%;
            border-radius: 3px;
            transition: width 0.3s ease;
        }
        .weak { color: #e17055; }
        .medium { color: #fdcb6e; }
        .strong { color: #00b894; }
        .match-yes { color: #00b894; }
        .match-no { color: #e17055; }
        
        .password-rules {
            background: #f8f9fa;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 8px;
            font-size: 13px;
        }
        .password-rules ul {
            margin: 5px 0;
            padding-left: 20px;
        }
        .password-rules li {
            margin: 3px 0;
        }
        .password-rules li.valid {
            color: #00b894;
            list-style-type: "✅ ";
        }
        .password-rules li.invalid {
            color: #e17055;
            list-style-type: "❌ ";
        }
        
        .preview-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
            border: 2px dashed #dfe6e9;
        }
        .preview-box h3 {
            color: #2d3436;
            margin-bottom: 15px;
        }
        .preview-box p {
            margin: 8px 0;
            font-size: 15px;
        }
        .preview-box .label {
            color: #636e72;
        }
        .preview-box .value {
            font-weight: 600;
            color: #2d3436;
        }
        
        hr {
            margin: 30px 0;
            border: none;
            border-top: 2px solid #f1f2f6;
        }
        .demo-badge {
            display: inline-block;
            background: #fdcb6e;
            color: #2d3436;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ===== RESPONSIVE: MOBILE ===== */
        @media (max-width: 768px) {
            .container {
                padding: 25px 20px;
            }
            h1 {
                font-size: 24px;
            }
            .nav-links a {
                padding: 8px 14px;
                font-size: 12px;
                flex: 1;
                text-align: center;
                min-width: 60px;
            }
            .form-group input {
                padding: 10px 14px;
                font-size: 14px;
            }
            .preview-box p {
                font-size: 14px;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            .container {
                padding: 15px;
            }
            h1 {
                font-size: 20px;
            }
            .nav-links {
                gap: 8px;
            }
            .nav-links a {
                padding: 6px 10px;
                font-size: 11px;
                min-width: 50px;
            }
            .form-group input {
                padding: 8px 12px;
                font-size: 13px;
            }
            button {
                font-size: 14px;
                padding: 12px;
            }
            .preview-box {
                padding: 15px;
            }
            .preview-box p {
                font-size: 13px;
            }
            .password-rules {
                font-size: 12px;
                padding: 10px;
            }
            .password-rules ul {
                padding-left: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <h1>🏠 Boma<span>Homes</span></h1>

    <!-- Navigation -->
    <div class="nav-links">
        <a href="form.php">📝 Form Validation</a>
        <a href="../week4/login.php">🔐 Login</a>
        <a href="../week4/register.php">📋 Register</a>
        <a href="../week4/contact.php" class="contact">📧 Contact</a>
    </div>

    <hr>

    <!-- Registration Form -->
    <h2>📝 Registration Form <span class="demo-badge">Demo</span></h2>

    <form id="registerForm" onsubmit="return validateForm()">

        <!-- Full Name -->
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" id="fullname" placeholder="Enter your full name" onkeyup="livePreview()">
        </div>

        <!-- Email -->
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" id="email" placeholder="Enter your email" onkeyup="livePreview()">
        </div>

        <!-- Password -->
        <div class="form-group">
            <label>Password</label>
            <input type="password" id="password" placeholder="Enter your password" onkeyup="checkStrength(); checkMatch(); livePreview();">
            
            <div class="strength-container">
                <div id="strength"></div>
                <div class="strength-bar">
                    <div class="strength-bar-fill" id="strengthBar"></div>
                </div>
            </div>

            <!-- Password Rules -->
            <div class="password-rules">
                <strong>Password Requirements:</strong>
                <ul>
                    <li id="ruleLength">At least 6 characters</li>
                    <li id="ruleLower">Contains lowercase letter (a-z)</li>
                    <li id="ruleUpper">Contains uppercase letter (A-Z)</li>
                    <li id="ruleNumber">Contains number (0-9)</li>
                    <li id="ruleSpecial">Contains special character (!@#$%^&*)</li>
                </ul>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" id="confirm_password" placeholder="Confirm your password" onkeyup="checkMatch(); livePreview();">
            <div id="match" style="font-weight: bold; margin-top: 8px;"></div>
        </div>

        <button type="submit">Register</button>

    </form>

    <!-- Live Preview -->
    <div class="preview-box">
        <h3>👤 Live Preview</h3>
        <p><span class="label">Name:</span> <span class="value" id="previewName">Not entered</span></p>
        <p><span class="label">Email:</span> <span class="value" id="previewEmail">Not entered</span></p>
        <p><span class="label">Password:</span> <span class="value" id="previewPassword">Not entered</span></p>
        <p><span class="label">Strength:</span> <span class="value" id="previewStrength">-</span></p>
    </div>

</div>

<script>
function checkStrength() {
    let password = document.getElementById("password").value;
    let strength = document.getElementById("strength");
    let strengthBar = document.getElementById("strengthBar");
    let previewStrength = document.getElementById("previewStrength");

    updateRules(password);

    if(password.length === 0) {
        strength.innerHTML = "";
        strengthBar.style.width = "0%";
        strengthBar.style.background = "#dfe6e9";
        previewStrength.textContent = "-";
        return;
    }

    if(password.length < 6) {
        strength.innerHTML = "❌ Weak - Use at least 6 characters";
        strength.className = "weak";
        strengthBar.style.width = "20%";
        strengthBar.style.background = "#e17055";
        previewStrength.textContent = "Weak";
        previewStrength.className = "weak";
        return;
    }

    let score = 0;
    if(password.match(/[a-z]/)) score++;
    if(password.match(/[A-Z]/)) score++;
    if(password.match(/[0-9]/)) score++;
    if(password.match(/[^A-Za-z0-9]/)) score++;
    if(password.length >= 8) score++;

    if(score >= 5) {
        strength.innerHTML = "✅ Very Strong Password";
        strength.className = "strong";
        strengthBar.style.width = "100%";
        strengthBar.style.background = "#00b894";
        previewStrength.textContent = "Very Strong";
        previewStrength.className = "strong";
    } else if(score >= 3) {
        strength.innerHTML = "🟡 Medium Password";
        strength.className = "medium";
        strengthBar.style.width = "60%";
        strengthBar.style.background = "#fdcb6e";
        previewStrength.textContent = "Medium";
        previewStrength.className = "medium";
    } else {
        strength.innerHTML = "🔴 Weak Password";
        strength.className = "weak";
        strengthBar.style.width = "30%";
        strengthBar.style.background = "#e17055";
        previewStrength.textContent = "Weak";
        previewStrength.className = "weak";
    }
}

function updateRules(password) {
    let rules = {
        length: password.length >= 6,
        lower: /[a-z]/.test(password),
        upper: /[A-Z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[^A-Za-z0-9]/.test(password)
    };

    let ruleLength = document.getElementById("ruleLength");
    let ruleLower = document.getElementById("ruleLower");
    let ruleUpper = document.getElementById("ruleUpper");
    let ruleNumber = document.getElementById("ruleNumber");
    let ruleSpecial = document.getElementById("ruleSpecial");

    updateRule(ruleLength, rules.length);
    updateRule(ruleLower, rules.lower);
    updateRule(ruleUpper, rules.upper);
    updateRule(ruleNumber, rules.number);
    updateRule(ruleSpecial, rules.special);
}

function updateRule(element, isValid) {
    if(isValid) {
        element.className = "valid";
        element.textContent = element.textContent.replace(/^[✅❌]\s/, "✅ ");
    } else {
        element.className = "invalid";
        element.textContent = element.textContent.replace(/^[✅❌]\s/, "❌ ");
    }
}

function checkMatch() {
    let password = document.getElementById("password").value;
    let confirm = document.getElementById("confirm_password").value;
    let match = document.getElementById("match");

    if(confirm.length === 0) {
        match.innerHTML = "";
        return;
    }

    if(password === confirm) {
        match.innerHTML = "✅ Passwords match";
        match.className = "match-yes";
    } else {
        match.innerHTML = "❌ Passwords do not match";
        match.className = "match-no";
    }
}

function livePreview() {
    let name = document.getElementById("fullname").value || "Not entered";
    let email = document.getElementById("email").value || "Not entered";
    let password = document.getElementById("password").value || "Not entered";

    document.getElementById("previewName").textContent = name;
    document.getElementById("previewEmail").textContent = email;
    document.getElementById("previewPassword").textContent = password.replace(/./g, "*");
}

function validateForm() {
    let name = document.getElementById("fullname").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirm = document.getElementById("confirm_password").value;

    if(name.trim().length < 2) {
        alert("❌ Please enter your full name.");
        document.getElementById("fullname").focus();
        return false;
    }

    if(!email.includes("@") || !email.includes(".")) {
        alert("❌ Please enter a valid email address.");
        document.getElementById("email").focus();
        return false;
    }

    if(password.length < 6) {
        alert("❌ Password must be at least 6 characters long.");
        document.getElementById("password").focus();
        return false;
    }

    if(password !== confirm) {
        alert("❌ Passwords do not match.");
        document.getElementById("confirm_password").focus();
        return false;
    }

    alert("✅ Registration successful! (This is a demo)");
    return false;
}
</script>

</body>
</html>