<?php
	session_start();
	unset($_SESSION['name']);
	unset($_SESSION['username']);
	unset($_SESSION['responsibility']);
	session_destroy();
	header("location:login.php");
?>
