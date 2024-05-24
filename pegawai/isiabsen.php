<?php
if($_GET['aksi']=='absensi'){
    echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI</div>
                            <div class='row'>
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
                <div class='card-header py-3'>
                    <h6 class='m-0 font-weight-bold text-primary'>Isikan Kode Kariawan</h6>
                </div>"; $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE id_pegawai=$_SESSION[id_pegawai] ");
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
                                            <label>Shiff Absensi</label>
                                            <select class='form-control select2' style='width: 100%;' id='status_absensi' name=status_absensi>
                                                <option value='pagi' selected>--Pilih Shiff absensi--</option>
                                                <option value='pagi'>pagi</option>
                                                <option value='siang'>siang</option>
                                                <option value='sore'>sore</option>
                                            </select><br>
                                            <label>Status Absensi</label>
                                            <select class='form-control select2' style='width: 100%;' id='status_hadir' name=status_hadir>
                                                <option value='hadir' selected>--Pilih status absensi--</option>
                                                <option value='hadir'>hadir</option>
                                                <option value='dinas luar'>dinas luar</option>
                                                <option value='sakit'>sakit</option>
                                            </select><br>
                                            <label>Lokasi anda </label>
                                               <input type='text' class='form-control' id='latitude' name='latitude' readonly/>
                                               <label>Lokasi anda </label>
                                               <input type='text' class='form-control' id='longitude' name='longitude' readonly/>";
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
        </div>";
}
elseif($_GET['aksi']=='absensi2'){
    echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI</div>
                        </div>
                    </div>
        </div>";
}
?>