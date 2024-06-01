  <?php 
  include '../koneksi.php';
  include '../config/initsoap.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "administrator_logedin"){
    header("location:../login.php?alert=belum_login");
  }
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo"$k_k[nama]";?></title>
	    <!-- Bootstrap 3.3.5 -->
		   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
       <link rel="stylesheet" href="../sys/bootstrap/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="../sys/bootstrap/font/css/font-awesome.min.css">
  <link rel="stylesheet" href="../sys/bootstrap/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../sys/bootstrap/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../sys/bootstrap/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../sys/bootstrap/dist/css/skins/_all-skins.min.css">
	<script src="../sys/bootstrap/plugins/ckeditor/ckeditor.js"></script> 
	<script src="../sys/bootstrap/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="js/jquery.form.js"></script>	

    <script src="../sys/bootstrap/bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../sys/bootstrap/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="../sys/bootstrap/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../sys/bootstrap/dist/js/demo.js"></script> 
     <style>
        #progressBar {
            height: 25px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        #progressBar .progress-bar {
            height: 100%;
            transition: width 0.3s ease;
        }

        #status {
            margin-top: 10px;
        }

        #loaded_n_total {
            margin-top: 5px;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.aspx" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>IMPEG</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><?php echo"$k_k[nama_app]";?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../foto/logo.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo"$k_k[nama_app]";?></span>
                </a>
               
              </li>
              <!-- Control Sidebar Toggle Button -->
        
        
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../foto/logo.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>SELAMAT DATANG</p>
              <a href="index.aspx"><i class="fa fa-circle text-success"></i><?php echo"$k_k[nama]";?></a>
            </div>
          </div>
          <!-- search form -->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php include "menu.php"?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel kua</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.aspx"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		 <?php include "tengah.php"?>
		  </div>
		  </section>
<!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="#">Almsaeed Studio / Web Progremer (<?php echo"$k_k[akabest]";?> )</a>.</strong>  All rights reserved.
      </footer>
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <script src="../sys/bootstrap/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../sys/bootstrap/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    <script>
		function ambilId(file){
			return document.getElementById(file);
		}

		$(document).ready(function(){
			$("#upload").click(function(){
				ambilId("progressBar").style.display = "block";
				var file = ambilId("file").files[0];
				var keterangan = ambilId("keterangan").value; // Ambil nilai keterangan
				var id_pegawai = ambilId("id_pegawai").value; // Ambil nilai id_buktidokumen

				if (file!="") {
					var formdata = new FormData();
					formdata.append("file", file);
					formdata.append("keterangan", keterangan); // Tambahkan keterangan ke FormData
					formdata.append("id_pegawai", id_pegawai); // Tambahkan keterangan ke FormData
					var ajax = new XMLHttpRequest();
					ajax.upload.addEventListener("progress", progressHandler, false);
					ajax.addEventListener("load", completeHandler, false);
					ajax.addEventListener("error", errorHandler, false);
					ajax.addEventListener("abort", abortHandler, false);
					ajax.open("POST", "input.php?aksi=prosesuploaddokumen");
					ajax.send(formdata);
				}
			});
		});

		function progressHandler(event){
			ambilId("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
			var percent = (event.loaded / event.total) * 100;
			ambilId("progressBar").value = Math.round(percent);
			ambilId("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
		}
		function completeHandler(event){
			ambilId("status").innerHTML = event.target.responseText;
			ambilId("progressBar").value = 0;
		}
		function errorHandler(event){
			ambilId("status").innerHTML = "Upload Failed";
		}
		function abortHandler(event){
			ambilId("status").innerHTML = "Upload Aborted";
		}
	</script>
  </body>
</html>
