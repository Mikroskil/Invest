<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <?php
		include "connect.php";
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
	<div id="user">
        <div id="user-wrapper">
            <ul>
                <li>
                	<img src="images/nopic.jpg" width="25px" height="25px">&nbsp;&nbsp;&nbsp;<a href="userprofile.php"><b>Halo, <?php echo $_SESSION['name'];?></b></a>
                    <div>
                        <ul>
<?php if($responsibility == 'ADMINISTRATOR') {echo "<li><a href='createaccount.php'>Create&nbsp;Account</a></li>";} ?>
                            <li><a href="myaccount.php">My&nbsp;Accounts</a></li>
                            <li><a href="logout.php">Log&nbsp;Out</a></li>                          
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div id="clear"></div>
    <div id="menu">
        <div id="menu-wrapper">
            <ul>
                <li><a href="find.php"><img src="images/Menu/find.png" height="50px"></a></li>
                <li class="current"><a href="forum.php"><img src="images/Menu/forum.png" height="50px"></a></li>
                <li><a href="trends.php"><img src="images/Menu/trends.png" height="50px"></a></li>
                <li><a href="news.php"><img src="images/Menu/news.png" height="50px"></a></li>
               <!-- <li><a href="friend.php"><img src="images/Menu/friend.png" height="50px"></a></li>-->
            </ul>
        </div>
    </div>
    <div id="clear"></div>
    <br><br>
    <?php mysql_close($con); ?>
<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="apel"; // Database name 
$tbl_name="forum_question"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$sql="SELECT * FROM $tbl_name ORDER BY id DESC";
// OREDER BY id DESC is order result by descending

$result=mysql_query("SELECT * FROM forum_question");
?>
<div id="box">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bordercolor="#006600">
<tr>
<td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
<td width="15%" align="center" bgcolor="#E6E6E6"><strong>Views</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Replies</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
</tr>

<?php
// Start looping table row
while($rows=mysql_fetch_array($result)){
?>
<tr>
<td bgcolor="#FFFFFF"><?php echo $rows['id']; ?></td>
<td bgcolor="#FFFFFF"><a href="view_topic.php?id=<?php echo $rows['id']; ?>"><?php echo $rows['topic']; ?></a><br></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['view']; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['reply']; ?></td>
<td align="center" bgcolor="#FFFFFF"><?php echo $rows['datetime']; ?></td>
</tr>

<?php
// Exit looping and close connection 
}
mysql_close();
?>

<tr>
<td colspan="5" align="right" bgcolor="#E6E6E6"><a href="create_topic.php"><strong>Create New Topic</strong> </a></td>
</tr>
</table>
</div>
</body>
</html>