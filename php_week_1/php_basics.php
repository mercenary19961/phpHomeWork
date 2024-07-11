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

<?php

    echo "<br><br><br>Q8<br><br>";
    $example8 = "That new trainee is such a genius";
    $outPut8 = str_replace("That", "Our", $example8);
    echo "Example input : " . $example8 . "<br>";
    echo "Example output : " . $outPut8;

?>

<?php

    echo "<br><br><br>Q9<br><br>";
    $example9A = "dragonball";
    $example9B = "dragonboll";

    $example9ALength = strlen($example9A);
    $example9BLength = strlen($example9B);

    $aCharacter = null;
    $bCharacter = null;
    $index9 = 0;


    $minLength = min($example9ALength, $example9BLength);

    for ($i = 0; $i < $minLength; $i++) {
        if ($example9A[$i] !== $example9B[$i]) {
            $aCharacter = $example9A[$i];
            $bCharacter = $example9B[$i];
            $index9 = $i;
            break;
        }
    }

    echo "String 1: " . $example9A . "<br>";
    echo "String 2: " . $example9B . "<br>";
    echo "Expected result: First difference between two strings at position " . $index9 . ": " . "\"$aCharacter\"" . " vs " . "\"$bCharacter\"";

?>

<?php

    echo "<br><br><br>Q10<br><br>";
    $example10 = "Twinkle, twinkle, little star";
    $arrayExample = explode(",", $example10);

    echo "Example input : " . $example10 . "<br>" ; 
    echo "Example output : ";
    var_dump($arrayExample);
?>

<?php

    echo "<br><br><br>Q11<br><br>";
    
    $example11A = "s";
    $example11B = "z";


    function nextLetter($input) {
        $input = strtolower($input);
        $lettersList = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
        for ($i = 0 ; $i <= sizeof($lettersList) ; $i++) {
            if ($input == "z") {
                return $lettersList[0] ;
            }
            elseif ($lettersList[$i] == $input) {
                return $lettersList[$i + 1] ;
            }
        }
        return "Please Enter A single alphabetic letter";
    }

    echo "Example input : \"s\" <br> ";
    echo "Example output : " . nextLetter($example11A) . "<br>";
    echo "Example input : \"z\" <br> ";
    echo "Example output : " . nextLetter($example11B) . "<br>";
    
?>


<?php

    echo "<br><br><br>Q12<br><br>";

    $example12 = "The brown fox";
    $exWord1 = "The";
    $exWord2 = "brown";
    $chosenWord = "quick";


    function insertingAText($word1, $word2, $sentence, $insertedWord) {

        if (strpos($sentence, $word1) !== false && strpos($sentence, $word2) !== false) {

            $arraySentence = explode(" ", $sentence);
            $index1 = array_search($word1, $arraySentence);
            $index2 = array_search($word2, $arraySentence);

            if ($index1 < $index2) {
                $arraySentence = array_merge(
                    array_slice($arraySentence, 0, $index2),
                    [$insertedWord],
                    array_slice($arraySentence, $index2)
                );
                $updatedSentence = implode(" ", $arraySentence);
                return $updatedSentence;
            } else {
                return "Error, '$word1' does not appear before '$word2' .";
            }
        } else {
            return "Please choose correct words that's from the sentence";
        }
    }


    echo "Current sentence : " . $example12 . "<br>";
    echo "You want to insert \"quick\" between \"The\" and \"brown\" ." . "<br>";
    echo "Expected output : ";
    echo insertingAText($exWord1, $exWord2, $example12, $chosenWord);

?>

<?php

    echo "<br><br><br>Q13<br><br>";

    $example13 = "00000054841";

    function removeInitialZeroes($string) {
        $numberArray = str_split($string);
        $index13 = 0;
        while ($index13 < count($numberArray) && $numberArray[$index13] === '0') {
            $index13++;
        };
        $slicedArray =  array_slice($numberArray, $index13);
        $resultString = implode('', $slicedArray);
        return $resultString;
    }

    echo "This is the example : " . $example13 . "<br>";
    echo "This is the output : ";
    echo removeInitialZeroes($example13);
?>

?>


<?php

    echo "<br><br><br>Q14<br><br>";

    $example14 = "The quick brown fox jumps over the lazy dog";
    $chosenWord14 = "quick";


    function removingAText($sentence, $chosenWord) {

        if (strpos($sentence, $chosenWord) !== false) {

            $updatedSentence14 = str_replace($chosenWord, "", $sentence);
            return $updatedSentence14;
        } else {
            return "Please choose correct words that's from the sentence";
        }
    }


    echo "Current sentence : " . $example14 . "<br>";
    echo "You want to remove \"quick\"" . "<br>";
    echo "Expected output : ";
    echo removingAText($example14, $chosenWord14);

?>

<?php 

    echo "Q15<br><br>"; 

    $exampleString15 = "The quick brown fox jumps - over the lazy dog---";

    $updatedString15 = str_replace("-", "", $exampleString15);

    echo "Original string: " . $exampleString15 . "<br>";
    echo "Updated string: " . $updatedString15 . "<br>";
?>

<?php 

    echo "<br><br><br>Q16<br><br>"; 

    $exampleString16 = '\"\1+2/3*2:2-3/4*3';

    $updatedString16 = preg_replace('/[^a-zA-Z0-9\s]/', ' ', $exampleString16);

    echo "Original string: " . $exampleString16 . "<br>";
    echo "Updated string: " . $updatedString16 . "<br>";
?>

<?php 

    echo "<br><br><br>Q17<br><br>"; 

    $exampleString17 = "The quick brown fox jumps over the lazy dog";

    $arrayExample17 =   explode(" ", $exampleString17);

    $chosenWords17 = array_slice($arrayExample17, 0, 5);

    $updatedString17 = implode(" ", $chosenWords17);

    echo "Original string: " . $exampleString17 . "<br>";
    echo "Updated string: " . $updatedString17 . "<br>";
?>

<?php

    echo "<br><br><br>Q18<br><br>"; 

    $exampleString18 = "2,543.12";

    $updatedString18 = str_replace(",", "", $exampleString18);

    echo "Original string: " . $exampleString18 . "<br>";
    echo "Updated string: " . $updatedString18 . "<br>";
?>

<?php

    echo "<br><br><br>Q19<br><br>"; 

    $example19 = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z";

    $updatedString19 = str_replace(",", " ", $example19);

    echo "Updated string: " . $updatedString19 . "<br>";
?>







