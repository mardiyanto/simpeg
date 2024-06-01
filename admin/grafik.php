<link rel="stylesheet" href="../sys/bootstrap/plugins/morris/morris.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <?php // Query SQL untuk menghitung total baris dalam tabel pegawai
$query = "SELECT COUNT(*) as total FROM pegawai";
// Jalankan query
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
 // Total baris dalam tabel pegawai
$total_pegawai = $row['total'];

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

$sql = "SELECT nama_pegawai, tgl_lahir FROM pegawai";
$result = $koneksi->query($sql);
$jumlah_ulang_tahun = 0;
$today = new DateTime();
while ($row = $result->fetch_assoc()) {
    $nama_pegawai = $row['nama_pegawai'];
    $tgl_lahir = $row['tgl_lahir'];
     // Hitung usia
     $birthDate = new DateTime($tgl_lahir);
     $usia = $birthDate->diff($today)->y;

     // Check if today is the birthday
     if ($birthDate->format('m-d') == $today->format('m-d')) {
         $jumlah_ulang_tahun++;
     }
}
// Ambil jumlah pegawai perempuan dan laki-laki
$sql_perempuan = "SELECT COUNT(*) as total_perempuan FROM pegawai WHERE jenis_kelamin = 'Perempuan'";
$sql_laki_laki = "SELECT COUNT(*) as total_laki_laki FROM pegawai WHERE jenis_kelamin = 'Laki-laki'";

$result_perempuan = $koneksi->query($sql_perempuan);
$result_laki_laki = $koneksi->query($sql_laki_laki);

$total_perempuan = 0;
$total_laki_laki = 0;

if ($result_perempuan->num_rows > 0) {
    $row = $result_perempuan->fetch_assoc();
    $total_perempuan = $row['total_perempuan'];
}

if ($result_laki_laki->num_rows > 0) {
    $row = $result_laki_laki->fetch_assoc();
    $total_laki_laki = $row['total_laki_laki'];
}
// Ambil tanggal hari ini
$tanggal_hari_ini = date('Y-m-d');
// Query untuk menghitung jumlah pegawai lebih dari 45 tahun
$sql_lebih_dari_45 = "SELECT COUNT(*) as total_lebih_dari_45 
                      FROM pegawai 
                      WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF('$tanggal_hari_ini', tgl_lahir)), '%Y') + 0 > 45";
// Query untuk menghitung jumlah pegawai kurang dari 45 tahun
$sql_kurang_dari_45 = "SELECT COUNT(*) as total_kurang_dari_45 
                       FROM pegawai 
                       WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF('$tanggal_hari_ini', tgl_lahir)), '%Y') + 0 < 45";
$result_lebih_dari_45 = $koneksi->query($sql_lebih_dari_45);
$result_kurang_dari_45 = $koneksi->query($sql_kurang_dari_45);

$total_lebih_dari_45 = 0;
$total_kurang_dari_45 = 0;
if ($result_lebih_dari_45->num_rows > 0) {
    $row = $result_lebih_dari_45->fetch_assoc();
    $total_lebih_dari_45 = $row['total_lebih_dari_45'];
}
if ($result_kurang_dari_45->num_rows > 0) {
    $row = $result_kurang_dari_45->fetch_assoc();
    $total_kurang_dari_45 = $row['total_kurang_dari_45'];
}
// Query untuk menghitung jumlah pegawai jenis Dosen
$sql_dosen = "SELECT COUNT(*) as total_dosen FROM pegawai WHERE jenis_pegawai = 'Dosen'";
// Query untuk menghitung jumlah pegawai jenis Tenaga Pendidik
$sql_tenaga_pendidik = "SELECT COUNT(*) as total_tenaga_pendidik FROM pegawai WHERE jenis_pegawai = 'Tenaga Kependidikan'";
$sql_tenaga_pendidik_dosen = "SELECT COUNT(*) as total_tenaga_pendidik_dosen FROM pegawai WHERE jenis_pegawai = 'Tenaga Kependidikan dan Dosen'";
$result_dosen = $koneksi->query($sql_dosen);
$result_tenaga_pendidik = $koneksi->query($sql_tenaga_pendidik);
$result_tenaga_pendidik_dosen = $koneksi->query($sql_tenaga_pendidik_dosen);

$total_dosen = 0;
$total_tenaga_pendidik = 0;

if ($result_dosen->num_rows > 0) {
    $row = $result_dosen->fetch_assoc();
    $total_dosen = $row['total_dosen'];
}

if ($result_tenaga_pendidik->num_rows > 0) {
    $row = $result_tenaga_pendidik->fetch_assoc();
    $total_tenaga_pendidik = $row['total_tenaga_pendidik'];
}
if ($result_tenaga_pendidik_dosen->num_rows > 0) {
  $row = $result_tenaga_pendidik_dosen->fetch_assoc();
  $total_tenaga_pendidik_dosen = $row['total_tenaga_pendidik_dosen'];
}
?>
  <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo"$total_laki_laki" ?></h3>
                  <p>Total Pegawai Laki-laki</p>
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
                  <h3><?php echo"$total_perempuan" ?></h3>
                  <p>Total Pegawai Perempuan</p>
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
                  <h3><?php echo"$total_presensi_datang" ?></h3>
                  <p>Total Presensi Datang</p>
                </div>
                <div class="icon">
                  <i class="fa fa-person-add"></i>
                </div>
                <a href="index.php?aksi=presensidatang" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                  <h3><?php echo"$jumlah_ulang_tahun" ?></h3>
                  <p>Pegawai Ulang Tahun</p>
                </div>
                <div class="icon">
                  <i class="fa fa-stats-bars"></i>
                </div>
                <a href="index.php?aksi=ulangtahun" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                  <h3><?php echo"$total_lebih_dari_45" ?></h3>
                  <p>Pegawai Lebih dari 45 Tahun</p>
                </div>
                <div class="icon">
                  <i class="fa fa-pie-graph"></i>
                </div>
                <a href="index.php?aksi=rekappresensi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo"$total_kurang_dari_45" ?></h3>
                  <p>Pegawai Kurang dari 45 Tahun</p>
                </div>
                <div class="icon">
                  <i class="fa fa-stats-bars"></i>
                </div>
                <a href="index.php?aksi=ulangtahun" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo"$total_dosen" ?></h3>
                  <p>Total Pegawai Dosen</p>
                </div>
                <div class="icon">
                  <i class="fa fa-bag"></i>
                </div>
                <a href="index.php?aksi=pegawai" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo"$total_tenaga_pendidik" ?></h3>
                  <p>Total Pegawai Tenaga Pendidik</p>
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
                  <h3><?php echo"$total_tenaga_pendidik_dosen" ?></h3>
                  <p>Pegawai Tenaga Kependidikan dan Dosen</p>
                </div>
                <div class="icon">
                  <i class="fa fa-pie-graph"></i>
                </div>
                <a href="index.php?aksi=rekappresensi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <div class="row">
            <div class='col-md-12'>
  
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Line Chart</h3>
                  <div class='box-tools pull-right'>
                    <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    <button class='btn btn-box-tool' data-widget='remove'><i class='fa fa-times'></i></button>
                  </div>
                </div>
                <div class='box-body chart-responsive'>
                  <div class='chart' id='line-chart' style='height: 300px;'></div>
                </div>
              </div> 
              <!-- BAR CHART -->
              <div class='box box-success'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Bar Chart </h3>
                  <div class='box-tools pull-right'>
                    <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    <button class='btn btn-box-tool' data-widget='remove'><i class='fa fa-times'></i></button>
                  </div>
                </div>
                <div class='box-body chart-responsive'>
                  <div class='chart' id='bar-chart' style='height: 300px;'></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->
           <!-- Morris.js charts -->
           
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../sys/bootstrap/plugins/morris/morris.min.js"></script>
          <script>
      $(function () {
        "use strict";

        <?php 
$sqljam = "SELECT
    DATE_FORMAT(a.tanggal_absensi_datang, '%Y-%m') as bulan,
    SUM(CASE WHEN TIME(a.jam_absensi_datang) <= '08:00:00' THEN 1 ELSE 0 END) as hadir_tepat_waktu,
    SUM(CASE WHEN TIME(b.jam_absensi_pulang) >= '15:00:00' THEN 1 ELSE 0 END) as pulang_tepat_waktu
    FROM
    presensi_datang a
    JOIN presensi_pulang b ON a.tanggal_absensi_datang = b.tanggal_absensi_pulang
    GROUP BY
    DATE_FORMAT(a.tanggal_absensi_datang, '%Y-%m')
    ORDER BY
    bulan ASC
";

$resultjam = $koneksi->query($sqljam);

// Format data untuk Morris.js
$datajam = [];
while ($rowjam = $resultjam->fetch_assoc()) {
    $datajam[] = [
        'y' => $rowjam['bulan'],
        'a' => $rowjam['hadir_tepat_waktu'],
        'b' => $rowjam['pulang_tepat_waktu']
    ];
}
$json_data = json_encode($datajam);
?>

        // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: <?php echo"$json_data" ?>,
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Hadir Tepat Waktu', 'Pulang Tepat Waktu'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });

   
        //BAR CHART
        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: <?php echo"$json_data" ?>,
            barColors: ['#00a65a', '#f56954'],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Hadir Tepat Waktu', 'Pulang Tepat Waktu'],
            hideHover: 'auto'
        });
        
      });
    </script>