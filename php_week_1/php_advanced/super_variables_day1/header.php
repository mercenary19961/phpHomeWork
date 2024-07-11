<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Super Variables</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Super Variables</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="calculator.php">Calculator</a>
            <a href="todo.php">To-Do List</a>
            <a href="cookies.php">Manage Cookies</a>
        </nav>
        <p>Page requested at: <?php echo date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']); ?></p>
    </header>
