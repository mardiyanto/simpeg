<?php 
  include '../koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "pegawai"){
    header("location:../index.php?alert=belum_login");
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

	<script src="../sys/bootstrap/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../sys/bootstrap/bootstrap/js/bootstrap.min.js"></script>
                <!-- map api start -->
            <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
    <link
      href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css"
      rel="stylesheet"
    />
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet"  href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css"/>
    <style>
      body {
        margin: 0;
        padding: 0;
      }
      #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
      }
    </style>


  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.aspx" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>WY</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">SIMPEG</span>
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
                  <span class="hidden-xs">SIMPEG</php> </span>
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
              <a href="index.aspx"><i class="fa fa-circle text-success"></i><?php echo"$_SESSION[nama_pegawai]"; ?></a>
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
<?php  echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI 
                            </div>
                            <div class='panel-body'>
                            <div class='col-lg-6'>
                            <!-- Default Card Example -->
                            <div class='card mb-4'>
                                <div class='card-header'>
                                <h6 class='m-0 font-weight-bold text-primary'>Kamera</h6>
                                </div>
                                <div class='card-body'>
                                    <div class='text-center' id='my_camera'></div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-6'>
                        <!-- Basic Card Example -->
                        <div class='card shadow mb-4'>
             "; $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE id_pegawai=$_SESSION[id_pegawai] ");
            $tx=mysqli_fetch_array($tebaru);
            $id_pegawai = $_SESSION['id_pegawai'];
            // Melakukan kueri SQL untuk memeriksa apakah pegawai tersebut sudah absen hari ini
            $sql = mysqli_query($koneksi, "SELECT * FROM presensi_datang WHERE id_pegawai=$id_pegawai AND status_absensi_datang='datang' AND tanggal_absensi_datang=CURDATE()");
            $t = mysqli_fetch_array($sql);
                           echo" <div class='card-body'>
                                <form method='post' action='#' enctype='multipart/form-data'>
                                    <div class='form-group'>
                                        <label>Kode Kariawan</label>
                                        <input type='text' class='form-control' value='$tx[kode_pegawai]' name='kode_pegawai' id='kode_pegawai' readonly />
                                        <input type='hidden' class='form-control' value='pagi' id='status_absensi' name=status_absensi />";
                                                        // <label>Shiff Absensi</label>
                                                        // <select class='form-control select2' style='width: 100%;' id='status_absensi' name=status_absensi>
                                                        //     <option value='pagi' selected>--Pilih Shiff absensi--</option>
                                                        //     <option value='pagi'>pagi</option>
                                                        //     <option value='siang'>siang</option>
                                                        //     <option value='sore'>sore</option>
                                                        // </select><br>
                                                        echo"<label>Status Absensi</label>
                                                        <select class='form-control select2' style='width: 100%;' id='status_hadir' name=status_hadir>
                                                            <option value='hadir' selected>--Pilih status absensi--</option>
                                                            <option value='hadir'>hadir</option>
                                                            <option value='dinas luar'>dinas luar</option>
                                                            <option value='sakit'>sakit</option>
                                                        </select><br>
                                                        <label>Lokasi anda </label>
                                                           <input type='text' class='form-control' id='latitude' name='latitude' readonly/>
                                                           <label>Lokasi anda </label>
                                                           <input type='text' class='form-control' id='longitude' name='longitude' readonly/><br>";
                                                            if ($t) {
                echo "<button type='button'  class='btn btn-primary'>anda sudah absen datang hari ini </button>";
            } else {
                echo "<div class='modal-footer'>
                <button type='button' onClick='take_snapshot()' class='btn btn-primary'>Capture and Save </button>
            </div>";
            } 
                                        
                                   echo" </div>
                                </form>
                            </div>
                        </div>
                    </div>
            
                    <div class='col-lg-12'>
                        <div class='card mb-4'>
                            <div class='card-header'> 
                                Hasil Kamera
                            </div>
                            <div class='card-body'>
                                <div id='results'>Your captured image will appear here...</div>
                            </div>
                        </div>
                    </div>
                </div>
                            </div>
                        </div>
                    </div>
                   </div>		
        
          ";

    ?>

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
    <script type="text/javascript" src="../webcamjs-master/webcam.min.js"></script>
	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camera' );
	</script>
	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		// preload shutter audio clip
		var shutter = new Audio();
		shutter.autoplay = false;
		shutter.src = navigator.userAgent.match(/Firefox/) ? 'webcamjs-master/demos/shutter.ogg' : 'webcamjs-master/demos/shutter.mp3';
		
		function take_snapshot() {
        // play sound effect
        shutter.play();

        // take snapshot and get image data
        Webcam.snap(function (data_uri) {
            // display results in page
            document.getElementById('results').innerHTML =
                '<h2>Here is your image:</h2>' +
                '<img src="' + data_uri + '"/>';
                // Reload halaman setelah beberapa waktu (contoh: 3 detik)
                setTimeout(function() {
                    location.reload();
                }, 3000);
            // Get the ID Pegawai from the input field
            var kode_pegawai = document.getElementById('kode_pegawai').value;
            var status_absensi = document.getElementById('status_absensi').value;
            var status_hadir = document.getElementById('status_hadir').value;
            var latitude = document.getElementById('latitude').value;
            var longitude = document.getElementById('longitude').value;

            // Send the image data and ID Pegawai to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_image.php?aksi=datang', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    // Add any additional logic or response handling here
                }
            };

            // Encode the data URI and ID Pegawai and send it to the server
            xhr.send('image=' + encodeURIComponent(data_uri) + 
         '&kode_pegawai=' + encodeURIComponent(kode_pegawai) + 
         '&status_absensi=' + encodeURIComponent(status_absensi) +
         '&status_hadir=' + encodeURIComponent(status_hadir) +
         '&latitude=' + encodeURIComponent(latitude) +
         '&longitude=' + encodeURIComponent(longitude));
        });
    }
	</script>
     <script>
      mapboxgl.accessToken = 'pk.eyJ1IjoiaXRyc2thcnRpbmkiLCJhIjoiY2xpd2lqbDMwMzlrMjNsbGd3c3dnY3Q1ZSJ9.eFCToH4luPNjPxsxM6_kkg';

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const { latitude, longitude } = position.coords;

            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;

            const map = new mapboxgl.Map({
              container: 'map',
              style: 'mapbox://styles/mapbox/streets-v12',
              center: [longitude, latitude],
              zoom: 12,
            });

            const marker = new mapboxgl.Marker().setLngLat([longitude, latitude]).addTo(map);

            const geocoder = new MapboxGeocoder({
              accessToken: mapboxgl.accessToken,
              mapboxgl: mapboxgl,
            });

            map.addControl(geocoder);

            geocoder.on('result', (event) => {
              map.getSource('single-point').setData(event.result.geometry);
            });
          },
          (error) => {
            console.log('Error getting current location:', error);
          }
        );
      } else {
        console.log('Geolocation is not supported by this browser.');
      }
    </script>
        <!-- map api edb -->
  </body>
</html>
