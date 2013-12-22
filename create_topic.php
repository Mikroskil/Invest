<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		session_start();
		$_SESSION['page'] = 'create_topic.php';
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
                <li><a href="forum.php"><img src="images/Menu/forum.png" height="50px"></a></li>
                <li><a href="trends.php"><img src="images/Menu/trends.png" height="50px"></a></li>
                <li><a href="news.php"><img src="images/Menu/news.png" height="50px"></a></li>
                <!--<li><a href="friend.php"><img src="images/Menu/friend.png" height="50px"></a></li>-->
            </ul>
        </div>
    </div>
    <div id="clear"></div>
    <br><br>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form id="form1" name="form1" method="post" action="add_topic.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" bgcolor="#E6E6E6"><strong>Create New Topic</strong> </td>
</tr>
<tr>
<td width="14%"><strong>Topic</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="topic" type="text" id="topic" size="50" /></td>
</tr>
<tr>
<td valign="top"><strong>Detail</strong></td>
<td valign="top">:</td>
<td><textarea name="detail" cols="50" rows="3" id="detail"></textarea></td>
</tr>
<tr>
<td><strong>Name</strong></td>
<td>:</td>
<td><input name="name" type="text" id="name" size="50" value="<?php if (isset($_SESSION['name'])){echo $_SESSION['name'];} ?>" <?php if (isset($_SESSION['name'])){?> readonly="readonly" "<?php } ?> >
</td>
</tr>
<tr>
<td><strong>Email</strong></td>
<td>:</td>
<td><input name="email" type="text" id="email" size="50" value="<?php if (isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" <?php if (isset($_SESSION['email'])){?> readonly="readonly"<?php } ?>>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit" /> <input type="reset" name="Submit2" value="Reset" /></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</body>
</html>