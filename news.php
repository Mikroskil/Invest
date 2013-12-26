<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		session_start();
		$_SESSION['page'] = 'news.php';
	?>
</head>
<body>
	<?php include "header.php";?>
    <div id="clear"></div>
    <br><br>
    <div id="account-wrap">
    
	    <?php
			$result=mysql_query("SELECT * FROM TRD_POSTING A, TRD_ACCOUNT B WHERE A.NO_ACCOUNT = B.NO_ACCOUNT ORDER BY A.POST_TIME DESC");
			while($row=mysql_fetch_array($result))
			{
				echo "<form name='frm' method='get' action='showaccount.php'>";
				echo "<button type='submit' id='baris' name='tampil'>";
				echo "<img src='images/Account/".$row['no_account']."/".$row['profil_pic']."' height='120px'><br>";
				echo "<h2>".$row['nama']."</h2>";
				echo "<h3>".$row['status']."</h3>";
				echo "<input style='width:10%; float:right; height:25px; font-size:15px;' type='submit' value='Like'>";
				echo "<h4>".$row['alamat']."</h4>";
				echo "Posted : ".$row['post_time'];
				echo "<input type='text' style='visibility:hidden;' name='txt_account' value='".$row['no_account']."'>";
				echo "</button>";
				echo "</form>";
				echo "<div id='clear'></div><br>";
			}
		?>
        <div id="clear"></div><br>
        <input type="submit" value="MORE">
    </div>
</body>
</html> 
<?php mysql_close($con); ?>