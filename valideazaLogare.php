<?php
	if(!isset($_GET['user']) || !isset($_GET['pass']))
		header('Location: logare.html') ;
		
	function isLoginCorrect($user,$pass)
		{   
		 include('config.php');
		 $sql = "SELECT User FROM Utilizatori WHERE User='".$user."'";
		 $sql2 = "SELECT User FROM Utilizatori WHERE Parola='".$pass."'";
		 $retval = mysql_query( $sql, $db_con );
		 $retval2 = mysql_query( $sql2, $db_con );
		 if(! $retval || ! $retval2)
		   {
				die('Could not take data:' . mysql_error());
		   }
		 else 
			{
				$row = mysql_fetch_array( $retval );
				$row2 = mysql_fetch_array( $retval2 );
				if($row['User']=="")//nu s-a gasit username-ul in baza de date
				{
					echo 'Invalid username or the username do not exist! Please try again.';
					return false;
				}
				else if($row2['User']=="")//nu s-a gasit parola in baza de date
				{
					echo 'Invalid password! Please insert it again.';
					return false;
				}
				else if($row['User']!=$row2['User'])//s-a gasit username si parola dar acestea nu corespund
				{
					echo 'Password missmach! Please insert it again.';
					return false;
				}
			}
			
			return true;
		}
		
	isLoginCorrect($_GET['user'], $_GET['pass']);
?>