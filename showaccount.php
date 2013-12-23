<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		session_start();
		$_SESSION['page'] = 'find.php';
		
		if(isset($_SESSION['username']))
			$username = $_SESSION['username'];
		else
			$username = 'tidak ada nama';
		$klik='menu_santapan';
		$no_acc = $_GET['txt_account'];
		if(isset($_GET['tampil']))
			$no_acc = $_GET['txt_account'];
		else if(isset($_GET['post_status']))
		{
			$klik='status_post';
			$no_acc = $_GET['txt_account'];
			$status = $_GET['txt_status'];
			mysql_query("INSERT INTO trd_posting (no_account, status, post_time) VALUES ('$no_acc','$status', now())");
		}
		else if(isset($_GET['like']))
		{
			if(!isset($_SESSION['username']))
			{
				$_SESSION['page'] = "http://localhost/m.apelsimting.com/showaccount.php?tampil=&txt_account=".$_GET['txt_account'];
				header('location:login.php');
			}
			else
			{
			$no_acc = $_GET['txt_account'];
			$username = $_SESSION['username'];
			mysql_query("DELETE FROM like_account WHERE username = '$username' AND no_account = '$no_acc'");
			mysql_query("INSERT INTO like_account(username, no_account, like_status) VALUES ('$username','$no_acc','1')");
			}
		}
		else if(isset($_GET['unlike']) || isset($_GET['undislike']))
		{
			$no_acc = $_GET['txt_account'];
			$username = $_SESSION['username'];
			mysql_query("DELETE FROM like_account WHERE username = '$username' AND no_account = '$no_acc'");
		}
		else if(isset($_GET['dislike']))
		{
			if(!isset($_SESSION['username']))
			{
				$_SESSION['page'] = "http://localhost/m.apelsimting.com/showaccount.php?tampil=&txt_account=".$_GET['txt_account'];
				header('location:login.php');
			}
			else
			{
			$no_acc = $_GET['txt_account'];
			$username = $_SESSION['username'];
			mysql_query("DELETE FROM like_account WHERE username = '$username' AND no_account = '$no_acc'");
			mysql_query("INSERT INTO like_account(username, no_account, like_status) VALUES ('$username','$no_acc','2')");
			}
		}
		else if(isset($_GET['add_makanan']))
		{
			$no_acc = $_GET['txt_account'];
			$nama_sajian = $_GET['txt_nama'];
			$jenis = $_GET['opt_jenis'];
			$harga = $_GET['txt_harga'];
			mysql_query("INSERT INTO menu_sajian(no_account, nama_sajian, jenis, harga) VALUES ('$no_acc','$nama_sajian','$jenis','$harga')");
		}
		else if(isset($_GET['btn_update']))
		{
			$no_acc = $_GET['txt_account'];
			$nama_sajian = $_GET['txt_nama'];
			$harga = $_GET['txt_harga'];
			$seq = $_GET['txt_seq'];
			mysql_query("UPDATE menu_sajian SET nama_sajian = '$nama_sajian', harga = '$harga' WHERE seq = $seq AND no_account = $no_acc");
		}
		else if(isset($_GET['btn_hapus']))
		{
			$no_acc = $_GET['txt_account'];
			$seq = $_GET['txt_seq'];
			mysql_query("DELETE FROM menu_sajian WHERE seq = $seq AND no_account = $no_acc");
		}
		else if(isset($_GET['post_komen']))
		{
			if(!isset($_SESSION['username']))
			{
				$_SESSION['page'] = "http://localhost/m.apelsimting.com/showaccount.php?tampil=&txt_account=".$_GET['txt_account'];
				header('location:login.php');
			}
			else
			{
				$no_acc=$_GET['txt_account'];
				$isi=$_GET['txt_isi'];
				mysql_query("INSERT INTO trd_comment(no_account, username, isi, input_dt) VALUES ('$no_acc','$username','$isi',now())");
			}
		}
		else if(isset($_GET['btn_del']))
		{
			$no_acc=$_GET['txt_account'];
			$seq=$_GET['txt_seq'];
			mysql_query("DELETE FROM trd_comment WHERE seq = $seq");
		}
		else if(isset($_GET['menu_santapan']))
			$klik='menu_santapan';
		else if(isset($_GET['komentar']))
			$klik='komentar';
		else if(isset($_GET['status_post']))
			$klik='status_post';
		else
			header('location:find.php');
		
		$result=mysql_query("SELECT * FROM like_account WHERE username = '$username' and no_account = $no_acc");
		$cocok=mysql_num_rows($result);
		if($cocok)
		{
			$row=mysql_fetch_array($result);
			$like_status = $row['like_status'];
		}
		else
			$like_status = 0;
			
		$result=mysql_query("SELECT COUNT(*) AS jlh_like FROM like_account WHERE no_account = $no_acc and like_status = 1");
		$row=mysql_fetch_array($result);
		$jlh_like = $row['jlh_like'];
		
		$result=mysql_query("SELECT COUNT(*) AS jlh_dislike FROM like_account WHERE no_account = $no_acc and like_status = 2");
		$row=mysql_fetch_array($result);
		$jlh_dislike = $row['jlh_dislike'];
		
		$result=mysql_query("SELECT * FROM TRD_ACCOUNT WHERE NO_ACCOUNT = $no_acc");
		$row=mysql_fetch_array($result);
		$status=$row['status'];
		if(strlen($status)==0)
			$status = "No Post Available";
	?>
</head>
<body>
	<?php include "header.php";?>
    <div id="clear"></div>
    <div id="acc">
    	<div id="acc-kiri">
        	<?php echo "<img src='images/Account/".$row['no_account']."/".$row['profil_pic']."' height='100%'>";?>
        </div>
        <div id="acc-kanan">
        	<?php 
				echo "<h1>".$row['nama']."</h1>";
            	echo "<h3>".$status."</h3>";
				echo "<h4>Location : ".$row['alamat']." (around "." meters)</h4>";
			?>
            <form name="form_like" action="" method="get">
            	<?php
				if($like_status == 1)
            		echo "<input type='submit' value='Unlike' name='unlike'>";
				else
					echo "<input type='submit' value='Like' name='like'>";
				echo "&nbsp;&nbsp;&nbsp;".$jlh_like." people like this. &nbsp;&nbsp;&nbsp;&nbsp;";
					
				if($like_status == 2)
            		echo "<input type='submit' value='Undislike' name='undislike'>";
				else
					echo "<input type='submit' value='Dislike' name='dislike'>";
				echo "&nbsp;&nbsp;&nbsp;".$jlh_dislike." people don't like this.";
				?>
                <input type="text"  name="txt_account" style="visibility:hidden;" value=" <?php echo $row['no_account'];?> ">
            </form>
        </div>
    </div>
    <div id="clear"></div><br>
    <?php
		if(isset($_SESSION['username']))
		{
			if($_SESSION['username']==$row['user_id'])
			{
				echo "<div id='post-status'>";
				echo	"<form name='frm_status' method='get' action=''>";
				echo 	"<table width='100%' bordercolor='#006600' border='1px'>";
				echo    "	 <tr bgcolor='#CFEFE1'><td>POSTING YOUR STATUS</td></tr>";
				echo    "    <tr bgcolor='#EFFFF'><td><textarea name='txt_status' rows='4' cols='140'></textarea></td></tr>";
				echo    "    <tr bgcolor='#CFEFE1'>
								<td>
								<input type='submit' value='POST' name='post_status'>
								<input type='text' style='visibility:hidden;' name='txt_account' value='".$row['no_account']."'>
								</td>
							 </tr>";
				echo    "</table>";
				echo    "</form>";
				echo "</div>";
			}
		}
	?>
    <div id="clear"></div><br>
    <div id="show">
        <div id="show-kiri">
        <form name="frm_menu" method="get" action="">
          <ul>
          	<li><input type="submit" value="Menu Santapan >>" name="menu_santapan"></li>
            <li><input type="submit" value="Komentar      >>" name="komentar"></li>
            <li><input type="submit" value="Status Post   >>" name="status_post"></li>
            <li><input type="text" value="<?php echo $no_acc;?>" name="txt_account" style="visibility:hidden;"></li>
          </ul>
         </form>
        </div>
        <div id="show-kanan">
        <?php
		if($klik=='menu_santapan')
		{
        	if($username==$row['user_id'])
			{
				echo "<div>";
				echo	"<form name='frm_add_makanan' method='get' action=''>";
				echo 	"Nama Sajian : ";
				echo    "<input type='text' name='txt_nama'>&nbsp;&nbsp;&nbsp;";
				echo 	"Makanan/Minuman : ";
				echo    "<select name='opt_jenis'>";
				echo 	"	<option>Makanan</option>";
				echo 	"	<option>Minuman</option>";
				echo    "</select>&nbsp;&nbsp;&nbsp;";
				echo 	"Harga : ";
				echo    "<input type='text' name='txt_harga'>&nbsp;&nbsp;&nbsp;";
				echo    "<input type='submit' name='add_makanan' value='Tambah'>";
				echo    "<input type='text' style='visibility:hidden;' name='txt_account' value='".$row['no_account']."'>";
				echo    "</form>";
				echo "</div>";
			}
			$result1=mysql_query("SELECT * FROM menu_sajian WHERE NO_ACCOUNT = $no_acc AND jenis = 'Makanan'");
			$ada=mysql_num_rows($result1);
			if($ada)
			{
				echo "<div>";
				echo 	"<div>";
				echo 	"<table width='100%' bordercolor='#006600' border='0px' style='border-collapse:collapse;'>";
				echo    "	 <tr>
								<td bgcolor='#CFEFE1' colspan='2'>Makanan</td>
							 </tr>";
				while($row1=mysql_fetch_array($result1))
				{
					echo	"<form name='frm_makan' method='get' action=''>";
					echo    "	 <tr>
									<td width='60%'><input style='width:90%;' type='text' name='txt_nama' value='".$row1['nama_sajian']."'></td>
									<td width='20%' align='right'><input type='text' name='txt_harga' value='".$row1['harga']."'></td>";
									
					if($username==$row['user_id'])
					{
						echo "		<td align='right'><input type='submit' name='btn_update' value='Update'></td>";
						echo "		<td><input type='submit' name='btn_hapus' value='Hapus'></td>";
					}
					echo	"		<input type='text' name='txt_seq' style='visibility:hidden;' value='".$row1['seq']."'>
								 </tr>";
					echo    "<input type='text' style='visibility:hidden;' name='txt_account' value='".$no_acc."'>";
					echo    "</form>";
				}
				echo    "</table>";
				echo    "</div>";
				echo	"<form name='frm_makanan' method='get' action=''>";
				echo    "<input type='text' style='visibility:hidden;' name='txt_account' value='".$no_acc."'>";
				echo    "</form>";
				echo "</div>";
			}
			echo "<div id='clear'></div>";
			$result1=mysql_query("SELECT * FROM menu_sajian WHERE NO_ACCOUNT = $no_acc AND jenis = 'Minuman'");
			$ada=mysql_num_rows($result1);
			if($ada)
			{
				echo "<div>";
				echo 	"<div>";
				echo 	"<table width='100%' bordercolor='#006600' border='0px' style='border-collapse:collapse;'>";
				echo    "	 <tr>
								<td bgcolor='#CFEFE1' colspan='2'>Minuman</td>
							 </tr>";
				while($row1=mysql_fetch_array($result1))
				{
					echo	"<form name='frm_minum' method='get' action=''>";
					echo    "	 <tr>
									<td width='60%'><input style='width:90%;' type='text' name='txt_nama' value='".$row1['nama_sajian']."'></td>
									<td width='20%' align='right'><input type='text' name='txt_harga' value='".$row1['harga']."'></td>";
									
					if($username==$row['user_id'])
					{
						echo "		<td align='right'><input type='submit' name='btn_update' value='Update'></td>";
						echo "		<td><input type='submit' name='btn_hapus' value='Hapus'></td>";
					}
					echo	"		<input type='text' name='txt_seq' style='visibility:hidden;' value='".$row1['seq']."'>
								 </tr>";
					echo    "<input type='text' style='visibility:hidden;' name='txt_account' value='".$no_acc."'>";
					echo    "</form>";
				}
				echo    "</table>";
				echo    "</div>";
				echo	"<form name='frm_minuman' method='get' action=''>";
				echo    "<input type='text' style='visibility:hidden;' name='txt_account' value='".$no_acc."'>";
				echo    "</form>";
				echo "</div>";
			}
		}
		else if($klik=='komentar')
		{
			$result1=mysql_query("SELECT * FROM trd_comment WHERE NO_ACCOUNT = $no_acc");
			$ada=mysql_num_rows($result1);
			if($ada)
			{
				while($row1=mysql_fetch_array($result1))
				{
					echo "<form name='frm_komen' action='' method='get'>";
					echo "<div id='tmp-komentar'>";
					echo "<span>".$row1['username']."<span> &nbsp;(comment on ".$row1['input_dt'].")</span></span>";
					if($username==$row1['username'])
					{
						echo "<input type='text' style='visibility:hidden;' name='txt_seq' value='".$row1['seq']."'>";
						echo "<input type='text' style='visibility:hidden;' name='txt_account' value='".$no_acc."'>";
						echo "<input type='submit' name='btn_del' value='Hapus Komentar'>";
					}
					echo "<h6>".$row1['isi']."</h6>";
					echo "</div>";
					echo "</form>";
					echo "</div>";
				}
			}
			echo "<div id='clear'></div>";
			echo "<div>";
			echo	"<form name='frm_post_komen' method='get' action=''>";
			echo 	"<table width='80%' bordercolor='#006600' border='1px'>";
			echo    "	 <tr bgcolor='#CFEFE1'><td><b>Write Comment</b></td></tr>";
			echo    "    <tr bgcolor='#EFFFF'><td><textarea name='txt_isi' rows='4' cols='140'></textarea></td></tr>";
			echo    "    <tr bgcolor='#CFEFE1'>
							<td>
							<input type='submit' value='Kirim Komentar' name='post_komen'>
							<input type='text' style='visibility:hidden;' name='txt_account' value='".$no_acc."'>
							</td>
						 </tr>";
			echo    "</table>";
			echo    "</form>";
			echo "</div>";
		}
		else if($klik=='status_post')
		{
			$result1=mysql_query("SELECT * FROM trd_posting WHERE NO_ACCOUNT = $no_acc");
			$ada=mysql_num_rows($result1);
			if($ada)
			{
				while($row1=mysql_fetch_array($result1))
				{
					echo "<form name='frm_komen' action='' method='get'>";
					echo "<div id='tmp-komentar'>";
					echo "<span><span> &nbsp;(Posting on ".$row1['post_time'].")</span></span>";
					echo "<h6>".$row1['status']."</h6>";
					echo "</div>";
					echo "</form><br>";
				}
			}
		}
		?>
        </div>
    </div>
    <br><br>
    <div id="clear"></div>
</body>
</html> 