<?php
    if (isset($_GET['url'])) {
        $url = $_GET['url'];

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            header("Location: $url");
            exit();
        } else {
            echo "<div class='info-box'>Invalid URL.</div>";
        }
    } else {
        echo "<div class='info-box'>No URL provided.</div>";
    }
?>
