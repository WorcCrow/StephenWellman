<?php

function echo_datelist ($i, $j, $day, $month, $year)
{
    $time = str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT);            
    $date = strtotime("$month $day $year $time:00");
   
    echo $time.'<br />';
}
for ($i = 0; $i <= 24; $i++){
  for ($j = 0; $j <= 45; $j+=15){
    //inside the inner loop
    echo_datelist($i, $j, $day, $month, $year);
  }
  //inside the outer loop
}
//outside the outer loop
echo_datelist(24, 0, $day, $month, $year);
?>