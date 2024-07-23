<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['roleid'] != 1) {
    header("Location: login.php");
    exit();
}
include 'config.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    try {
        // Check if the user is an admin
        $sql = "SELECT roleid FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['roleid'] != 1) {
            // Proceed with deletion
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $userId]);
            echo "User deleted successfully.";
        } else {
            echo "You cannot delete an admin user.";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "User ID not specified.";
}

$pdo = null;
header("Location: admin.php");
?>
