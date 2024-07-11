<?php include 'header.php'; ?>

<div class="content">
    <form id="calculator-form" action="calculator.php" method="post">
        Number 1: <input type="number" name="num1" required><br>
        Number 2: <input type="number" name="num2" required><br>
        Operation:
        <select name="operation" required>
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select><br>
        <input type="submit" value="Calculate">
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $operation = $_POST['operation'];
            $result = null;

            switch ($operation) {
                case 'add':
                    $result = $num1 + $num2;
                    break;
                case 'subtract':
                    $result = $num1 - $num2;
                    break;
                case 'multiply':
                    $result = $num1 * $num2;
                    break;
                case 'divide':
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                    } else {
                        $result = "Error: Division by zero";
                    }
                    break;
            }

            echo "<div class='result'>Result: $result</div>";
        }
    ?>
</div>

</body>
</html>
