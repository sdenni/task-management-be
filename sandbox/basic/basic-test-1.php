<?php
function miniMaxSum($arr) {
    // sorting array
    sort($arr);
    
    // init variable
    $minSum = 0;
    $maxSum = 0;
    
    //get min
    for ($i = 0; $i < 4; $i++) {
        $minSum += $arr[$i];
    }
    
    //get max
    for ($i = 1; $i < 5; $i++) {
        $maxSum += $arr[$i];
    }
    
    // Print hasil
    echo $minSum . " " . $maxSum . "\n";
}

// $arr = [1, 3, 5, 7, 9];
$arr = [9, 7, 5, 3, 1];
miniMaxSum($arr);  
?>
