<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

		//testez daca nu cumva s-a lasat un field necompletat in form	
		if(!isset($_POST['DesiredUsername']))
		{
			die("blank username");
		}
		if(!isset($_POST['Password']))
		{
			die("blank password");
		}
		if(!isset($_POST['Emailaddress']))
		{
			die("blank emailaddress");
		}
		
		session_start();
		$_SESSION['desireduser']=$_POST['DesiredUsername'];
		$_SESSION['pass']=$_POST['Password'];
		$_SESSION['emailaddress']=$_POST['Emailaddress'];
		
		//indroduc in baza de date utilizatorul
		include('config.php');
		$sql = "INSERT INTO utilizatori(User, Parola, Email) ".
       "VALUES ".
       "('".$_SESSION['desireduser']."','".$_SESSION['pass']."','".$_SESSION['emailaddress']."')";
		$retval = mysql_query( $sql, $db_con );
		if(! $retval )
		{
 			 die('Could not enter data: ' . mysql_error());
		}
		else
		{
		    header('Location: index.php') ;
			mysql_close($db_con);
		}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
