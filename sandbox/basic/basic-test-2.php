<?php
function plusMinus($arr) {
    // init variable
    $positiveCount = 0;
    $negativeCount = 0;
    $zeroCount = 0;
    $n = count($arr);  // count array
    
    // loop for cek digit positive, zero or negative
    foreach ($arr as $num) {
        if ($num > 0) {
            $positiveCount++;
        } elseif ($num < 0) {
            $negativeCount++;
        } else {
            $zeroCount++;
        }
    }
    
    // kalkulasi ratios
    $positiveRatio = $positiveCount / $n;
    $negativeRatio = $negativeCount / $n;
    $zeroRatio = $zeroCount / $n;
    
    // print dengan ketepata dibelakang koma 6 angka.
    printf("%.6f\n", $positiveRatio);
    printf("%.6f\n", $negativeRatio);
    printf("%.6f\n", $zeroRatio);
}

// $arr = [1, 1, 0, -1, -1];
$arr = [-4, 3, -9, 0, 4, 1];
// $arr = [2, 1, 1, 0, -1, -1, -9];
plusMinus($arr);
