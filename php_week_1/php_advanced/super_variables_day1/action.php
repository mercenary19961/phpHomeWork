<?php include 'header.php'; ?>

<div class="content">
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            echo "<div class='info-box'>Data sent by POST method.<br>Email: $email<br>Password: $password<br></div>";
        } 
        elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email']) && isset($_GET['password'])) {
            $email = $_GET['email'];
            $password = $_GET['password'];
            echo "<div class='info-box'>Data sent by GET method.<br>Email: $email<br>Password: $password<br></div>";
        } else {
            echo "<div class='info-box'>No data was sent.</div>";
        }
    ?>
</div>

</body>
</html>
