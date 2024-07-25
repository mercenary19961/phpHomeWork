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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $targetFile = $user['user_image'];

    if (!empty($_FILES["userImage"]["name"])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["userImage"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["userImage"]["tmp_name"]);
        if($check !== false && move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetFile)) {
            $targetFile = $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    try {
        $sql = "UPDATE users SET full_name = :fullName, email = :email, phone_number = :phoneNumber, user_image = :userImage WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fullName' => $fullName,
            ':email' => $email,
            ':phoneNumber' => $phoneNumber,
            ':userImage' => $targetFile,
            ':id' => $id
        ]);

        header("Location: admin.php");
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
    <title>Edit User</title>
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
        .form-container {
            width: 100%;
            max-width: 600px;
        }
        .btn-custom {
            width: 100%;
            margin: 10px 0;
        }
    </style>
    <script>
        function validateForm() {
            var name = document.forms["editUserForm"]["fullName"].value;
            var namePattern = /^([A-Za-z]{2,}\s){3}[A-Za-z]{2,}$/;

            if (!name.match(namePattern)) {
                alert("Full name must consist of four words with only letters and at least two letters each.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Edit User</h2>
            <form name="editUserForm" action="edit_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                <div class="form-group">
                    <label for="fullName">Full Name:</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="userImage">Profile Image:</label>
                    <input type="file" class="form-control" id="userImage" name="userImage">
                    <?php
                    $userImage = $user['user_image'] ? htmlspecialchars($user['user_image']) : 'uploads/default.jpg';
                    ?>
                    <img src="<?php echo $userImage; ?>" alt="User Image" style="width:50px;height:50px;">
                </div>
                <button type="submit" class="btn btn-warning btn-custom">Update User</button>
                <a href="admin.php" class="btn btn-secondary btn-custom">Back to Admin</a>
            </form>
        </div>
    </div>
</body>
</html>
