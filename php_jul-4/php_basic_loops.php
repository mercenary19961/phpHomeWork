<?php

    echo "Q1<br><br>";

    for ($i = 1; $i < 10 ; $i++) {
        echo $i . "-";
    };
    echo $i;

?>

<?php

    echo "<br><br><br>Q2<br><br>";

    $sum2 = 0;
    for ($i = 0; $i < 31 ; $i++) {
        $sum2 += $i ;
    }
    echo $sum2;
?>

<?php

    echo "<br><br><br>Q3<br><br>";
    $rows = 5;
    $characters = ["A", "B", "C", "D", "E"];

    for ($i = 0 ; $i < $rows ; $i++ ) {
        for ($j = 0; $j < $rows ; $j++ ) {
            if ($j < $rows - $i - 1) {
                echo "A ";
            } else {
                echo $characters[$i] . " ";
            }
        }
        echo "<br>";
    }

?>

<?php

    echo "<br><br><br>Q4<br><br>";

    $rows = 5;
    $characters = [1, 2, 3, 4, 5];

    for ($i = 0 ; $i < $rows ; $i++ ) {
        for ($j = 0; $j < $rows ; $j++ ) {
            if ($j < $rows - $i - 1) {
                echo $characters[0] . " ";
            } else {
                echo $characters[$i] . " ";
            }
        }
        echo "<br>";
    }

?>

<?php 

    echo "<br><br><br>Q5<br><br>";

    $rows = 5;
    $characters = [1, 2, 3, 4, 5];

    for ($i = 0 ; $i < $rows ; $i++ ) {
        for ($j = 0; $j < $rows ; $j++ ) {
            if ($j == $i) {
                echo $characters[$i] . " ";
            } else {
                echo "0" . " ";
            }
        }
        echo "<br>";
    }

?>

<?php 

    echo "<br><br><br>Q6<br><br>";

    $example = 5;
    $factorial = 1;

    for ($i = 1 ; $i <= $example ; $i++) {
        $factorial *= $i;
    }
    echo $factorial;

?>

<?php

    echo "<br><br><br>Q7<br><br>";

    $example = 10;
    $previous = 0;
    $previous2 = 1;
    echo $previous . " ";
    echo $previous2 . " ";

    for ($i = 0 ; $i <= $example ; $i++) {
        $fibonacci = $previous + $previous2;
        echo $fibonacci . " ";
        $previous = $previous2;
        $previous2 = $fibonacci;
    }

?>

<?php

    echo "<br><br><br>Q8<br><br>";    

    $example = "Orange Coding Academy";
    $toLower = strtolower($example);
    $count = 0;

    $array = str_split($toLower);
    for ($i = 0 ; $i < count($array) ; $i++) {
        if ($array[$i] == "c") {
            $count++;
        }
    }

    echo $count;
    
?>

<?php

    echo "<br><br><br>Q9<br><br>"; 

    echo '<table border="1" cellpadding="3" cellspacing="0">';

    for ($i = 1; $i <=6; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= 5; $j++) {
            $sum = $i * $j;
            echo "<td style='padding-right: 80px'>" . $i . " * " . $j . " = " . $sum . "</td>";
        }
        echo "</tr>";
    }

    echo '</table>';
?>

<?php

    echo "<br><br><br>Q10<br><br>"; 

    for ($i = 1 ; $i <= 50 ; $i++) {
        if (($i % 3 == 0) && ($i % 5 == 0)) {
            echo "FizzBuzz" . " ";
        }
        elseif ($i % 3 == 0) {
            echo "Fizz" . " ";
        }
        elseif ($i % 5 == 0) {
            echo "Buzz" . " ";
        } else {
            echo $i . " ";
        }
    }

?>

<?php 

    echo "<br><br><br>Q11<br><br>";     
    $num = 6;
    $printNum = 1;

    for ($i = 1 ; $i < $num ; $i++) {
        for ($j = 1 ; $j < $num ; $j++) {
            if ($j <= $i) {
                echo $printNum;
                $printNum++;
            } else {
                echo " " ;
            }
        }
        echo "<br>";
    }
    
?>

<?php 

    echo "<br><br><br>Q12<br><br>";     
    

    $letters = range('A', 'E'); 
    $maxRows = 5; 

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A&nbsp;A <br>";
    for ($i = 2; $i <= $maxRows; $i++) {

        for ($j = $maxRows - $i; $j > 0; $j--) {
            echo "&nbsp;&nbsp;&nbsp;&nbsp;"; 
        }

        for ($j = 0; $j < $i; $j++) {
            echo $letters[$j] . "&nbsp;&nbsp;&nbsp;&nbsp;"; 
        }
        echo "<br>";
    }

    for ($i = $maxRows - 1; $i > 1; $i--) {
        
        for ($j = $maxRows - $i; $j > 0; $j--) {
            echo "&nbsp;&nbsp;&nbsp;&nbsp;"; 
        }
        
        for ($j = 0; $j < $i; $j++) {
            echo $letters[$j] . "&nbsp;&nbsp;&nbsp;&nbsp;"; 
        }
        echo "<br>";
    }
        
?>