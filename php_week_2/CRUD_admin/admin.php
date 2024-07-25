<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['roleid'] != 1) {
    header("Location: login.php");
    exit();
}
include 'config.php';

try {
    $sql = "SELECT id, full_name, email, phone_number, user_image, date_created, roleid FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            margin: 10px 0;
        }
        table tbody td {
            vertical-align: middle;
        }
        img.user-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50px;
            height: 50px;
        }
        .btn-group-horizontal .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Page</h2>
        <div class="d-flex justify-content-between">
            <a href="create_user.php" class="btn btn-success btn-custom">Create New User</a>
            <a href="logout.php" class="btn btn-primary btn-custom">Logout</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Created</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { 
                    $userImage = $user['user_image'] ? htmlspecialchars($user['user_image']) : 'uploads/default.jpg';
                    $firstName = explode(' ', trim($user['full_name']))[0];
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td>
                            <img src="<?php echo $userImage; ?>" alt="User Image" class="user-image">
                        </td>
                        <td><?php echo htmlspecialchars($firstName); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['date_created']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($user['roleid'] == 1 ? 'admin' : 'user'); ?></td>
                        <td>
                            <div class="btn-group btn-group-horizontal" role="group">
                                <a href="view_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-info">View</a>
                                <a href="edit_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-warning">Edit</a>
                                <a href="delete_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
