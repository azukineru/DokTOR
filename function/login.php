<?php

include("database.php");

session_start();
$error = '';

if(isset($_POST['login']))
{
	if(empty($_POST['username']) || empty($_POST['password']))
	{
		$error = '<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>Username atau Password salah!</b>
		</div>';
	}
	else
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		$username = mysqli_real_escape_string($con, $username);
		$password = md5(mysqli_real_escape_string($con, $password))	;

		$query = mysqli_query($con, "SELECT * FROM user WHERE username='".$username."' AND password='".$password."' ");

		if(mysqli_num_rows($query)==1)
		{
			$_SESSION['login_user'] = $username;
			if(!empty($_POST["remember"]))
			{
				setcookie("member_login", $_POST["username"], time() + (10 * 365 * 24 * 60 * 60));
				setcookie("member_password", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
			}
			else
			{
				if(isset($_COOKIE["member_login"]))
				{
					setcookie("member_login");
				}
				if(isset($_COOKIE["member_password"]))
				{
					setcookie("member_password");
				}
			}
			header("Location:dashboard.php");
		}
		else
		{
			$error = '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<b>Username atau Password salah!</b>
			</div>';
		}
		mysqli_close($con);
	}
}

?>