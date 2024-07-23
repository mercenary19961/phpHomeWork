<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['roleid'] != 1) {
    header("Location: login.php");
    exit();
}
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        header("Location: admin.php");
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
$pdo = null;
?>
