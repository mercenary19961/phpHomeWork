<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

if (!isset($_GET['id'])) {
    echo "User ID not specified.";
    exit();
}

try {
    $sql = "SELECT full_name, email, phone_number, user_image FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $_GET['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;

$userImage = $user['user_image'] ? htmlspecialchars($user['user_image']) : 'uploads/default.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View User</title>
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
        .user-image {
            display: block;
            margin: 20px auto;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo htmlspecialchars($user['full_name']); ?></h2>
        <img src="<?php echo $userImage; ?>" alt="User Image" class="user-image">
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Phone Number: <?php echo htmlspecialchars($user['phone_number']); ?></p>
        <a href="admin.php" class="btn btn-primary">Back to Admin</a>
    </div>
</body>
</html>
