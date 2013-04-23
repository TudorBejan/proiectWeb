<?php
// Connection's Parameters
$db_host="localhost";
$db_name="GoogleMaps";
$username="root";
$password="capricorn12";
$db_con=mysql_connect($db_host,$username,$password);
if (!$db_con)
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db($db_name);
?>