<?php
session_start();
include 'config.php';

$errors = [];

function validateFullName($name) {
    return preg_match('/^([A-Za-z]{2,}\s){3}[A-Za-z]{2,}$/', $name);
}

function validatePhoneNumber($phoneNumber) {
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber); // Remove non-numeric characters
    return preg_match('/^\d{10}$/', $phoneNumber);
}

function validatePassword($password) {
    return preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}$/', $password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (!validateFullName($fullName)) {
        $errors['fullName'] = 'Full name must consist of four words with only letters and at least two letters each.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }
    if (!validatePhoneNumber($phoneNumber)) {
        $errors['phoneNumber'] = 'Phone number must be exactly 10 digits.';
    }
    if (!validatePassword($password)) {
        $errors['password'] = 'Password must be at least 8 characters long and include uppercase, lowercase, numbers, and special characters.';
    }
    if ($password !== $confirmPassword) {
        $errors['confirmPassword'] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        // Check if email already exists
        try {
            $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $emailExists = $stmt->fetchColumn();

            if ($emailExists) {
                $_SESSION['email_exists'] = true;
                $_SESSION['inputs'] = $_POST;
                header("Location: signup.php");
                exit();
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (empty($errors)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Set default image path
        $targetFile = 'uploads/default.jpg'; // Ensure you have a default.jpg image in the uploads directory

        // Check if an image is uploaded
        if (!empty($_FILES["userImage"]["name"])) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["userImage"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["userImage"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetFile)) {
                    // Use the uploaded file as the user image
                } else {
                    $errors['userImage'] = "Sorry, there was an error uploading your file.";
                }
            } else {
                $errors['userImage'] = "File is not an image.";
            }
        }

        if (empty($errors)) {
            try {
                $sql = "INSERT INTO users (full_name, email, phone_number, user_image, password, roleid) 
                        VALUES (:fullName, :email, :phoneNumber, :userImage, :password, 2)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':fullName' => $fullName,
                    ':email' => $email,
                    ':phoneNumber' => $phoneNumber,
                    ':userImage' => $targetFile,
                    ':password' => $passwordHash
                ]);

                header("Location: login.php");
                exit();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    // Store errors and input values in the session and redirect back to the signup page
    $_SESSION['errors'] = $errors;
    $_SESSION['inputs'] = $_POST;
    header("Location: signup.php");
    exit();
}
?>
