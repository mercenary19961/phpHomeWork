<?php include 'header.php'; ?>

<div class="content">
    <h2>Project Information</h2>
    <div class="info-box">
        <?php
            echo 'Project Name: Super Variables<br>';
            echo 'Script Name: ' . basename($_SERVER['SCRIPT_NAME']) . '<br>';
        ?>
    </div>

    <h2>Page Refresh Counter</h2>
    <div class="info-box">
        <?php
            session_start([
                'cookie_lifetime' => 0,
            ]);
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
            $visitor_count_file = 'visitors.txt';
            if (!file_exists($visitor_count_file)) {
                file_put_contents($visitor_count_file, '0');
            }

            $visitor_count = file_get_contents($visitor_count_file);
            $visitor_count++;
            file_put_contents($visitor_count_file, $visitor_count);

            echo 'Number of visitors: ' . $visitor_count . '<br>';
        ?>
    </div>

    <?php include 'form.php'; ?>
</div>

</body>
</html>
