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
                        echo "<img src='images/nopic.jpg' width='25px' height='25px'>&nbsp;&nbsp;&nbsp;";
                        echo "<a href='userprofile.php'><b>Halo, ".$_SESSION['name']."</b></a>";
                        echo "<div>";
                        echo "	<ul>";
                        echo "		<li><a href='createaccount.php'>Create&nbsp;Account</a></li>";
                        echo "		<li><a href='myaccount.php'>My&nbsp;Accounts</a></li>";
                        echo "		<li><a href='logout.php'>Log&nbsp;Out</a></li>";
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
            <li <?php if($_SESSION['page']=='find.php') echo "class='current'";?> >
            	<a href="find.php"> <img src="images/Menu/find.png" height="50px"></a></li>
            <li <?php if($_SESSION['page']=='forum.php') echo "class='current'";?> >
            	<a href="forum.php"><img src="images/Menu/forum.png" height="50px"></a></li>
            <li <?php if($_SESSION['page']=='trends.php') echo "class='current'";?> >
            	<a href="trends.php"><img src="images/Menu/trends.png" height="50px"></a></li>
            <li <?php if($_SESSION['page']=='news.php') echo "class='current'";?> >
            	<a href="news.php"><img src="images/Menu/news.png" height="50px"></a></li>
            <li <?php if($_SESSION['page']=='friend.php') echo "class='current'";?> >
            	<a href="friend.php"><img src="images/Menu/friend.png" height="50px"></a></li>
        </ul>
    </div>
</div>
<div id="clear"></div>
<br><br>