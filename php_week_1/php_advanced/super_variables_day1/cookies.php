<?php include 'header.php'; ?>

<div class="content">
    <h2>Manage Cookies</h2>
    <?php

        $cookie_name = "user";
        $cookie_value = "Zaid Sabbagh";
        $expiry_time = time() + (5); 
        $cookie_path = "/";
        $domain = ""; 
        $secure = false;
        $httponly = true;

        setcookie($cookie_name, $cookie_value, $expiry_time, $cookie_path, $domain, $secure, $httponly);

        echo "<div class='info-box'>Cookie named '$cookie_name' is set!<br></div>";

        if(isset($_COOKIE[$cookie_name])) {
            echo "<div class='info-box'>Cookie value: " . $_COOKIE[$cookie_name] . "<br></div>";
        }

        setcookie($cookie_name, "", time() - 5, $cookie_path, $domain, $secure, $httponly);
        echo "<div class='info-box'>Cookie named '$cookie_name' is deleted.</div>";

    ?>
</div>

</body>
</html>
