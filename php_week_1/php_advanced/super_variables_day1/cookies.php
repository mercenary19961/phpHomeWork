<?php include 'header.php'; ?>

<div class="content">
    <h2>Manage Cookies</h2>
    <?php
        // Set cookies
        $cookie_name = "user";
        $cookie_value = "John Doe";
        $expiry_time = time() + (60 * 60 * 24 * 30); // 30 days
        $cookie_path = "/";
        $domain = ""; // Default domain
        $secure = false;
        $httponly = true;

        setcookie($cookie_name, $cookie_value, $expiry_time, $cookie_path, $domain, $secure, $httponly);

        echo "<div class='info-box'>Cookie named '$cookie_name' is set!<br></div>";

        // Retrieve cookies
        if(isset($_COOKIE[$cookie_name])) {
            echo "<div class='info-box'>Cookie value: " . $_COOKIE[$cookie_name] . "<br></div>";
        }

        // Delete cookies
        setcookie($cookie_name, "", time() - 3600, $cookie_path, $domain, $secure, $httponly);
        echo "<div class='info-box'>Cookie named '$cookie_name' is deleted.</div>";
    ?>
</div>

</body>
</html>
