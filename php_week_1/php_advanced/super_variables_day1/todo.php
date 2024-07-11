<?php include 'header.php'; ?>

<div class="content">
    <h2>To-Do List</h2>

    <form class="todo-list" action="todo.php" method="post">
        <input type="text" name="todo_item" placeholder="Enter a new to-do item" required>
        <input type="submit" value="Add">
    </form>

    <?php
        session_start();

        if (!isset($_SESSION['todo_list'])) {
            $_SESSION['todo_list'] = array();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todo_item'])) {
            $new_item = htmlspecialchars($_POST['todo_item']);
            $_SESSION['todo_list'][] = $new_item;
        }

        if (isset($_SESSION['todo_list']) && count($_SESSION['todo_list']) > 0) {
            echo '<ul>';
            foreach ($_SESSION['todo_list'] as $item) {
                echo '<li>' . $item . '</li>';
            }
            echo '</ul>';
        }
    ?>
</div>

</body>
</html>
