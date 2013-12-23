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
	<div id="user">
        <div id="user-wrapper">
            <ul>
                <li>
                	<?php
						if(!isset($_SESSION['username']))
						{
							echo "<a href='login.php'>LOG IN</a>";
						}
						else
						{
							$username = $_SESSION['username'];
							$responsibility = $_SESSION['responsibility'];
							echo "<img src='images/nopic.jpg' width='25px' height='25px'>&nbsp;&nbsp;&nbsp;";
							echo "<a href='userprofile.php'><b>Halo, ".$_SESSION['name']."</b></a>";
							echo "<div>";
							echo "	<ul>";
							if($responsibility == 'ADMINISTRATOR')
								echo "<li><a href='createaccount.php'>Create&nbsp;Account</a></li>";
							echo "<li><a href='myaccount.php'>My&nbsp;Accounts</a></li>";
							echo "<li><a href='logout.php'>Log&nbsp;Out</a></li>";
							echo "	</ul>";
							echo "</div>";
						}
					?>
                </li>
            </ul>
        </div>
    </div>
    <div id="clear"></div>
    <div id="menu">
        <div id="menu-wrapper">
            <ul>
                <li><a href="find.php"><img src="images/Menu/find.png" height="50px"></a></li>
                <li><a href="forum.php"><img src="images/Menu/forum.png" height="50px"></a></li>
                <li><a href="trends.php"><img src="images/Menu/trends.png" height="50px"></a></li>
                <li class="current"><a href="news.php"><img src="images/Menu/news.png" height="50px"></a></li>
                <!--<li><a href="friend.php"><img src="images/Menu/friend.png" height="50px"></a></li>-->
            </ul>
        </div>
    </div>
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