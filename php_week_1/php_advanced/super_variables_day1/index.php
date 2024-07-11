<?php include 'header.php'; ?>

<div class="content">
    <h2>Project Information</h2>
    <div class="info-box">
        <?php
            echo 'Project Name: Super Variables <br>';
            echo 'Script Name: ' . basename($_SERVER['SCRIPT_NAME']) . '<br>';
        ?>
    </div>

    <h2>Page Refresh Counter</h2>
    <div class="info-box">
        <?php
            session_start();
            if (!isset($_SESSION['counter'])) {
                $_SESSION['counter'] = 0;
            }
            $_SESSION['counter']++;
            echo 'This page has been refreshed ' . $_SESSION['counter'] . ' times.<br>';
        ?>
    </div>

    <h2>Number of Visitors</h2>
    <div class="info-box">
        <?php
            if (!isset($_COOKIE['visitor'])) {
                $_SESSION['visitor_counter'] = 1;
                setcookie('visitor', '1', time() + (1));
            } else {
                
                $_SESSION['visitor_counter']++;
            }

            echo 'Number of unique visitors: ' . $_SESSION['visitor_counter'] . '<br>';
        ?>
    </div>

    <?php include 'form.php'; ?>
</div>

</body>
</html>
