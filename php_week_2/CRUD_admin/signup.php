<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            text-align: center;
        }
        .form-container {
            width: 100%;
            max-width: 600px;
        }
        .btn-custom {
            width: 100%;
            margin: 10px 0;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Sign up</h2>
            <p>Create an Account, It's free</p>
            <form name="signupForm" action="signup_action.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName">
                        <span class="error" id="firstNameError"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="middleName">Middle Name:</label>
                        <input type="text" class="form-control" id="middleName" name="middleName">
                        <span class="error" id="middleNameError"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName">
                        <span class="error" id="lastNameError"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="familyName">Family Name:</label>
                        <input type="text" class="form-control" id="familyName" name="familyName">
                        <span class="error" id="familyNameError"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <span class="error" id="emailError"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                        <span class="error" id="phoneNumberError"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="userImage">Profile Image:</label>
                    <input type="file" class="form-control" id="userImage" name="userImage">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="error" id="passwordError"></span>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                    <span class="error" id="confirmPasswordError"></span>
                </div>
                <button type="submit" class="btn btn-danger btn-custom">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
    
    <script>
        function validateForm() {
            let valid = true;

            // Reset error messages
            document.querySelectorAll('.error').forEach(function (el) {
                el.textContent = '';
            });

            // Name validation
            const namePattern = /^[A-Za-z]{2,}$/;
            ['firstName', 'middleName', 'lastName', 'familyName'].forEach(function (field) {
                const value = document.forms["signupForm"][field].value;
                if (!value.match(namePattern)) {
                    document.getElementById(field + 'Error').textContent = 'Name must be at least 2 characters long and contain no numbers.';
                    valid = false;
                }
            });

            // Phone number validation
            const phonePattern = /^\d{10}$/;
            let phoneNumber = document.forms["signupForm"]["phoneNumber"].value;
            phoneNumber = phoneNumber.replace(/\D/g, ''); // Remove non-numeric characters
            if (!phoneNumber.match(phonePattern)) {
                document.getElementById('phoneNumberError').textContent = 'Phone number must be exactly 10 digits.';
                valid = false;
            }

            // Password validation
            const password = document.forms["signupForm"]["password"].value;
            const confirmPassword = document.forms["signupForm"]["confirmPassword"].value;
            const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}$/;
            if (!password.match(passwordPattern)) {
                document.getElementById('passwordError').textContent = 'Password must be at least 8 characters long and include uppercase, lowercase, numbers, and special characters.';
                valid = false;
            }
            if (password !== confirmPassword) {
                document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
                valid = false;
            }

            return valid;
        }
    </script>
</body>
</html>
