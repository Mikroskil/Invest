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
</head>
<body>
    <?php include "header.php"; ?>
    <div id="main" style="background:url(images/login.png) no-repeat; height:400px;">
    <br>
    <div id="kanan">
    	<form method="POST" action="">
        <div style="width:90%; margin:auto;"><br>
        	<?php echo $txt;?>
            Username<br>
			<input type="text" name="username"><br><br>
            Password<br>
			<input type="password" name="password"><br><br><br>
			<input style = "background-color:#66FF99; font-size:large; cursor:pointer; border:#00CC00 1px solid;" type="submit" value="LOG IN" name="login">
            <br><br><a href="signup.php" style="text-decoration:none;">
            <input style = "background-color:#66FF99; font-size:large; cursor:pointer; border:#00CC00 1px solid;" type="button" value="SIGN UP"></a><br><br>
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