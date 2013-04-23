<?php
 function getUserId($userName)
    {   
	 include('config.php');
	 $sql = "SELECT Id FROM Utilizatori WHERE User='".$userName."'";
	 $retval = mysql_query( $sql, $db_con );
     if(! $retval )
       {
        die('Could not take data getUserId: ' . mysql_error());
       }
     else {$row = mysql_fetch_array( $retval );
	       return $row['Id'];
	      }
    }
?>