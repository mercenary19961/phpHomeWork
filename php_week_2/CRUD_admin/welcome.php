<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

try {
    $sql = "SELECT full_name, user_image FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $_SESSION['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;

$userImage = $user['user_image'] ? htmlspecialchars($user['user_image']) : 'uploads/default.jpg';
$firstName = explode(' ', trim($user['full_name']))[0];
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
        <h2>Welcome, <?php echo htmlspecialchars($firstName); ?>!</h2>
        <img src="<?php echo $userImage; ?>" alt="User Image" class="user-image">
        <p>Your email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>
</body>
</html>
