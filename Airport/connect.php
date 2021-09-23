<?php


$dsn='mysql:host=localhost;dbname=air-plane';//name of host and  database
$user='root';//name of database user
$pass='';//password of database user 
$option = array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

);
try{

  $con = new PDO($dsn ,$user,$pass,$option);
  $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
  echo 'faild'.$e->getmessage();
}



 ?>
 
