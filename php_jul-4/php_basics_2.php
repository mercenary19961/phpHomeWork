<?php
    echo "Q1<br><br>";

    $example = 53;

    if (($example >= 1)) {
        for ($i = 2; $i < $example ; $i++) {
            if ($example % $i == 0) {
                echo $example. " Is not a prime number";
                break;
            } else {
                echo $example . " Is a prime number";
                break;
            }
        }
        
    } else {
        echo "Not a prime number";
    }
    

?>

<?php

    echo "<br><br><br>Q2<br><br>";

    $example = "remove";

    echo "Example input : " . $example . "<br>";
    echo "Example output : " . strrev($example) ;


?>

<?php

    echo "<br><br><br>Q3<br><br>";
    $capital = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $capitalArray = str_split($capital);

    $example = "remove";

    $exampleArray = str_split($example);

    echo "Example input : " . $example . "<br>";
    $checkingFunction = array_intersect($exampleArray, $capitalArray);
    if (!empty($checkingFunction)) {
        echo "Your string isn't ok";
    } else {
        echo "Your string is ok";
    }

?>

<?php

    echo "<br><br><br>Q4<br><br>";

    $input1 = 4;
    $input2 = 6;

    echo "Sample input : " . "x = " . $input1 ."&nbsp;&nbsp; y =" . $input2 . "<br>";

    function swapVariables($x, $y) {
        $temp = $x;
        $x = $y;
        $y = $temp;
        return "Sample output : " . "x = " . $x ."&nbsp;&nbsp; y =" . $y . "<br>";
    }

    echo swapVariables($input1, $input2);
?>

<?php

    echo "<br><br><br>Q5<br><br>";

    $input1 = 4;
    $input2 = 6;

    echo "Sample input : " . "x = " . $input1 ."&nbsp;&nbsp; y =" . $input2 . "<br>";

    function swapVariables2($x, $y) {
        $temp = $x;
        $x = $y;
        $y = $temp;
        return "Sample output : " . "x = " . $x ."&nbsp;&nbsp; y =" . $y . "<br>";
    }

    echo swapVariables2($input1, $input2);

?>

<?php

    echo "<br><br><br>Q6<br><br>";
    $example = 8208;
    echo "Example input : " . $example . "<br>";

    function isArmstrongNumber($number) {
        $total = 0;
        $numArray = str_split($number);
        for ($i = 0; $i < count($numArray); $i++) {
            $cubicNum = (int)$numArray[$i] ** count($numArray) ;
            $total += $cubicNum; 
        }
        if ($total == $number) {
            return "Expected Output : " . $number . " is an Armstrong Number.";
        } else {
            return "Expected Output : " . $number . " is not an Armstrong Number.";
        }
    }

    echo isArmstrongNumber($example);
?>

<?php

    echo "<br><br><br>Q7<br><br>";

    $example = "Eva, can i see bees in a cave?";
    echo "Example input : " . $example . "<br>";

    function isPalindrome($str) {
        $cleanString = strtolower(preg_replace('/[^a-zA-Z]/', '', $str));
        $reveredStr = strrev($cleanString);

        if ($cleanString == $reveredStr) {
            return "Expected Output : Yes, it is a palindrome.";
        } else {
            return "Expected Output : No it isn't a palindrome.";
        }
    }

    echo isPalindrome($example);
?>


<?php

    echo "<br><br><br>Q8<br><br>";

    $example = [1, 2, 5, 4, 4, 8];
    $hashMap = [];
    for ($i = 0 ; $i < count($example) ; $i++) {
        if (!in_array($example[$i], $hashMap)) {
            $hashMap[] = $example[$i];
        }
    }
    echo "$"."array1 = ". "(" . implode(", ", $hashMap) . ");" ;


?>
