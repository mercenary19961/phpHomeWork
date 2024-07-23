<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

try {
    $sql = "SELECT first_name, email, user_image FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $_SESSION['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?php echo htmlspecialchars($user['user_image']); ?>" alt="Profile Image" class="profile-img">
        <h2>Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</h2>
        <p>Your email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Welcome to the website!</p>
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>
</body>
</html>
