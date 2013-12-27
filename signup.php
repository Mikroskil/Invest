<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
	<script type="text/javascript">
		function validasi()
		{
		   if(!cekusername())
		   	  alert("Username is Incorrect...!!! (Only character and number)");
		   else if (!cekpassword())
			  alert("Password must be minimal 6 characters...!!!");
		   else if (!ceksamapassword())
			  alert("Password and Retype Password must be same...!!!");
		   else if (!ceknama())
			  alert("Full Name is Incorrect...!!!");
		   else if (!cekalamat())
			  alert("Address is Incorrect...!!!");
		   else if (!cekemail())
			  alert("Email is Incorrect...!!!");
		   else if (!cekphone())
			  alert("Phone Number is Incorrect...!!! Format : XXX-XXXXXXXXX");
		   else if (!cekpertanyaan())
			  alert("Choose Security Question...!!!");
		   else if (!cekanswer())
			  alert("Answer must be minimal 6 characters...!!!");
		   else if (!ceksyarat())
			  alert("You must be agree with the terms and conditions...!!!");
		}
		
		function ceknama()
		{
		   var regex = new RegExp("^[a-zA-Z ]+$", "i");
		   return regex.test(document.frm.nama.value);
		}
		
		function cekusername()
		{
		   var regex = new RegExp("^[a-zA-Z0-9]+$", "i");
		   return regex.test(document.frm.username.value);
		}
		
		function cekpassword()
		{
		   var str=document.frm.password.value;
		   if(str.length<6)
		       return false;
			return true;
		}
		
		function ceksamapassword()
		{
			var str1=document.frm.password.value;
			var str2=document.frm.retypepassword.value;
			if(str1!=str2)
				return false;
			return true;
		}
		function cekalamat()
		{
		   var regex = new RegExp("^[a-zA-Z0-9 ]+$", "i");
		   return regex.test(document.frm.alamat.value);
		}
		
		function cekphone()
		{
		   var regex = new RegExp("^[0-9]{3}[-][0-9]+$", "i");
		   return regex.test(document.frm.phone.value);
		}
		
		function cekemail()
		{
		   var regex = new RegExp("^[a-zA-Z0-9 ]+[@][a-zA-Z]+([.][a-zA-Z]+){1,}$", "i");
		   return regex.test(document.frm.email.value);
		}
		function ceksyarat()
		{
			if(document.frm.syarat.checked)
				return true;
			return false;
		}
	</script>
	<?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		session_start();
		$txt = "";
		if(isset($_SESSION['username']))
			header("location:news.php");
	?>
</head>
<body>
	<?php
		if(isset($_POST['daftar']))
		{
			$username= strtoupper($_POST['username']);
			$result=mysql_query("SELECT * FROM mhd_user_maintenances WHERE username = '$username'");
			$cocok=mysql_num_rows($result);
	
			if($cocok)
			{
				echo "<span style='color:red;'>USERNAME ALREADY EXISTS !!!</span><br><br>";
			}
			else
			{
				$password= md5($_POST['password']);
				$name= $_POST['nama'];
				$address= strtoupper($_POST['alamat']);
				$gender= strtoupper($_POST['sex']);
				$kota= strtoupper($_POST['kota']);
				$email= $_POST['email'];
				$phone=$_POST['phone'];
				
				mysql_query(
				"INSERT INTO mhd_user_maintenances (username, password, responsibility, status, nama, email, gender, alamat, kota, 													tanggal_lahir, phone_number)
					  VALUES ('$username', '$password', 'USER', 'ACTIVE', '$name', '$email', '$gender', '$address', '$kota', '', '$phone')");
				header("location:login.php");
			}
		}
	?>
    <?php include "header.php"; ?>
    <div id="clear"></div>
    <br><br>
    <div id="main">
   		<br>
        <div id="kanan">
            <form name="frm" method="post" action="">
                <fieldset style="border-color:#00FF66;">
                    <legend style="color:#00FF66;"><b>User Maintenance</b></legend>
                    <table width="100%">
                        <tr>
                            <td width="40%">Username</td>
                            <td><input type="text" name="username"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password"></td>
                        </tr>
                        <tr>
                            <td>Retype Password</td>
                            <td><input type="password" name="repassword"></td>
                        </tr>
                    </table>
                </fieldset>
                <br><br>
                <fieldset style="border-color:#00FF66;">
                    <legend style="color:#00FF66;"><b>Data Pribadi</b></legend>
                    <table width="100%">
                        <tr>
                            <td width="40%">Nama Lengkap</td>
                            <td><input type="text" name="nama"></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><input style="width:auto; height:auto;" type="radio" name="sex" value="male"/> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input style="width:auto; height:auto;" type="radio" name="sex" value="female"/> Female</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><input type="text" name="alamat"></td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td><input type="text" name="kota"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email"></td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <td><input type="text" name="phone"></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <input type="submit" name="daftar" style="width:100%; border-radius:15px; background-color:#66FF99; font-size:large;" value="SIGN UP" onClick="validasi()">
            </form>
        </div>
        <div id="clear"></div>
        <br><br>
    </div>
</body>
</html>
<?php mysql_close($con); ?>