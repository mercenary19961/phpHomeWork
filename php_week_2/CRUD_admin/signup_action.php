<?php
session_start();
include 'config.php';

$errors = [];

function validateName($name) {
    return preg_match('/^[A-Za-z]{2,}$/', $name);
}

function validatePhoneNumber($phoneNumber) {
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber); // Remove non-numeric characters
    return preg_match('/^\d{10}$/', $phoneNumber);
}

function validatePassword($password) {
    return preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}$/', $password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $familyName = $_POST['familyName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (!validateName($firstName)) {
        $errors['firstName'] = 'First name must be at least 2 characters long and contain no numbers.';
    }
    if (!validateName($middleName)) {
        $errors['middleName'] = 'Middle name must be at least 2 characters long and contain no numbers.';
    }
    if (!validateName($lastName)) {
        $errors['lastName'] = 'Last name must be at least 2 characters long and contain no numbers.';
    }
    if (!validateName($familyName)) {
        $errors['familyName'] = 'Family name must be at least 2 characters long and contain no numbers.';
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
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["userImage"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["userImage"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetFile)) {
                try {
                    $sql = "INSERT INTO users (first_name, middle_name, last_name, family_name, email, phone_number, user_image, password, roleid) 
                            VALUES (:firstName, :middleName, :lastName, :familyName, :email, :phoneNumber, :userImage, :password, 2)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':firstName' => $firstName,
                        ':middleName' => $middleName,
                        ':lastName' => $lastName,
                        ':familyName' => $familyName,
                        ':email' => $email,
                        ':phoneNumber' => $phoneNumber,
                        ':userImage' => $targetFile,
                        ':password' => $passwordHash
                    ]);

                    $_SESSION['email'] = $email;
                    header("Location: login.php");
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                $errors['userImage'] = 'Sorry, there was an error uploading your file.';
            }
        } else {
            $errors['userImage'] = 'File is not an image.';
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: signup.php");
    }
}
?>
