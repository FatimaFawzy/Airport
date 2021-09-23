<?php include 'connect.php';?>
<?php include 'header.php';?>
<?php include 'function.php';?>
<link rel="stylesheet" href="css/dash.css">
<div class="container">  
<div class="row">
<div class="col-md-8 add-f ">
<h1> Add Flight</h1>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="add-form">

<input type="text" class="form-control" name="flight_number" placeholder="Write Flight Number"required>

<input type="text" class="form-control" name="flight_from" placeholder="Where the flight took off" required>

<input type="text" name="flight_to" class="form-control"placeholder=" Write Flight Destination"required>

<input type="time" class="form-control" name="flight_time"required >

<input type="date" class="form-control"  name="flight_date"required>
<div >
<input type="submit" name="add" value="Add Flight" class="add">
</div>
</form>
</div>
<div class="col-md-3 show"> 
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary show-f" data-bs-toggle="modal" data-bs-target="#flightModal">
 Show All flights
</button>

<!-- Modal -->
<div class="modal fade" id="flightModal" tabindex="-1" aria-labelledby="flightModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="flightModalLabel">All Flights</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <?php
          

          $sql=$con->prepare("SELECT * FROM airplane  ");
          $sql->execute(array());
          $count=$sql->rowcount();
           $results=$sql->fetchAll();
           if($count > 0)
           {

          ?>
        
       <table class="table">
  <thead>
    <tr>
      <th scope="col">Flight </th>
      <th scope="col">From</th>
      <th scope="col">Destination</th>
      <th scope="col">Schedual</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
      <th></th>
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
<td><?php echo $result['start_time'];?></td>
<td><?php echo $result['flight_date'];?></td>
<td><?php echo $status;?></td>
<td>
    <form action="delet.php" method="post">
     <input type="hidden" name="id" value="<?php echo $result['id'];?>">
     <input type="submit"  name="remove" value="Remove" class="remove">
    </form>
</td>
</tr>
<?php } ?>

 </tbody>
</table>
<?php 
} else{?>
     <div class="empty">
      <h2>No Flights Yet !</h2>
     </div>
<?php
 }

?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary add" data-bs-dismiss="modal">Close</button>
       <form action="delet.php" method="post">
           <input type="submit" name="clear" value="clear" class="add">
       </form>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>

<?php
 if(isset($_POST['add']))
 {
$flight_number=$_POST['flight_number'];
$flight_from=$_POST['flight_from'];
$flight_to=$_POST['flight_to'];
$flight_time=$_POST['flight_time'];
$flight_date=$_POST['flight_date'];
$flight_date= date('d-m-Y', strtotime($flight_date));
// convert time from 24hour to 12hour format 
 $flight_time= date('h:i', strtotime($flight_time));
//adding  flight data to database

try{
$sql="INSERT INTO airplane (flight_num,flight_to,flight_date,start_time,flight_from)
VALUES('$flight_number','$flight_to','$flight_date','$flight_time','$flight_from')";
 $sql=$con->exec($sql);
 echo "<div class='delet'>
    <h2>Flight Added Succefully </h2>
  <a href='dashboard.php'class='add'>OK
  </a>
 </div>";

}
catch(PDOException $e)
{
 $msg= $e->getMessage();
  echo $msg;
     
}
 }

?>
<?php include 'footer.php';?>
