<?php
	include('database.php');
	
	session_start();
	
	$username=$_SESSION['login_user'];
	
	$query=mysqli_query($con, "SELECT * FROM user WHERE username='".$username."'");
	$row=mysqli_fetch_assoc($query);
	
	$login_username = $row['username'];
	$login_name = $row['nama'];
	$login_email = $row['email'];
	
	if(!isset($_SESSION['login_user'])){
    	header("Location: index.php");
  	}
?>