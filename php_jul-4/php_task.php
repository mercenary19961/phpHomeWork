<?php
    echo "Q1<br><br>";
    $str1 = "show cAse";
    echo strtoupper("$str1"). "<br>";
    echo strtolower("$str1"). "<br>";
    echo ucfirst("$str1"). "<br>";
    echo ucwords("$str1");
?>

<?php
    echo "<br><br><br>Q2<br><br>";
    
    function formatNumberToTime($number) {
        $format = 'His'; 
        $time = DateTime::createFromFormat($format, $number);
        return $time->format('H:i:s');
    }
    
    $number = "085119";
    $formattedTime = formatNumberToTime($number);
    
    echo "Input Time: " . $number . "<br>";
    echo "Formatted Time: " . $formattedTime;

?>

<?php

    echo "<br><br><br>Q3<br><br>";
    $example3 = "I am a student at orange coding academy.";
    $selectedWord = "orange";
    echo "Example sentence : ". "$example3". "<br>";
    echo "Example word : ". "$selectedWord". "<br><br>";

    if (stripos("$example3","$selectedWord") !==false) {

        echo "Result : Word Found!";
    } else {
        echo "Result : Word Not Found!<br><br>";
    };

?>

<?php

    echo "<br><br><br>Q4<br><br>";
    $example4 = "www.orange.com/index.php";
    $slicePoint4 = "/";
    $targetIndex4 = strpos($example4, $slicePoint4);
    $targetStr4 = substr($example4, $targetIndex4 + 1);
    echo "This is the example sentence : " . $example4 ."<br>";
    echo "This is the slicer point : " . $slicePoint4 ."<br>";
    echo "This is the wanted text : " . $targetStr4;

?>

<?php

    echo "<br><br><br>Q5<br><br>";
    $example5 = "info@orange.com";
    $slicePoint5 = "@";
    $targetIndex5 = strpos($example5, $slicePoint5);
    $targetStr5 = substr($example5, 0 , $targetIndex5);
    echo "This is the example sentence : " . $example5 ."<br>";
    echo "This is the slicer point : " . $slicePoint5 ."<br>";
    echo "This is the wanted text : " . $targetStr5;

?>

<?php

    echo "<br><br><br>Q6<br><br>";
    $example6 = "info@orange.com";
    $targetStr6 = substr($example6, -3);
    echo "This is the example sentence : " . $example6 ."<br>";
    echo "This is the wanted text : " . $targetStr6;

?>

<?php

    echo "<br><br><br>Q7<br><br>";
    $example7 = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $stringStart7 = rand(0, strlen($example7) - 1);
    $stringEnd7 = rand($stringStart7, strlen($example7));
    $length7 = $stringEnd7 - $stringStart7;
    $targetStr7 = substr($example7, $stringStart7, $length7);
    echo "This is the example sentence : " . $example7 ."<br>";
    echo "This is the wanted text : " . $targetStr7;

?>


