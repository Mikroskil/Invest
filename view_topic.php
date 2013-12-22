<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
                <li><a href="forum.php"><img src="images/Menu/forum.png" height="50px"></a></li>
                <li><a href="trends.php"><img src="images/Menu/trends.png" height="50px"></a></li>
                <li><a href="news.php"><img src="images/Menu/news.png" height="50px"></a></li>
                <!--<li><a href="friend.php"><img src="images/Menu/friend.png" height="50px"></a></li>-->
            </ul>
        </div>
    </div>
    <div id="clear"></div>
    <br><br>
<?php

$tbl_name="forum_question"; // Table name 



// get value of id that sent from address bar 
$id=$_GET['id'];
$sql="SELECT * FROM $tbl_name WHERE id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);
?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td id="baris"><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#003300">
<tr>
<td bgcolor="#009900"><strong><?php echo $rows['topic']; ?></strong></td>
</tr>

<tr>
<td bgcolor="#FFFFFF"><?php echo $rows['detail']; ?></td>
</tr>

<tr>
<td bgcolor="#F8F7F1"><strong>By :</strong> <?php echo $rows['name']; ?> <strong>Email : </strong><?php echo $rows['email'];?></td>
</tr>

<tr>
<td bgcolor="#F8F7F1"><strong>Date/time : </strong><?php echo $rows['datetime']; ?></td>
</tr>
</table></td>
</tr>
</table>
<BR>

<?php

$tbl_name2="forum_answer"; // Switch to table "forum_answer"
$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$id'";
$result2=mysql_query($sql2);
while($rows=mysql_fetch_array($result2)){
?>

<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
 <td id="baris"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#F8F7F1"><strong>ID</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo $rows['a_id']; ?></td>
</tr>
<tr>
<td width="80" bgcolor="#F8F7F1"><strong>Name</strong></td>
<td width="1" bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo $rows['a_name']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Email</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo $rows['a_email']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Answer</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#FFFFFF"><?php echo $rows['a_answer']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Date/Time</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo $rows['a_datetime']; ?></td>
</tr>
</table></td>
</tr>
</table><br>
<?php
}

$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
$result3=mysql_query($sql3);
$rows=mysql_fetch_array($result3);
$view=$rows['view'];
 
// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
$result4=mysql_query($sql4);
}
 
// count more value
$addview=$view+1;
$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
$result5=mysql_query($sql5);
mysql_close();
?>

<BR>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="add_answer.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td width="18%"><strong>Name</strong></td>
<td width="3%">:</td>
<td width="79%">

<input name="a_name" type="text" id="a_name" size="45"  value="<?php if (isset($_SESSION['name'])){echo $_SESSION['name'];} ?>" <?php if (isset($_SESSION['name'])){?> readonly="readonly" "<?php } ?>>
</td>
</tr>
<tr>
<td><strong>Email</strong></td>
<td>:</td>
<td>

<input name="a_email" type="text" id="a_email" size="45"  value="<?php if (isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" <?php if (isset($_SESSION['email'])){?> readonly="readonly"<?php } ?>></td>

</td>
</tr>
<tr>
<td valign="top"><strong>Answer</strong></td>
<td valign="top">:</td>
<td><textarea name="a_answer" cols="45" rows="3" id="a_answer"></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</body>
</html>