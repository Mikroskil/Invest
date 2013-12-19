<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		session_start();
		$_SESSION['page'] = 'myaccount.php';
		if (!isset($_SESSION['username']))
		{
			header("location:login.php");
		}
		$username = $_SESSION['username'];
		$responsibility = $_SESSION['responsibility'];
	?>
</head>
<body>
    <?php include "header.php"; ?>
    <div id="clear"></div>
    <div id="account-wrap">
    <form name="frm" method="post" action="showaccount.php">
	    <?php
        	$result=mysql_query("SELECT * FROM TRD_ACCOUNT WHERE USER_ID = '$username'");
			$exists=mysql_num_rows($result);
			
			if(!$exists)
			{
				echo "<div style='width:50%;margin:auto;'>";
				echo "<h2>YOU DON'T HAVE ANY ACCOUNT</h2>";
				echo "<h4><a href=''>PELAJARI BAGAIMANA MEMBUAT ACCOUNT</a></h4>";
				echo "</div>";
			}
			while($row=mysql_fetch_array($result))
			{
				echo "<button id='baris'>";
				echo "<img src='images/Account/".$row['no_account']."/".$row['profil_pic']."' height='50px'><br>";
				echo "<h2>".$row['nama']."</h2>";
				echo "<h4>".$row['alamat']."</h4>";
				echo "</button>";
				echo "<div id='clear'></div><br>";
			}
		?>
        <div id="clear"></div><br>
        <!--<input type="submit" value="MORE">-->
     </form>
    </div>
</body>
</html>
<?php mysql_close($con); ?>