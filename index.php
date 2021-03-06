<?php
include('function/login.php');

if(isset($_SESSION['login_user']))
{
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html class="bg-navy">
<head>
    <meta charset="UTF-8">
    <title>DokTOR Justifikasi | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
  </head>
  <body class="bg-navy">
    <div class="col-md-12">
        <br>
        <h3 class="box-title text-center">Dokumentasi TOR dan Justifikasi</h3>
    </div>
    <div class="form-box" id="login-box">
        <div class="header">Sign In</div>
        <form action="" method="post">
            <div class="body bg-gray">
                <div><?php echo $error; ?></div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" required/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" required/>
                </div>          
                <div class="form-group">                        
                    <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> /> Remember me
                    <button type="submit" class="btn bg-olive btn-block" value="login" name="login">Sign me in</button>  
                </div>
            </div>
        </form>
    </div>

    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>        

</body>
</html>