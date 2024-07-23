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
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
        <h2>View User Details</h2>
        <img src="<?php echo htmlspecialchars($user['user_image']); ?>" alt="User Image" class="profile-img">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'] . ' ' . $user['family_name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
        <p><strong>Date Created:</strong> <?php echo htmlspecialchars($user['date_created']); ?></p>
        <a href="admin.php" class="btn btn-primary">Back to Admin</a>
    </div>
</body>
</html>
