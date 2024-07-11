<?php

    echo "Q1<br><br>";

    $colors = ["red", "green", "white"];

    echo "The memory of that scene for me is like a frame of film forever frozen at that moment: the " . $colors[0] .
" carpet, the " . $colors[1] ." lawn, the ". $colors[2] . " house, the leaden sky. The new president and his first lady. -
Richard M. Nixon"

?>

<?php

    echo "<br><br><br>Q2<br><br>";

    $colors = ['green', 'red', 'white'];

    echo "<ul></ul>";
    echo "<li>". $colors[0]  ."</li>";
    echo "<li>". $colors[1]  ."</li>";
    echo "<li>". $colors[2]  ."</li>";

?>

<?php

    echo "<br><br><br>Q3<br><br>";

    $cities = array( "Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=> "Brussels",
    "Denmark"=>"Copenhagen", "Finland"=>"Helsinki", "France" => "Paris",
    "Slovakia"=>"Bratislava", "Slovenia"=>"Ljubljana", "Germany" => "Berlin", "Greece" =>
    "Athens", "Ireland"=>"Dublin", "Netherlands"=>"Amsterdam", "Portugal"=>"Lisbon",
    "Spain"=>"Madrid" );

    asort($cities);
    $counter = 0;

    foreach ($cities as $country => $capital) {
        echo "The capital of " . $country . " is " . $capital . "<br>";
        $counter++;

        if ($counter == 3) {
            break;
        }
    }
    
?>

<?php

    echo "<br><br><br>Q4<br><br>";

    $color = array (4 => 'white', 6 => 'green', 11=> 'red');

    $firstElement = reset($color);

    echo $firstElement;
    
?>

<?php

    echo "<br><br><br>Q5<br><br>";

    $array = [1, 2, 3, 4, 5];

    $location = 4;

    $newItem = "$";

    array_splice($array, $location, 0, $newItem);

    echo implode(", ", $array);
    
?>

<?php 

    echo "<br><br><br>Q6<br><br>";

    $fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");

    asort($fruits);

    foreach($fruits as $letter => $fruit) {
        echo $letter . " = " . $fruit . "<br>";
    }

?>

<?php

    echo "<br><br><br>Q7<br><br>";

    $sampleInput = array(78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62,
    65, 64, 68, 73, 75, 79, 73);
    $total = 0;

    for ($i = 0 ; $i < count($sampleInput) ; $i++) {
        $total += $sampleInput[$i];
        $avg = $total / count($sampleInput);
    }

    sort($sampleInput);
    
    echo "Average Temperature is: " . $avg . "<br>";
    echo "List of seven lowest temperatures: ";
    for ($i = 0 ; $i < 7 ; $i++) {
        echo $sampleInput[$i] . "," ;
    }
    echo "<br>";

    rsort($sampleInput);
    echo "List of seven lowest temperatures: ";
    for ($i = 0 ; $i < 7 ; $i++) {
        echo $sampleInput[$i] . "," ;
    }

?>

<?php 

    echo "<br><br><br>Q8<br><br>";

    $array1 = array("color" => "red" , 2, 4);
    $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4); 

    $combinedArray = array_merge($array1, $array2);


    print_r($array1);
    echo "<br>";
    print_r($array2);
    echo "<br>";
    print_r($combinedArray);

?>

<?php

    echo "<br><br><br>Q9<br><br>";

    $array = array("red","blue", "white","yellow");

    echo "Array <br> ( <br>";
    for ($i = 0 ; $i < count($array) ; $i++) {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . strtoupper($array[$i]) . "<br>";
    }
    echo ")";

?>

<?php

    echo "<br><br><br>Q10<br><br>";

    $array = array("RED","BLUE", "WHITE","YELLOW");   
    
    echo "Array <br> ( <br>";
    for ($i = 0 ; $i < count($array) ; $i++) {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . strtolower($array[$i]) . "<br>";
    }
    echo ")";

?>

<?php

    echo "<br><br><br>Q11<br><br>";

    echo "Expected output: ";

    for ($i = 200 ; $i <= 250 ; $i++) {
        if ($i % 4 == 0) {
            echo $i . ", ";
        }
    }

?>

<?php

    echo "<br><br><br>Q12<br><br>";

    $words = array("abcd","abc","de","hajj","g","wer");
    $longestWord = $words[0];
    $shortestWord = $words[0];

    for ($i = 0 ; $i < count($words) ; $i++) {
        if (strlen($words[$i]) > strlen($longestWord)) {
            $longestWord = $words[$i];
        }
        if (strlen($words[$i]) < strlen($shortestWord)) {
            $shortestWord = $words[$i];
        }
    }

    echo "The shortest array length is : " . $shortestWord . ". The longest array length is : " . $longestWord . ".";

?>

<?php

    echo "<br><br><br>Q13<br><br>";

    $input = array(4, 20);

    $minRange = $input[0];
    $maxRange = $input[1];

    echo "Numbers : (" . $minRange . ", " . $maxRange . ") <br>"; 
    echo "Expected output : ";
    for ($i = 0 ; $i < 8 ; $i++) {
        $randomNum = rand($input[0], $input[1]);
        echo $randomNum . ", ";
    }
    echo $randomNum;

?>

<?php

    echo "<br><br><br>Q14<br><br>";

    $array = array(1, 5, 3, 8, 10, 0);  
    $smallest = $array[0];

    for ($i = 0 ; $i < count($array) ; $i++) {
        if ($array[$i] > 0) {
            if ($array[$i] < $smallest) {
                $smallest = $array[$i];
            }
        }
    }

    echo "Example input : ";
    echo print_r($array) . "<br>";
    echo "Output : " . $smallest;

?>

<?php

    echo "<br><br><br>Q15<br><br>";

    function bubbleSort($array) {
        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }
        return $array;
    }

    $inputArray = array(5, 3, 1, 3, 8, 7, 4, 1, 1, 3);

    $sortedArray = bubbleSort($inputArray);

    echo "Input Array: ";
    print_r($inputArray);
    echo "<br>";
    echo "Sorted Array: ";
    print_r($sortedArray);

?>


<?php

    echo "<br><br><br>Q16<br><br>";

    $number = 1.145;
    $precision = 2;
    $separator = ".";

    function floorDecimal($number, $precision, $separator) {
        $formattedNum = number_format($number, $precision, $separator);
        return $formattedNum;
    }

    echo "Example Number : " .  $number . "<br>";
    echo "Amount of decimal points : " . $precision . "<br>";
    echo "Type of separator : " . $separator . "<br>";
    echo floorDecimal($number, $precision, $separator);

?>

<?php

    echo "<br><br><br>Q17<br><br>";

    $list1 = "4, 5, 6, 7";
    $list2 = "4, 5, 7, 8";
    $list1Array = explode(", ", $list1);
    $list2Array = explode(", ", $list2);

    $uniqueList = [];

    for ($i = 0; $i < count($list1Array) ; $i++) {
        if (!in_array($list1Array[$i], $uniqueList)) {
            $uniqueList[] = $list1Array[$i];
        }
    }

    for ($i = 0; $i < count($list2Array) ; $i++) {
        if (!in_array($list2Array[$i], $uniqueList)) {
            $uniqueList[] = $list2Array[$i];
        }
    }

    echo "List 1 : " . $list1 . "<br>";
    echo "List 2 : " . $list2 . "<br>";
    echo "The unique list : " . implode(", ", $uniqueList);
?>

<?php

    echo "<br><br><br>Q18<br><br>";

    $inputArray = [4, 5, 6, 7, 4, 7, 8];

    function removeDuplicates($array) {
        $uniqueArray = [];
        for ($i =0 ; $i < count($array) ; $i++) {
            if (!in_array($array[$i], $uniqueArray)) {
                $uniqueArray[] = $array[$i];
            }
        }
        return $uniqueArray;
    }

    echo "Input array : " . implode(", ", $inputArray) . "<br>";
    echo "The unique list : " . implode(", ", removeDuplicates($inputArray));

?>

<?php

    echo "<br><br><br>Q19<br><br>";

    $array1 = ["a", 1, 2, 3, 4];
    $array2 = ["a", 3];
    echo "First array : " . implode(", ", $array1) . "<br>";
    echo "Second array : " . implode(", ", $array2) . "<br>";
    echo array_diff($array2, $array1) ? "Array 2 isn't subset of Array 1" : "Array 2 is subset of Array 1";

?>