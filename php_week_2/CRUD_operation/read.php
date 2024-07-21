<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Employees Details</h2>
        <a class="btn btn-primary" href="create.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Enable detailed error reporting
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "php_crud";

                    // Create connection
                    $connection = new mysqli($servername, $username, $password, $database);

                    // Check connection
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    // Read all rows from database table
                    $sql = "SELECT * FROM employees";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }

                    // Read data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Check if keys exist in the array
                        $id = isset($row['id']) ? $row['id'] : 'N/A';
                        $name = isset($row['Name']) ? $row['Name'] : 'N/A';
                        $address = isset($row['Address']) ? $row['Address'] : 'N/A';
                        $salary = isset($row['Salary']) ? $row['Salary'] : 'N/A';

                        echo "
                        <tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$address</td>
                            <td>$salary</td>
                            <td>
                                <a class='btn btn-secondary btn-sm' href='read.php?id=$id'>View</a>
                                <a class='btn btn-primary btn-sm' href='update.php?id=$id'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='delete.php?id=$id'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }

                    // Close the connection
                    $connection->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
