<?php
$date=date('d-m-Y');
date_default_timezone_set('Asia/Baghdad');
$time=date('h:i');
          // FUNCTION - ADD HOURS and MINUTES
function AddingTime ($oldTime, $TimeToAdd) {
  $old=explode(":",$oldTime);
  $play=explode(":",$TimeToAdd);

  $hours=$old[0]+$play[0];
  $minutes=$old[1]+$play[1];


  if($minutes > 59){
    $minutes=$minutes-60;
    $hours++;
  }

  if($minutes < 10){
    $minutes = "0".$minutes;
  }
  if($hours > 12){
    $hours = $hours-12;
  }

  if($minutes == 0){
    $minutes = "00";
  }
  $sum=$hours.":".$minutes;
  return $sum;
}

?>