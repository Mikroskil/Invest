<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <?php
		include "connect.php";
		session_start();
		$_SESSION['page'] = 'forum.php';
		if (!isset($_SESSION['username']))
		{
			header("location:login.php");
		}
		$username = $_SESSION['username'];
		$responsibility = $_SESSION['responsibility'];
	?>
</head>

<body>
<?php include "header.php";?>
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
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td id="baris"><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#003300">
<td width="6%" align="center" bgcolor="#009900"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#009900"><strong>Topic</strong></td>
<td width="15%" align="center" bgcolor="#009900"><strong>Views</strong></td>
<td width="13%" align="center" bgcolor="#009900"><strong>Replies</strong></td>
<td width="13%" align="center" bgcolor="#009900"><strong>Date/Time</strong></td>
</tr>

<?php
// Start looping table row
while($rows=mysql_fetch_array($result)){
?>
<tr>
<td bgcolor="#FFFFFF" align="center"><?php echo $rows['id']; ?></td>
<td bgcolor="#FFFFFF" align="center"><a href="view_topic.php?id=<?php echo $rows['id']; ?>"><?php echo $rows['topic']; ?></a><br></td>
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
<td colspan="5" align="right" bgcolor="009900"><a href="create_topic.php"><b><font color="#FFFF00">Create New Topic</font></b> </a></td>
</table></td>
</tr>
</table>
</div>
</body>
</html>