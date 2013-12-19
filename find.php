<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		session_start();
		$_SESSION['page'] = 'find.php';
		
		if(isset($_POST['getkoor']))
		{
			$lati = $_POST['latitude'];
			$long = $_POST['longitude'];
			$result=mysql_query("SELECT no_account, user_id, nama,alamat,status,profil_pic, latitude,longitude, $lati as lat1, $long as long1 FROM TRD_ACCOUNT");
		}
		else
			$result=mysql_query("SELECT * FROM TRD_ACCOUNT");
	?>
	
</head>
<body>
	<?php include "header.php";?>
    <div id="clear"></div>
    <form name="frm_sss" action="" method="post">
    <input type="text" name="latitude" readonly id="lati">
	<input type="text" name="longitude" readonly id="long"><br><br>
    <button type="button" name="getkoors" onClick="getLocation()">...</button>
    <input type="submit" name="getkoor">
    </form>
    <div id="find-kiri">
    	<form name="frm_search" method="get" action="">
        	Search<br>
            <input type="text" name="txt_search"> &nbsp;
            <input type="submit" name="btn_search" value="..." style="width:30px; border-radius:0px; cursor:pointer;">
        </form><br>
    </div>
    <div id="find-kanan">
	    <?php
			$exists=mysql_num_rows($result);
			
			if(!$exists)
			{
				echo "<div style='width:50%;margin:auto;'>";
				echo "<h2>YOU DON'T HAVE ANY ACCOUNT</h2>";
				echo "</div>";
			}
			while($row=mysql_fetch_array($result))
			{   echo "<form name='frm' method='get' action='showaccount.php'>";
				echo "<button type='submit' id='baris' name='tampil'>";
				echo "<input type='text' name='txt_account' style='visibility:hidden;' value='".$row['no_account']."'>";
				echo "<img src='images/Account/".$row['no_account']."/".$row['profil_pic']."' height='50px'><br>";
				echo "<h2>".$row['nama']."</h2>";
				/*"<script>getDistanceFromLatLonInKm(".$row['latitude'].",".$row['longitude'].",".$row['lat1'].",".$row['long1'].")</script>"*/
				$dist = sqrt(
							(($row['lat1']-$row['latitude'])*($row['lat1']-$row['latitude']))
							+
							(($row['long1']-$row['longitude'])*($row['long1']-$row['longitude']))
							);
				echo "<h4>".$row['alamat']." (around ".$dist." meters)</h4>";
				echo "</button>";
				echo "<div id='clear'></div><br>";
				echo "</form>";
			}
		?>
        <div id="clear"></div><br>

    </div>
    <script>
        var x=document.getElementById("lati");
        var y=document.getElementById("long");
        function getLocation()
        {
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(showPosition);
            }
            else{x.value="Geolocation is not supported by this browser.";}
        }
        function showPosition(position)
        {
          x.value=position.coords.latitude;
          y.value=position.coords.longitude;
        }
    </script>
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