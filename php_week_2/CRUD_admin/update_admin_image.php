<?php
session_start();
include 'config.php';

try {
    // Path to the image file
    $imagePath = 'uploads/my Formal image.jpg';
    
    // Check if the file exists
    if (!file_exists($imagePath)) {
        throw new Exception("File not found: $imagePath");
    }
    
    // Read the image file contents
    $imageData = file_get_contents($imagePath);
    
    // Prepare and execute the update query
    $sql = "UPDATE users SET user_image = :userImage WHERE email = :email"; // Replace with appropriate condition to identify the admin user
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':userImage' => $imageData,
        ':email' => 'sabbaghzaid@gmail.com' // Replace with the correct admin user email if different
    ]);
    
    echo "Admin user image updated successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;
?>
