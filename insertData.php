<?php
include('function/session.php');
include('function/core.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DokTOR Justifikasi | Insert Data</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
  </head>

  <body class="skin-black">
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="dashboard.php" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            DokTOR Justifikasi
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span><?php echo $login_name ?><i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                <p>
                                    <?php echo $login_name ?>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="function/logout.php" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">

                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-table"></i>
                            <span>Data Dokumentasi</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="viewData.php"><i class="fa fa-angle-double-right"></i>Tampilkan Data</a></li>
                            <li><a href="insertData.php"><i class="fa fa-angle-double-right"></i>Masukkan Data</a></li>                            
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Data</li>
                    <li class="active">Masukkan Data</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div id="insertSuccess" class="alert alert-success alert-dismissable">                                        
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Success!</b> Data telah dimasukkan.
                </div>
                <div id="insertFailed" class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Failed!</b> Data gagal dimasukkan.
                </div>
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12"> 
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <section class="col-md-6 connectedSortable">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Insert Data</h3>
                                    </div>

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="cost_center">Cost Center</label>
                                            <input type="text" class="form-control" name="cost_center">
                                        </div>
                                        <div class="form-group">
                                            <label for="unit">Unit</label>
                                            <select class="form-control" name="unit">
                                                <option value="GA">GA</option>
                                                <option value="IPA">IPA</option>
                                                <option value="EPD">EPD</option>
                                                <option value="BPD">BPD</option>
                                                <option value="OPD">OPD</option>
                                                <option value="SPD">SPD</option>
                                                <option value="EPO">EPO</option>
                                                <option value="BPO">BPO</option>
                                                <option value="OPO">OPO</option>
                                                <option value="SPO">SPO</option>
                                                <option value="CIT">CIT</option>
                                            </select>                               
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_dokumen">Jenis Dokumen</label>                                            
                                            <select class="form-control" name="jenis_dokumen">
                                                <option value="OPEX">OPEX</option>
                                                <option value="CAPEX">CAPEX</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="program">Program / Kegiatan</label>
                                            <textarea name="program" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="col-md-6 connectedSortable">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Upload File</h3>
                                    </div>

                                    <div class="box-body">
                                        <span>Note: Ukuran maks file 10 mb</span>
                                        <div class="form-group">
                                            <label for="file_torjustifikasi">File TOR dan Justifikasi</label>
                                            <input type="file" class="form-control" name="file_torjustifikasi">
                                        </div>
                                        <div class="form-group">
                                            <label for="cost_center">File Purchase Release (PR)</label>
                                            <input type="file" class="form-control" name="file_pr">
                                        </div>
                                        <div class="form-group">
                                            <label for="cost_center">File Evaluasi</label>
                                            <input type="file" class="form-control" name="file_evaluasi">
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-flat" name="simpan">Submit</button>
                            </div>
                            
                        </form>
                        <?php
                        if(isset($_POST["simpan"]))
                        {
                            insertData($_POST['cost_center'], $_POST['unit'], $_POST['jenis_dokumen'], $_POST['program']);
                        }
                        ?>
                    </section><!-- /.Left col -->

                </div><!-- /.row (main row) -->

            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- add new calendar event modal -->


    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="js/AdminLTE/app.js" type="text/javascript"></script> 

</body>
</html>