<?php

include "../vars.php";

//set the mysql row returned to $data
$data=$submission;
$data = strtolower($data);

$spam = "false";

//break up words into arra
$word_array = str_word_count($data, 1, 'àáãç3');

//regex for differnet purposes
$alnum_data = preg_replace("/[^a-zA-Z^\s]/", ' ', $data); //produces Alphabet chars with no spaces
$data= preg_replace("([^a-zA-Z]|^\s)", '', $data); 
$dict = "/var/www/blackhole/functions/english.dic"; //sets location of dictionary file

// Open the dictionaryfile
$fp = @fopen($dict, 'r');

// Add each line to an array
if ($fp) {
   $dict_words = explode("\n", fread($fp, filesize($dict)));
}

//calculates the intersection between dictionary words and input string
$intersect = array_intersect($word_array,$dict_words);

//intersection array size
$size_intersection = sizeof($intersect); //#words in $intersect
$size_input = sizeof($word_array); //#of words in original string
$word_score = $size_input - $size_intersection;//$word spam score is set to the # of non dictionary words

//check against vulgarity
$vulgarity_score=0;//defaults vulgarity score to 0
$intersect2 = array_intersect($vulgarity,$word_array);//intersection of $vulgarity & word array
$vulgar = array_count_values($word_array); //Counts occurances of each word in word array

//calculate occurances of vulgarity
if(sizeof($vulgar) > 0){
        foreach ($intersect2 as $i => $val){//loops through each entry in intersect (swear words)
                $vulgarity_score = $vulgar[$intersect2[$i]] + $vulgarity_score; //pulls out the count of that swear from $vulgar + iterates the counter
        }
}

//define some arrays
$chars=array();
$calc=array();

//calc string length
$len = strlen($data);
$char_score = 0 ;

//checks to see if letter distributions match up.
foreach (count_chars($data, 1) as $i => $val) {
        $chars[chr($i)]=$val;//array of character counts
        $calc[chr($i)]=$val/$len*100;//array of percentages of those character occurances
        $calc[chr($i)];
        $cal=$calc[chr($i)];//sets $cal equal to the curret character % in the foreach
        $p = $var_percent[chr($i)]; //sets $p == to the current letters %threashold


        //loop through chars to check if they are witin 40%
        if($cal >= $p){
                $char_score = $char_score+1;
        }
}

//adds all spam scores together
$spam_score = $word_score + $char_score + $vulgarity_score;

//check spam score from spam_func.php
//spam or not changes based on word length vs. spam score.
        if($size_input == 0){
                $spam = true;
        }
        elseif($vulgarity_score >= $size_input){
                $spam = true;//if the string is only vulgarity consider it spam
        }
        elseif($size_input == 1 && $spam_score >= 3){
                $spam = true;
        }
        elseif($size_input >1 && $size_input <= 4 && $spam_score >= 6){
                $spam = true;
        }
        elseif($size_input >4 && $size_input <=6 && $spam_score >= 9){
                $spam = true;
        }
        elseif($spam_score > 12){
                $spam = true;
        }
        else{
                $spam = false; //if it doesnt meet the conditions mark as not spam.
        }

?>
