
  <?php // Query SQL untuk menghitung total baris dalam tabel pegawai
$query = "SELECT COUNT(*) as total FROM pegawai";
// Jalankan query
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
 // Total baris dalam tabel pegawai
$total_pegawai = $row['total'];
?>
<?php
// Mendapatkan tanggal hari ini
$today = date("Y-m-d");
// Query SQL untuk menghitung total presensi datang berdasarkan tanggal absensi datang hari ini
$querydatang = "SELECT COUNT(*) as total FROM presensi_datang WHERE tanggal_absensi_datang = '$today' AND status_absensi_datang = 'datang'";
// Jalankan query
$result = $koneksi->query($querydatang);
$rowdatang = $result->fetch_assoc();

$total_presensi_datang = $rowdatang['total'];
// Query SQL untuk menghitung total presensi pulang berdasarkan tanggal absensi pulang hari ini
$querypulang= "SELECT COUNT(*) as total FROM presensi_pulang WHERE tanggal_absensi_pulang = '$today' AND status_absensi_pulang = 'pulang'";
// Jalankan query
$result = $koneksi->query($querypulang);
$rowpulang = $result->fetch_assoc();
 // Total presensi pulang berdasarkan tanggal absensi hari ini
$total_presensi_pulang = $rowpulang['total'];
$total_presensi = $total_presensi_datang + $total_presensi_pulang;
$total = $total_presensi -$total_presensi_datang;
?>
  <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo"$total_pegawai" ?></h3>
                  <p>Total Pegawai</p>
                </div>
                <div class="icon">
                  <i class="fa fa-bag"></i>
                </div>
                <a href="index.php?aksi=pegawai" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo"$total_presensi_datang" ?></h3>
                  <p>Total Presensi Datang</p>
                </div>
                <div class="icon">
                  <i class="fa fa-stats-bars"></i>
                </div>
                <a href="index.php?aksi=presensidatang" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo"$total_presensi_pulang" ?></h3>
                  <p>Total Presensi Pulang</p>
                </div>
                <div class="icon">
                  <i class="fa fa-person-add"></i>
                </div>
                <a href="index.php?aksi=presensipulang" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo"$total" ?></h3>
                  <p>Total Presensi</p>
                </div>
                <div class="icon">
                  <i class="fa fa-pie-graph"></i>
                </div>
                <a href="index.php?aksi=rekappresensi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
