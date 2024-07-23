<!-- admin.php -->
<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['roleid'] != 1) {
    header("Location: login.php");
    exit();
}
include 'config.php';

try {
    $sql = "SELECT id, first_name, middle_name, last_name, family_name, email, phone_number, user_image, date_created, roleid FROM users";
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
        .btn-group-vertical {
            display: flex;
            flex-direction: column;
        }
        .btn-group-vertical .btn {
            margin-bottom: 5px;
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
                        <td>
                            <?php if ($user['user_image']) { ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($user['user_image']); ?>" alt="User Image" class="user-image">
                            <?php } ?>
                        </td>
                        <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'] . ' ' . $user['family_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['date_created']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($user['roleid'] == 1 ? 'admin' : 'user'); ?></td>
                        <td>
                            <div class="btn-group" role="group">
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
