<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['roleid'] != 1) {
    header("Location: login.php");
    exit();
}
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $familyName = $_POST['familyName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["userImage"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate and upload image
    $check = getimagesize($_FILES["userImage"]["tmp_name"]);
    if($check !== false) {
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
                    ':password' => $password
                ]);

                header("Location: admin.php");
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
    $pdo = null;
}
?>
