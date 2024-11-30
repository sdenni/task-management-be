<?php
function timeConversion($s) {
    
    // init variable
    $amPm = substr($s, -2);
    $hour = substr($s, 0, 2);
    $minuteSecond = substr($s, 2, 6);  // MM:SS
    
    // konversi
    if ($amPm == 'AM') {
        if ($hour == '12') {
            $hour = '00';  
        }
    } else {  // PM case
        if ($hour != '12') {
            $hour = strval(intval($hour) + 12); 
        }
    }
    
    // print
    return $hour . $minuteSecond;
}

echo timeConversion('12:01:00PM');
echo "\n";
echo timeConversion('12:01:00AM');
echo "\n";
echo timeConversion('10:12:30AM');
?>
