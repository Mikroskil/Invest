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
<?php include "header.php";?>


<BR>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="add_answer.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

<tr>
<td width="18%"><strong>Username</strong></td>
<td width="3%">:</td>
<td width="79%">

<input name="a_name" type="text" id="a_name" size="45"  value="<?php if (isset($_SESSION['username'])){echo $_SESSION['username'];} ?>" disabled="disabled">
</td>
</tr>

<tr>
<td width="18%"><strong>Name</strong></td>
<td width="3%">:</td>
<td width="79%">

<input name="a_name" type="text" id="a_name" size="45"  value="<?php if (isset($_SESSION['name'])){echo $_SESSION['name'];} ?>">
</td>
</tr>
<tr>
<td><strong>Email</strong></td>
<td>:</td>
<td>

<input name="a_email" type="text" id="a_email" size="45"  value="<?php if (isset($_SESSION['email'])){echo $_SESSION['email'];} ?>"></td>

</td>
</tr>
<tr>
<td width="18%"><strong>Alamat</strong></td>
<td width="3%">:</td>
<td width="79%">

<input name="a_name" type="text" id="a_name" size="45"  value="<?php if (isset($_SESSION['alamat'])){echo $_SESSION['alamat'];} ?>">
</td>
</tr>
<tr>
<td width="18%"><strong>Kota</strong></td>
<td width="3%">:</td>
<td width="79%">

<input name="a_name" type="text" id="a_name" size="45"  value="<?php if (isset($_SESSION['kota'])){echo $_SESSION['kota'];} ?>">
</td>
</tr>
<tr>
<td width="18%"><strong>Gender</strong></td>
<td width="3%">:</td>
<td width="79%">
<input type="radio" name="gender" value="MALE" <?php if (($_SESSION['gender'])=='MALE'){ ?>checked="checked"<?php }?> />MALE
<input type="radio" name="gender" value="FEMALE" <?php if (($_SESSION['gender'])!='MALE'){ ?>checked="checked"<?php } ?> />FEMALE
</td>
</tr>
<tr>
<td width="18%"><strong>Tanggal lahir</strong></td>
<td width="3%">:</td>
<td width="79%">

<input name="a_name" type="date" id="a_name" value="<?php {echo $_SESSION['tanggal_lahir'];} ?>">
</td>
</tr>
<tr>
<td width="18%"><strong>Telepon</strong></td>
<td width="3%">:</td>
<td width="79%">

<input name="a_name" type="text" id="a_name" size="45"  value="<?php if (isset($_SESSION['phone_number'])){echo $_SESSION['phone_number'];} ?>">
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="Save Changes"> <input type="reset" name="Submit2" value="Cancel"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</body>
</html>