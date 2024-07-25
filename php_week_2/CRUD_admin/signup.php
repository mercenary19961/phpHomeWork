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
    <script>
        function validateForm() {
            var fullName = document.forms["signupForm"]["fullName"].value;
            var email = document.forms["signupForm"]["email"].value;
            var phoneNumber = document.forms["signupForm"]["phoneNumber"].value;
            var password = document.forms["signupForm"]["password"].value;
            var confirmPassword = document.forms["signupForm"]["confirmPassword"].value;

            var namePattern = /^([A-Za-z]{2,}\s){3}[A-Za-z]{2,}$/;
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var phonePattern = /^\d{10}$/;
            var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}$/;

            var errors = {};

            if (!fullName.match(namePattern)) {
                errors.fullName = "Full name must consist of four words with only letters and at least two letters each.";
            }
            if (!email.match(emailPattern)) {
                errors.email = "Invalid email format.";
            }
            if (!phoneNumber.match(phonePattern)) {
                errors.phoneNumber = "Phone number must be exactly 10 digits.";
            }
            if (!password.match(passwordPattern)) {
                errors.password = "Password must be at least 8 characters long and include uppercase, lowercase, numbers, and special characters.";
            }
            if (password !== confirmPassword) {
                errors.confirmPassword = "Passwords do not match.";
            }

            var errorKeys = Object.keys(errors);
            if (errorKeys.length > 0) {
                errorKeys.forEach(function(key) {
                    document.getElementById(key + "Error").innerText = errors[key];
                });
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Sign Up</h2>
            <p>Create an Account, It's free</p>
            <form name="signupForm" action="signup_action.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="fullName">Full Name:</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo isset($_SESSION['inputs']['fullName']) ? htmlspecialchars($_SESSION['inputs']['fullName']) : ''; ?>">
                    <span id="fullNameError" class="error"><?php echo isset($_SESSION['errors']['fullName']) ? $_SESSION['errors']['fullName'] : ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_SESSION['inputs']['email']) ? htmlspecialchars($_SESSION['inputs']['email']) : ''; ?>">
                    <span id="emailError" class="error"><?php echo isset($_SESSION['errors']['email']) ? $_SESSION['errors']['email'] : ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo isset($_SESSION['inputs']['phoneNumber']) ? htmlspecialchars($_SESSION['inputs']['phoneNumber']) : ''; ?>">
                    <span id="phoneNumberError" class="error"><?php echo isset($_SESSION['errors']['phoneNumber']) ? $_SESSION['errors']['phoneNumber'] : ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="userImage">Profile Image:</label>
                    <input type="file" class="form-control" id="userImage" name="userImage">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span id="passwordError" class="error"><?php echo isset($_SESSION['errors']['password']) ? $_SESSION['errors']['password'] : ''; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                    <span id="confirmPasswordError" class="error"><?php echo isset($_SESSION['errors']['confirmPassword']) ? $_SESSION['errors']['confirmPassword'] : ''; ?></span>
                </div>
                <button type="submit" class="btn btn-danger btn-custom">Sign Up</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
    <?php
    if (isset($_SESSION['email_exists'])) {
        echo '<script>alert("This email is already registered.");</script>';
        unset($_SESSION['email_exists']);
    }
    ?>
</body>
</html>

<?php
// Clear errors and inputs after displaying them
unset($_SESSION['errors']);
unset($_SESSION['inputs']);
?>
