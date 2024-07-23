<!-- welcome.php -->
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

try {
    $sql = "SELECT first_name, user_image FROM users WHERE email = :email";
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
        <h2>Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</h2>
        <?php if ($user['user_image']) { ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($user['user_image']); ?>" alt="User Image" class="user-image">
        <?php } ?>
        <p>Your email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>
</body>
</html>
