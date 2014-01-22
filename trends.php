<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="template/template.css" type="text/css">
    <?php
		$con=mysql_connect("localhost","root","");
		mysql_select_db("apel", $con);
		session_start();
		$_SESSION['page'] = 'trends.php';
	?>
    <script src="template/jquery-1.8.0.min.js">
    </script>
	<script>
	$(document).ready(function(){
	  $("#flip").click(function(){
		$("#panel").slideToggle("slow");
	  });
	});
	</script>

	<style type="text/css">
	#panel,#flip
	{
	padding:5px;
	text-align:center;
	background-color:#e5eecc;
	border:solid 1px #c3c3c3;
	}
	#panel
	{
	padding:50px;
	display:none;
	}
	</style>
    <script>
	$(document).ready(function(){
	  $("#flip1").click(function(){
		$("#panel1").slideToggle("slow");
	  });
	});
	</script>

	<style type="text/css">
	#panel1,#flip1
	{
	padding:5px;
	text-align:center;
	background-color:#e5eecc;
	border:solid 1px #c3c3c3;
	}
	#panel1
	{
	padding:50px;
	display:none;
	}
	</style>
</head>
<body>
	<?php include "header.php";?>
    <div id="clear"></div>
    <br><br>
    <div id="account-wrap">
    	<div id="flip">TEMPAT MAKAN TERFAVORIT</div>
		<div id="panel">
	    <?php
			$result=mysql_query("SELECT * FROM TRD_ACCOUNT WHERE USER_ID = 'TESTING'");
			$exists=mysql_num_rows($result);

			if(!$exists)
			{
				echo "<div style='width:50%;margin:auto;'>";
				echo "<h2>YOU DON'T HAVE ANY ACCOUNT</h2>";
				echo "<h4><a href=''>PELAJARI BAGAIMANA MEMBUAT ACCOUNT</a></h4>";
				echo "</div>";
			}
			while($row=mysql_fetch_array($result))
			{
				echo "<form name='frm' method='get' action='showaccount.php'>";
                echo "<button type='submit' id='baris' name='tampil'>";
				echo "<div id='img-find'>";
                echo "<div style='background:url(images/Account/".$row['no_account']."/".$row['profil_pic'].") no-repeat;
					   height:75px; background-size:cover;'>&nbsp;</div></div><br>";
				echo "<h2>".$row['nama']."</h2>";
				echo "<h4>".$row['alamat']."</h4>";
				echo "<input type='text' name='txt_account' style='visibility:hidden;' value='".$row['no_account']."'>";
				echo "</button>";
				echo "<div id='clear'></div><br>";
                echo "</form>";
			}
		?>
        </div>
        <div id="clear"></div><br>
        <div id="flip1">THE BEST TASTE</div>
		<div id="panel1">
	    <?php
			$result=mysql_query("SELECT * FROM TRD_ACCOUNT WHERE NO_ACCOUNT = '13000007'");
			$exists=mysql_num_rows($result);

			while($row=mysql_fetch_array($result))
			{
				echo "<form name='frm' method='get' action='showaccount.php'>";
                echo "<button type='submit' id='baris' name='tampil'>";
				echo "<div id='img-find'>";
                echo "<div style='background:url(images/Account/".$row['no_account']."/".$row['profil_pic'].") no-repeat;
					       height:75px; background-size:cover;'>&nbsp;</div></div><br>";
				echo "<h2>".$row['nama']."</h2>";
				echo "<h4>".$row['alamat']."</h4>";
				echo "<input type='text' name='txt_account' style='visibility:hidden;' value='".$row['no_account']."'>";
				echo "</button>";
				echo "<div id='clear'></div><br>";
                echo "</form>";
			}
		?>
        </div>
        <div id="clear"></div><br>
        <!--<input type="submit" value="MORE">-->
    </div>
</body>
</html>
<?php mysql_close($con); ?>