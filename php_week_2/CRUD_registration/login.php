<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_management";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$email = $password = "";
$email_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check input errors before checking in database
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT id, name, email, password FROM users WHERE email = ?";

        if ($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("s", $param_email);

            $param_email = $email;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $name, $email, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session and save the user's details
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;
                            $_SESSION["email"] = $email;

                            header("location: welcome.php");
                        } else {
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid email or password.";
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Login</h2>
        <?php
        if (!empty($login_err)) {
            echo "<div class='alert alert-danger'>$login_err</div>";
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="text-danger"><?php echo $email_err; ?></span>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="text-danger"><?php echo $password_err; ?></span>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Login">
                <a href="register.php" class="btn btn-secondary">Register Page</a>
            </div>
        </form>
    </div>
</body>
</html>
