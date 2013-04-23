 <?php 
   session_start();
   if(!isset($_SESSION['user']))
   {
	// utilizatorul nu a trecut de faza de logare
	header('Location: index.php') ;
   }

   function deleteMarker($imageId)
	{
	 include('config.php');
	 $sql = "DELETE FROM Imagini WHERE Id=".$imageId." AND UserId=".$_SESSION['UserId'];
	 $retval = mysql_query( $sql, $db_con );
     if(! $retval )
       {
        die('Could not delete data: ' . mysql_error());
       }
	}

   if(isset($_GET['id']))
      deleteMarker($_GET['id']);
?>