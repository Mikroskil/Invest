<div id="user">
    <div id="user-wrapper">
    	<div id="user-kiri"><a href="news.php"><img src="images/logo.png" height="80px"/></a></div>
        <div id="user-kanan">
        <?php
        	if(!isset($_SESSION['username']))
			{
				echo "<b>Pengguna Baru? &nbsp;&nbsp;&nbsp;</b><a href='signup.php'><input style='width:30%;' type='button' value = 'SIGN UP'></a>";
				echo "<div id='clear'></div>";
				echo "<a href='login.php'><input style='width:30%;' type='button' value = 'SIGN IN'></a><br>";
			}
			else
			{
        		echo "<ul>";
            	echo "<li>";                    
				/*echo "<img src='images/nopic.jpg' width='25px' height='25px'>&nbsp;&nbsp;&nbsp;";*/
				echo "<a href='userprofile.php'><b>Halo, ".$_SESSION['name']."</b></a>";
				echo "<div>";
				echo "	<ul>";
				echo "		<li><a href='createaccount.php'>Create&nbsp;Account</a></li>";
				echo "		<li><a href='myaccount.php'>My&nbsp;Accounts</a></li>";
				echo "		<li><a href='logout.php'>Log&nbsp;Out</a></li>";
				echo "	</ul>";
				echo "</div>";
				echo "</li>";
        		echo "</ul>";
             }
        ?>
        </div>
    </div>
</div>
<br />
<div id="clear"></div>
<div id="menu">
	<center>
    <div id="menu-wrapper">
        <ul>
            <li <?php if($_SESSION['page']=='find.php') echo "class='current'";?> >
            	<a href="find.php"><center><img src="images/Menu/find.png" height="50px"></center></a></li>
            <li <?php if($_SESSION['page']=='forum.php') echo "class='current'";?> >
            	<a href="forum.php"><center><img src="images/Menu/forum.png" height="50px"></center></a></li>
            <li <?php if($_SESSION['page']=='trends.php') echo "class='current'";?> >
            	<a href="trends.php"><center><img src="images/Menu/trends.png" height="50px"></center></a></li>
            <li <?php if($_SESSION['page']=='news.php') echo "class='current'";?> >
            	<a href="news.php"><center><img src="images/Menu/news.png" height="50px"></center></a></li>
            <li <?php if($_SESSION['page']=='friend.php') echo "class='current'";?> >
            	<a href="friend.php"><center><img src="images/Menu/friend.png" height="50px"></center></a></li>
        </ul>
    </div>
    </center>
</div>
<div id="clear"></div>
<br><br>