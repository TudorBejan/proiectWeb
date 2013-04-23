<?php
session_start();
if(!isset($_SESSION['User']))
{
	// utilizatorul nu a trecut de faza de logare
	header('Location: index.php') ;
}

include('config.php');
include('userId.php');

$sql = "INSERT INTO Imagini(UserId, URLImg, Lat, Lng) ".
       "VALUES ".
       "('".getUserId($_SESSION['user'])."','".$_POST['urlImg']."','".$_POST['Lat']."','".$_POST['Lng']."')";

$retval = mysql_query( $sql, $db_con );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else
     header('Location: index.php') ;
mysql_close($db_con);
?>