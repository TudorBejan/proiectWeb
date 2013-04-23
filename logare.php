<?php
		session_start();
		
        //verificam daca s-a cerut o delogare
		if(isset($_GET['logout']))
		{
			session_destroy();
			header('Location: logare.html') ;
		}
			
		//testez daca nu cumva s-a lasat vreun field necompletat
		if(!isset($_GET['user']))
		{
			die("blank username");
		}
		if(!isset($_GET['pass']))
		{
			die("blank password");
		}
		
		include ('valideazaLogare.php');
		
		if(isLoginCorrect($_GET['user'],$_GET['pass']))
		{
			$_SESSION['user']=$_GET['user'];
			$_SESSION['pass']=$_GET['pass'];
			header('Location: index.php') ;
		}
		
?>
