<!-- view_user.php -->
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
    $sql = "SELECT first_name, middle_name, last_name, family_name, email, phone_number, user_image FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $_GET['id']]);
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
        <h2><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'] . ' ' . $user['family_name']); ?></h2>
        <?php if ($user['user_image']) { ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($user['user_image']); ?>" alt="User Image" class="user-image">
        <?php } ?>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Phone Number: <?php echo htmlspecialchars($user['phone_number']); ?></p>
        <a href="admin.php" class="btn btn-primary">Back to Admin</a>
    </div>
</body>
</html>
