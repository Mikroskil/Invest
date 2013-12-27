<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		session_start();
		$_SESSION['page']='find.php';
		$result=mysql_query("SELECT * FROM TRD_ACCOUNT");
	?>
</head>
<body onLoad="getLocation()">
	<?php include "header.php";?>
    <div id="clear"></div>
    <div id="show">
        <div id="find-kanan">
            <div id="pesan"></div>
            <form>
                Latitude &nbsp;&nbsp;&nbsp;<input type="text" id="txtlat"><br><br>
                Longitude <input type="text" id="txtlon"><br><br>
            </form>
            <div id="mapholder"></div>
            <script>
				var x=document.getElementById("pesan");
				var a=document.getElementById("txtlat");
				var b=document.getElementById("txtlon");
				function getLocation()
				  {
				  if (navigator.geolocation)
					{
					navigator.geolocation.getCurrentPosition(showPosition,showError);
					}
				  else{x.innerHTML="Geolocation is not supported by this browser.";}
				  }
				
				function showPosition(position)
				  {
				  lat=position.coords.latitude;
				  lon=position.coords.longitude;
				  a.value = lat;
				  b.value = lon;
				  latlon=new google.maps.LatLng(lat, lon)
				  mapholder=document.getElementById('mapholder')
				  mapholder.style.height='500px';
				  mapholder.style.width='500px';
				
				  var myOptions={
				  center:latlon,zoom:17,
				  mapTypeId:google.maps.MapTypeId.ROADMAP,
				  mapTypeControl:false,
				  navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
				  };
				  var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
				  var marker=new google.maps.Marker({position:latlon,map:map,title:"Posisi anda saat ini!"});
				  latlon=new google.maps.LatLng(3.58755, 98.69077);
				  var marker=new google.maps.Marker({position:latlon,map:map,title:"Mikroskil!"});
				  }
				
				function showError(error)
				  {
				  switch(error.code) 
					{
					case error.PERMISSION_DENIED:
					  x.innerHTML="User denied the request for Geolocation."
					  break;
					case error.POSITION_UNAVAILABLE:
					  x.innerHTML="Location information is unavailable."
					  break;
					case error.TIMEOUT:
					  x.innerHTML="The request to get user location timed out."
					  break;
					case error.UNKNOWN_ERROR:
					  x.innerHTML="An unknown error occurred."
					  break;
					}
				  }
			</script>
        </div>
        <div id="find-kiri">
            <?php
                while($row=mysql_fetch_array($result))
                {   echo "<form name='frm' method='get' action='showaccount.php'>";
                    echo "<button type='submit' id='baris' name='tampil'>";
                    echo "<div id='img-find'>";
                    echo "<div style='background:url(images/Account/".$row['no_account']."/".$row['profil_pic'].") no-repeat;
					       height:75px; background-size:cover;'>&nbsp;</div></div><br>";
                    echo "<h2>".$row['nama']."</h2>";
                    echo "<h4>".$row['alamat']."</h4>";
                    echo "<input type='text' name='txt_account' style='visibility:hidden;' value='".$row['no_account']."'>";
                    echo "</button>";
                    echo "<div id='clear'></div><br>";
                    echo "</form>";
                }
            ?>
            <div id="clear"></div>
        </div>
    </div>
    <script>
		function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
		  var R = 6371; // Radius of the earth in km
		  var dLat = deg2rad(lat2-lat1);  // deg2rad below
		  var dLon = deg2rad(lon2-lon1); 
		  var a = 
			Math.sin(dLat/2) * Math.sin(dLat/2) +
			Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
			Math.sin(dLon/2) * Math.sin(dLon/2)
			; 
		  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		  var d = R * c; // Distance in km
		  return d;
		}		
		function deg2rad(deg) {
		  return deg * (Math.PI/180)
		}
	</script>
</body>
</html> 
<?php mysql_close($con); ?>