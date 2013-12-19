<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
	<?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		session_start();
		$_SESSION['page'] = "createaccount.php";
		$result=mysql_query("SELECT MAX(no_account)no_acc FROM TRD_ACCOUNT");
		$no=mysql_fetch_array($result);
	?>
</head>
<body>
	<?php include "header.php"; ?>
    <div id="clear"></div>
		<?php
		if(isset($_POST['create']))
		{
			if ($_FILES["file"]["size"] < 2000000)
			{
				if ($_FILES["file"]["error"] > 0)
					echo "<script>alert('ERROR!!! RETRY AGAIN!!!')</script>";
				else
				{
					mkdir("images/account/".$_POST['no_account']);
					move_uploaded_file($_FILES["file"]["tmp_name"], "images/account/".$_POST['no_account']."/".$_FILES["file"]["name"]);
				}
			}
			else
			  echo "<script>alert('INVALID FILE')</script>";           
			$no_account = $_POST['no_account'];
			$nama 	= $_POST['nama'];
			$user_id = $_SESSION['username'];
			$alamat = $_POST['alamat'];
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$profil_pic = $_FILES["file"]["name"];
			mysql_query(
				"INSERT INTO TRD_ACCOUNT (no_account, user_id, nama, alamat, profil_pic, latitude, longitude)
			     VALUES ('$no_account', '$user_id', '$nama', '$alamat', '$profil_pic', '$latitude', '$longitude')");
			header("location:myaccount.php");
		}
	?>
    <div id="clear"></div>
    <br><br>
        <div id="clear"></div>
        <div id="kanan">
            <form name="frm" method="post" action="" enctype="multipart/form-data">
                <fieldset style="border-color:#00FF66;">
                    <legend style="color:#00FF66;"><b>Account Setup</b></legend>
                    <table width="100%">
                        <tr>
                            <td width="40%">Nomor Account</td>
                            <td><input type="text" name="no_account" readonly value="<?php echo $no['no_acc']+1; ?>"></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </fieldset>
                <br><br>
                <fieldset style="border-color:#00FF66;">
                    <legend style="color:#00FF66;"><b>Data Account</b></legend>
                    <table width="100%">
                        <tr>
                            <td width="40%">Nama Tempat Makan</td>
                            <td colspan="2"><input type="text" name="nama"></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td colspan="2"><input type="text" name="alamat"></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Letak Koordinat</td>
                            <td><input type="text" name="latitude" readonly id="lati"></td>
                            <td><input type="text" name="longitude" readonly id="long"></td>
                            <td><button type="button" name="getkoor" onClick="getLocation()">...</button></td>
                        </tr>
                        <tr>
                            <td><label for="file">Profile Picture</label></td>
                            <td colspan="2"><input type="file" name="file" id="file" style="border:none;"></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <input type="submit" name="create" style="width:100%; border-radius:15px; background-color:#66FF99; font-size:large;" value="CREATE">
            </form>
        </div>
        <div id="clear"></div>
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
        <br><br>
    </div>
</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		
	}
?>
<?php mysql_close($con); ?>