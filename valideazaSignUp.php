<?php
	if(!isset($_GET['user']) || !isset($_GET['email']))
		header('Location: logare.html') ;
	
	function existusername($userId)
		{   
			 include('config.php');
			 $sql = "SELECT User FROM Utilizatori WHERE User='".$userId."'";
			 $retval = mysql_query( $sql, $db_con );
			 if(! $retval )
			 {
				die('Could not take data: ' . mysql_error());
			 }
			 else 
			 {
			 	$row = mysql_fetch_array( $retval );
				if($row['User']!="")
					return true;
			 }
			 
			 return false;
		}
	
	if(existusername($_GET['user']))
		echo 'Your desired username already exists. Please pick another one!';
		
	if(!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
	{
		echo 'E-mail is not valid!';
	}
?>