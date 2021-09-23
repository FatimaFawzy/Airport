<link rel="stylesheet" href="css/dash.css">
<?php
 include 'connect.php';
if(isset($_POST['remove']))
{
$id=$_POST['id'];
try{
    $sql=$con->prepare("DELETE FROM airplane WHERE id=?");
    $sql->execute(array($id));
     echo "<div class='delet'>
    <h2> Flight Deleted Succefuly </h2>
  <a href='dashboard.php' class='add'>OK
  </a>
 </div>";
}
catch(PDOException $e)
{
 $msg= $e->getMessage();
  echo $msg;
     
}
}
if(isset($_POST['clear']))
{
    try{
 $sql = $con->exec("TRUNCATE  TABLE airplane"); 
   echo "<div class='delet'>
    <h2>Table Cleared Succefuly </h2>
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