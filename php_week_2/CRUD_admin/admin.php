<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['roleid'] == 2) {
    header("Location: login.php");
    exit();
}
include 'config.php';

try {
    $sql = "SELECT users.id, users.first_name, users.middle_name, users.last_name, users.family_name, users.email, users.date_created, users.phone_number, users.user_image, roles.role 
            FROM users 
            INNER JOIN roles ON users.roleid = roles.roleid";
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
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($user['user_image']); ?>" alt="User Image" class="user-image" style="width:50px;height:50px;"></td>
                        <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'] . ' ' . $user['family_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['date_created']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="view_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-info mx-1">View</a>
                                <a href="edit_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-warning mx-1">Edit</a>
                                <a href="delete_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-danger mx-1" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
