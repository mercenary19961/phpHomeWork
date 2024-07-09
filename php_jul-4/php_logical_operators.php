<?php

    echo "Q1<br><br>";

    $example1 = 2024;

    function isItLeapYear($year) {
        if ($year % 4 == 0) {
            if ($year % 100 == 0) {
                if ($year % 400 == 0 ) {
                    echo "It's a leap year!";
                } else {
                    echo "It's not a leap year!";
                }
            } else {
                echo "It's a leap year!";
            }
        } else {
            echo "It's not a leap year";
        }
    }

    echo    "Current input : " . $example1 . "<br>";
    echo    "Expected output :  "  ; 
    echo    isItLeapYear($example1);

?>

<?php

    echo "<br><br><br>Q2<br><br>";
    $example2 = 27;

    function FunctionName($temp) {
        if ($temp <= 20) {
            echo "We are in winter!";
        } else {
            echo "It's summer time!";
        }
    }

    echo    "Current input : " . $example2 . "<br>";
    echo    "Expected output :  "  ; 
    echo    FunctionName($example2);
?>

<?php

    echo "<br><br><br>Q3<br><br>";
    $example3 = [2, 2];
    $exampleString3 = implode(",",$example3);

    function calculateSum($array) {
        if ($array[0] === $array[1]) {
            $sum = ($array[0] + $array[1]) * 3 ;
            return $sum ;
        } else {
            return $sum = $array[0] + $array[1] ;
        }
    }

    echo    "Current input : " . $exampleString3 . "<br>";
    echo    "Expected output :  "  ; 
    echo    calculateSum($example3);
    
?>

<?php

    echo "<br><br><br>Q4<br><br>";
    $example4 = [14, 15];
    $exampleString4 = implode(",",$example4);

    function isSumEquals30($array) {
        if ($array[0] + $array[1] == 30) {
            return $sum = $array[0] + $array[1];
        } else {
            return "False" ;
        }
    }

    echo    "Current input : " . $exampleString4 . "<br>";
    echo    "Expected output :  "  ; 
    echo    isSumEquals30($example4);
    
?>

<?php

    echo "<br><br><br>Q5<br><br>";
    $example5 = 0;

    function isMultiplyOf3($num) {
        if ($num > 0) {
            if ($num % 3 == 0 ) {
                return "True";
            } else {
                return "False";
            }
        } else {
            return "Please enter a number higher than 0" ;
        }
    }

    echo    "Current input : " . $example5 . "<br>";
    echo    "Expected output :  "  ; 
    echo    isMultiplyOf3($example5);
    
?>

<?php 

    echo "<br><br><br>Q6<br><br>";
    $example6 = 30;

    function isNumberBetweenRange($num) {
        if ($num >= 20 && $num <= 50 ) {
            return "True";
        } else {
            return "False";
        }
        
    }

    echo    "Current input : " . $example6 . "<br>";
    echo    "Expected output :  "  ; 
    echo    isNumberBetweenRange($example6);

?>

<?php 

    echo "<br><br><br>Q7<br><br>";

    $example7 = [2, 14, 15];
    $exampleString7 = implode(",",$example7);

    function biggestNum($array) {
        $biggest = $array[0];
        for ($i = 0 ; $i < count($array) ; $i++) {
            if ($array[$i] > $biggest) {
                $biggest = $array[$i];
            }
        }
        return $biggest;
    }

    echo    "Current input : " . $exampleString7 . "<br>";
    echo    "Expected output :  "  ; 
    echo    biggestNum($example7);
    
?>

<?php 

    echo "<br><br><br>Q8<br><br>";

    $example8 = 250;

    function calculateUsage($usage) {
        $total = 0;
        if ($usage <= 0) {
            return "Please Enter Valid Number";
        }
        elseif ($usage > 0 && $usage <= 50) {
            $total = $usage * 2.5;
            return $total;
        }
        elseif ($usage > 50 && $usage <= 150) {
            $firstAmount = 125;
            $total = (($usage - 50) * 5) + $firstAmount;
            return $total;
        }
        elseif ($usage > 150 && $usage <= 250) {
            $firstAmount = 125;
            $secondAmount = 500;
            $total = (($usage - 150) * 6.2) + $firstAmount + $secondAmount;
            return $total;
        }
        else {
            $firstAmount = 125;
            $secondAmount = 500;
            $thirdAmount = 620;
            $total = (($usage - 250) * 7.5) + $firstAmount + $secondAmount + $thirdAmount;
            return $total;
        }
    }

    echo    "Current input : " . $example8 . "<br>";
    echo    "Expected output :  "  ; 
    echo    calculateUsage($example8);

?>

<?php 

    echo "<br><br><br>Q9<br><br>";

    $operation = "/";
    $firstNum = 4;
    $secondNum = 2;


    function addition($num1, $num2) {
        $total = $num1 + $num2;
        return $total;
    }

    function subtraction($num1, $num2) {
        $total = $num1 - $num2;
        return $total;
    }

    function multiplication($num1, $num2) {
        $total = $num1 * $num2;
        return $total;
    }

    function division($num1, $num2) {
        if ($num2 != 0) {
            $total = $num1 / $num2;
            return $total;
        } else {
            return "Cant divide on zero";
        }

    }

    function calculator($num1, $num2, $operation) {
        if ($operation == "+") {
            return addition($num1, $num2);
        }
        elseif ($operation == "-") {
            return subtraction($num1, $num2);
        }
        elseif ($operation == "*") {
            return multiplication($num1, $num2);
        }
        elseif ($operation == "/") {
            return division($num1, $num2);
        }
    }

    echo    "First number : " . $firstNum . "<br>";
    echo    "Second number : " . $secondNum . "<br>";
    echo    "Current operation : " . $operation . "<br>";
    echo    "Expected output :  "  ; 
    echo    calculator($firstNum, $secondNum, $operation);

?>

<?php

    echo "<br><br><br>Q10<br><br>";

    $example10 = 18;

    function isEligible($age) {
        if ($age <= 0 &&  $age > 80) {
            return "Please enter a valid age";
        }
        elseif ($age >= 18 ) {
            return "You are eligible to vote!";
        } else {
            return "You are not eligible to vote!";
        }
    }

    echo    "Current age : " . $example10 . "<br>";
    echo    "Expected output :  "  ; 
    echo    isEligible($example10);

?>

<?php 

    echo "<br><br><br>Q11<br><br>";

    $example11 = 0;

    function isPositive($num) {
        if ($num == 0 ) {
            return "Zero";
        }
        elseif ($num > 0) {
            return "Positive";
        } else {
            return "Negative";
        }
    }

    echo    "Current number : " . $example11 . "<br>";
    echo    "Expected output :  "  ; 
    echo    isPositive($example11);

?>

<?php

    echo "<br><br><br>Q12<br><br>";

    $exampleGrades = [60,86,95,63,55,74,79,62,50];
    $stringGrades = implode(",", $exampleGrades);

    function averageGrades($array) {
        $sum = 0;
        for ($i = 0; $i < count($array); $i++) {
            $sum += $array[$i];
        }
        $average = $sum / count($array) ;
        
        if ($average >= 84) {
            return "A";
        }
        elseif ($average < 84 && $average >= 76) {
            return "B";
        }
        elseif ($average < 76 && $average >= 68) {
            return "C";
        } 
        elseif ($average < 68 && $average >= 60) {
            return "D";
        }
        elseif ($average < 60 && $average >= 50) {
            return "E";
        } else {
            return "F";
        }
    }
    


    echo    "Current Grades : " . $stringGrades . "<br>";
    echo    "Expected output :  "  ; 
    echo    averageGrades($exampleGrades);
?>