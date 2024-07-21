<?php
// Define the database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$database = "php_crud";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare the SQL delete statement
    $sql = "DELETE FROM employees WHERE id=$id";

    // Execute the query
    if ($connection->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    // Close the connection
    $connection->close();
}

// Redirect back to the index page
header("location: index.php");
exit;
?>
