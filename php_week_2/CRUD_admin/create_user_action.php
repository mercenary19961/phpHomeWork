<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['roleid'] != 1) {
    header("Location: login.php");
    exit();
}
include 'config.php';

function validateFullName($name) {
    return preg_match('/^([A-Za-z]{2,}\s){3}[A-Za-z]{2,}$/', $name);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!validateFullName($fullName)) {
        echo "Full name must consist of four words with only letters and at least two letters each.";
        exit();
    }

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
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    }

    try {
        $sql = "INSERT INTO users (full_name, email, phone_number, user_image, password, roleid) 
                VALUES (:fullName, :email, :phoneNumber, :userImage, :password, 2)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fullName' => $fullName,
            ':email' => $email,
            ':phoneNumber' => $phoneNumber,
            ':userImage' => $targetFile,
            ':password' => $password
        ]);

        header("Location: admin.php");
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
$pdo = null;
?>
