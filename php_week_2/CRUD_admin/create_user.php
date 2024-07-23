<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
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
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Create User</h2>
            <form name="createUserForm" action="create_user_action.php" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="middleName">Middle Name:</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="familyName">Family Name:</label>
                        <input type="text" class="form-control" id="familyName" name="familyName" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="userImage">Profile Image:</label>
                    <input type="file" class="form-control" id="userImage" name="userImage" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                <button type="submit" class="btn btn-success btn-custom">Create User</button>
                <a href="admin.php" class="btn btn-secondary btn-custom">Back to Admin</a>
            </form>
        </div>
    </div>
</body>
</html>
