<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		
		session_start();
		$txt = "";
		if(isset($_POST['login']))
		{
			$username=strtoupper($_POST['username']);
			$password=md5($_POST['password']);
			$result=mysql_query("SELECT * FROM MHD_USER_MAINTENANCES WHERE username='$username' && password='$password'");
			$cocok=mysql_num_rows($result);
			
			if($cocok)
			{
				$row=mysql_fetch_array($result);
				$nama=$row['nama'];
				$_SESSION['email']=$row['email'];
				$_SESSION['gender']=$row['gender'];
				$_SESSION['alamat']=$row['alamat'];
				$_SESSION['kota']=$row['kota'];
				$_SESSION['tanggal_lahir']=$row['tanggal_lahir'];
				$_SESSION['phone_number']=$row['phone_number'];
				$_SESSION['name']=$nama;
				$_SESSION['username']=$username;
				$_SESSION['responsibility']=$row['responsibility'];
				if($_SESSION['page']=='login.php')
					header("location:news.php");
				else
					header("location:".$_SESSION['page']);
			}
			else
				$txt = "<span style='color:red;'>Invalid Username or Password</span><br><br>";
		}
		if(isset($_SESSION['username']))
		{
			header("location:news.php");
		}
		if(!isset($_SESSION['page']))
			$_SESSION['page']='login.php';
	?>
    <script>
		function func1(y)
		{
			var x=document.getElementById(y);
			if(x.value=="USERNAME" || x.value=="PASSWORD")
			{
				x.style = "color:#000;";
				x.value = "";
				if(y=="txtpassword")
					x.type = "password";
			}
		}
		function func2(y)
		{
			var x=document.getElementById(y);
			if(x.value.length == 0)
			{
				x.style = "color:#AAA;";
				x.type = "text";
				if(y=="txtusername")
					x.value = "USERNAME";
				else if (y=="txtpassword")
					x.value = "PASSWORD";
			}
		}
		
	</script>
</head>
<body>
    <?php include "header.php"; ?>
    <div id="main" style="background:url(images/login.png) no-repeat; height:400px;">
    <br>
    <div id="kanan">
    	<form method="POST" action="">
        <div style="width:100%; margin:auto;"><br>
        	<?php echo $txt;?>
            <center>
			<input type="text" name="username" value="USERNAME" id="txtusername" style="color:#AAAAAA;" 
            onFocus="func1('txtusername')" onBlur="func2('txtusername')"><br><br>
			<input type="text" name="password" value="PASSWORD" id="txtpassword" style="color:#AAAAAA;" 
            onFocus="func1('txtpassword')" onBlur="func2('txtpassword')"><br><br><br>
			<input style = "background-color:#66FF99; font-size:large; cursor:pointer; border:#00CC00 1px solid;" type="submit" value="LOG IN" name="login">
            <br><br><a href="signup.php" style="text-decoration:none;">
            <input style = "background-color:#66FF99; font-size:large; cursor:pointer; border:#00CC00 1px solid;" type="button" value="SIGN UP"></a><br><br>
            </center>
        </div>
		</form>
    </div>
    <div id="kiri">
    	<h2>TEMUKAN INFO MAKANAN ENAK DI SEKITAR ANDA</h2>
        <p align="center">Masuk dan komentari makanan yang sudah anda makan...</p>
    </div>
    </div>
    <div id="clear"></div>
</body>
</html>
<?php mysql_close($con);?>