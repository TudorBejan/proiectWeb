<?php
  session_start();
  if(!isset($_SESSION['user']) || !isset($_SESSION['pass']))
     header('Location: logare.html') ;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0; padding: 0 }
  #map_canvas { height: 100% }
</style>
<script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDdreaYouSM69BoGTfxmgamlVVZenoMVeA&sensor=false">
</script>
<script type="text/javascript">
var markersArray = [];
var map;

function deleteMarker(rowId)
{
	var xmlHttp=new XMLHttpRequest();
    var url="stergeMarker.php?id=" + rowId;
    xmlHttp.open("GET",url,false);
    xmlHttp.send();
}

function HomeControl(controlDiv, map) {
  // Set CSS styles for the DIV containing the control
  // Setting padding to 5 px will offset the control
  // from the edge of the map.
  controlDiv.style.padding = '5px';

  // Set CSS for the control border.
  var controlUI = document.createElement('DIV');
  controlUI.style.backgroundColor = 'white';
  controlUI.style.borderStyle = 'solid';
  controlUI.style.borderWidth = '3px';
  controlUI.style.cursor = 'pointer';
  controlUI.style.textAlign = 'center';
  controlUI.title = 'Click to log out of the service';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  var controlText = document.createElement('DIV');
  controlText.style.fontFamily = 'Arial,sans-serif';
  controlText.style.fontSize = '12px';
  controlText.style.paddingLeft = '4px';
  controlText.style.paddingRight = '4px';
  controlText.innerHTML = 'Log out';
  controlUI.appendChild(controlText);

  google.maps.event.addDomListener(controlUI, 'click', function() {
	document.location = 'logare.php?logout=1';
  });
}

function initialize() 
{
    var latlng = new google.maps.LatLng(45, 25);
    var myOptions =
	{
      zoom: 6,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    };
    
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	 // Create the DIV to hold the control and call the HomeControl() constructor
     // passing in this DIV.
     var homeControlDiv = document.createElement('DIV');
     var homeControl = new HomeControl(homeControlDiv, map);

     homeControlDiv.index = 1;
     map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
	
	google.maps.event.addListener(map, 'click', function(event) 
	{
       addMarker(event.latLng);
    });
  
    <?php
	 include('config.php');
	 include('userId.php');

	 function getUserName($userId)
    {   
	 include('config.php');
	 $sql = "SELECT User FROM Utilizatori WHERE Id=".$userId;
	 $retval = mysql_query( $sql, $db_con );
     if(! $retval )
       {
        die('Could not take data getUserName: ' . mysql_error());
       }
     else {$row = mysql_fetch_array( $retval );
	       return $row['User'];
	      }
    }
	  
	  
	 $sql = "SELECT * FROM Imagini ";
	 $retval = mysql_query( $sql, $db_con );
     if(! $retval )
       {
        die('Could not take data: ' . mysql_error());
       }
     else
	   {
	    // avem datele, ciclam si afisam imaginile
		while($row = mysql_fetch_array( $retval )) 
		{
		echo "marker".$row['Id']." = new google.maps.Marker({
              position: new google.maps.LatLng(".$row['Lat'].",".$row['Lng']."),"
			  .($row['UserId'] == getUserId($_SESSION['user']) ? "icon: 'red_MarkerI.png', title: 'My image'," : "icon: 'purple_MarkerO.png', title: '".getUserName($row['UserId'])."\'s image',").
			  "map: map});";
		echo "\n";
	    echo "marker".$row['Id'].".setMap(map);";
		echo "\n";
		echo "google.maps.event.addListener(marker".$row['Id'].", 'rightclick', function() {
		      var contentString = '<center>' +
			                      '<a target=\"_blank\" href=\"".$row['URLImg']."\">' +
								  '<img height = \"100\" width=\"100\" src=\"".$row['URLImg']."\"/><br>' +
								  '</a>' +
								  '<font size=\"2\" >(click to open in new window)</font>' +
								  '</center>';
		var infowindow = new google.maps.InfoWindow({
		content: contentString
		});
        infowindow.open(map,this);
        });";
        
		//dam drepturi de stergere userului curent asupra imaginilor sale
        if($row['UserId'] == getUserId($_SESSION['user']))
          {
		   echo "google.maps.event.addListener(marker".$row['Id'].", 'dblclick', function() 
                { if(confirm(\"Are you sure that you want to delete this marker and the image that it includes?\") == true)
		             {this.setMap(null);
					  deleteMarker(".$row['Id'].");
			         }
				});";
		  }		
		}
	   }
	?>
}

function addMarker(location)
{
  marker = new google.maps.Marker(
  {
    position: location,
	icon: 'yellow_MarkerN.png',
	title: 'New location',
    map: map
  });
  markersArray.push(marker);
  
  google.maps.event.addListener(marker, 'rightclick', function() 
  {
	var contentString = '<div id="content">' +
						'<div id="siteNotice">' +
						'</div>' +
						'<h3 id="firstHeading" class="firstHeading">Load image</h3>' +
						'<div id="bodyContent">' +
						'<form name="formularIncImg" method="post" action="incarcaImg.php" onsubmit="return verificaURLImg(this)">' +
						'<P>URL: <INPUT type="text" name="urlImg"><BR>' +
						'<input type="hidden" name="Lat" value="'+this.getPosition().lat()+'" />' +
						'<input type="hidden" name="Lng" value="'+this.getPosition().lng()+'" />' +
						'<INPUT type="submit" name="trimit" value="Save image">' +
						'</form>' +
						'</div>' +
						'</div>';

    var infowindow = new google.maps.InfoWindow(
	{
		content: contentString
	});
	
    infowindow.open(map,this);
  });
  
  google.maps.event.addListener(marker	, 'dblclick', function() 
  {
	if(confirm("Are you sure that you want to delete this new marker?") == true)
		this.setMap(null);
  });
}

function verificaURLImg(frmApeland)
{
 var adresaURL = frmApeland.urlImg.value;
 if(adresaURL.length == 0)
 {
   alert('You haven\'t typed the URL address!');
   return false;
  }
  else
  {
	var urlRegxp = /^https?:\/\/(?:[a-z\-]+\.)+[a-z]{2,6}(?:\/[^\/#?]+)+\.(?:jpe?g|gif|png)$/;
	if (urlRegxp.test(adresaURL) != true) 
	{
		alert('URL incorrect!\nPermited images: JPG/JPEG, GIF and PNG.');
		return false;
	} 
	else return true;	
  }
}

</script>
</head>
<body onload="initialize()">
  <div id="map_canvas" style="width:100%; height:100%"></div>
</body>
</html>