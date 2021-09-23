<?php include 'connect.php';?>
<?php include 'header.php';?>
<?php include 'function.php';?>
<link rel="stylesheet" href="css/index.css">

<?php
header( "refresh:60");//reload the page after one minute
$sql=$con->prepare("SELECT * FROM airplane WHERE flight_date=? ");
$sql->execute(array($date));
$count=$sql->rowcount();
$results=$sql->fetchAll();

?>
<div class="container">
<div class="row">

<div class="col-md-12">
<div class="info">

<img src="img/flight.jpg" width="55px" hieght="50px">
  <p >Flights</p>
<span><?php echo $date ." ".$time ?></span>
</div>
  <?php
   if($count > 0)
    {
   ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Flight</th>
      <th scope="col">Flight From</th>
      <th scope="col">Destination</th>
      <th scope="col">Schedual</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  <?php 
foreach($results as $result )
{  

 $start_time=$result['start_time'];
 $waiting_time="00:15";
 $end_time=AddingTime($start_time,$waiting_time);//geting time for leaving flight
 $time1 = strtotime($time); 
 $start_time1 = strtotime($start_time );
 $end_time1 = strtotime($end_time );
 
 

 if($time1 >= $start_time1 && $time1 <=  $end_time1 )
 {
   $status="<span class='on'>Boarding</span>";
  
 }
 else
 {
   $status="<span class='leaved'>Departed</span>";
 }
 if($time1 < $start_time1 )
 {
   $status="<span class='wait'>On Time</span>";
 }
?>
<tr>
<td><?php echo $result['flight_num'] ;?></td>
<td><?php echo $result['flight_from'] ;?></td>
<td><?php echo $result['flight_to'];?></td>
<td><?php echo $result['start_time']?></td>
<td><?php echo $status;?></td>
</tr>
<?php } ?>
 </tbody>
</table>
<?php 
} else{?>
     <div class="empty">
      <h2> No Flights Today .</h2>
     </div>
<?php
 }

?>
</div>
</div>
</div>

<?php include 'footer.php';?>
 