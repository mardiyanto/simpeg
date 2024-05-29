<?php
///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='home'){
    $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE id_pegawai=$_SESSION[id_pegawai] ");
    $t=mysqli_fetch_array($tebaru);
    $tanggal_awal = $t['mulai_kerja'];
// Tanggal akhir (asumsi tanggal saat ini)
$tanggal_akhir = date("Y-m-d");
// Mengonversi tanggal menjadi timestamp
$timestamp_awal = strtotime($tanggal_awal);
$timestamp_akhir = strtotime($tanggal_akhir);
// Menghitung selisih waktu dalam detik
$selisih_detik = $timestamp_akhir - $timestamp_awal;
// Mengonversi selisih waktu dari detik ke tahun
$lama_kerja_tahun = $selisih_detik / (60 * 60 * 24 * 365.25);
echo" 
<section class='content'>
<div class='row'>
  <div class='col-md-3'>

    <!-- Profile Image -->
    <div class='box box-primary'>
      <div class='box-body box-profile'>
        <img class='profile-user-img img-responsive img-circle' src='../foto/pegawai/$t[gambar]' alt='User profile picture'>
        <h3 class='profile-username text-center'>$t[nama_pegawai]</h3>
        <p class='text-muted text-center'>$t[jabatan_pegawai]</p>

        <ul class='list-group list-group-unbordered'>
          <li class='list-group-item'>
            <b>Mulai Kerja</b> <a class='pull-right'>$t[mulai_kerja]</a>
          </li>
          <li class='list-group-item'>
            <b>Jenis Kelamin</b> <a class='pull-right'>$t[jenis_kelamin]</a>
          </li>
          <li class='list-group-item'>
            <b>Status Pegawai</b> <a class='pull-right'>$t[status_pegawai]</a>
          </li>
        </ul>";
  // Melakukan kueri SQL untuk memeriksa apakah pegawai tersebut sudah absen hari ini
  $id_pegawai = $_SESSION['id_pegawai'];
// Melakukan kueri SQL untuk memeriksa apakah pegawai tersebut sudah absen pulang hari ini
$sqlxx = mysqli_query($koneksi, "SELECT * FROM presensi_pulang WHERE id_pegawai=$id_pegawai AND status_absensi_pulang='pulang' AND tanggal_absensi_pulang=CURDATE()");
$txx = mysqli_fetch_array($sqlxx);
// Melakukan kueri SQL untuk memeriksa apakah pegawai tersebut sudah absen datang hari ini
$sqltx = mysqli_query($koneksi, "SELECT * FROM presensi_datang WHERE id_pegawai=$id_pegawai AND status_absensi_datang='datang' AND tanggal_absensi_datang=CURDATE()");
$tpx = mysqli_fetch_array($sqltx);
if ($tpx) {
    if ($txx) {
        echo "<a href='#' class='btn btn-success btn-block'><b>Sudah Absen</b></a>";
    } else {
        echo "<a href='absenpulang.php' class='btn btn-primary btn-block'><b>ABSEN PULANG</b></a>";
    }
} else {
echo "<a href='absendatang.php' class='btn btn-primary btn-block'><b>ABSEN</b></a>";
} 

      echo"</div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- About Me Box -->
    <div class='box box-primary'>
      <div class='box-header with-border'>
        <h3 class='box-title'>About Me</h3>
      </div><!-- /.box-header -->
      <div class='box-body'>
        <strong><i class='fa fa-map-marker margin-r-5'></i>  alamat</strong>
        <p class='text-muted'>
        $t[alamat]
        </p>

        <hr>
        <strong><i class='fa fa-pencil margin-r-5'></i> Data</strong>
        <p>
          <span class='label label-danger'> $t[email]</span>
          <span class='label label-success'> $t[kode_pegawai]</span>
          <span class='label label-info'>$t[jenis_pegawai]</span>
          <span class='label label-warning'>"; echo "Lama kerja: " . number_format($lama_kerja_tahun, 2) . " tahun"; echo"</span>
        </p>

        <hr>

        <strong><i class='fa fa-file-text-o margin-r-5'></i> Penghargaan</strong>";
        $no=0;
         $sqllite=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='penghargaan' and id_pegawai='$_SESSION[id_pegawai]'");
        while ($sx=mysqli_fetch_array($sqllite)){	
            $no++;   
       echo" <p> $no . $sx[ket_riwayat]</p>";
        }
      echo"
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
  <div class='col-md-9'>
    <div class='nav-tabs-custom'>
      <ul class='nav nav-tabs'>
        <li class='active'><a href='#activity' data-toggle='tab'>Riwayat</a></li>
        <li><a href='#timeline' data-toggle='tab'>Penghargaan</a></li>
        <li><a href='#settings' data-toggle='tab'>Dokumen</a></li>
        <li><a href='#keluarga' data-toggle='tab'>Keluarga</a></li>
      </ul>
      <div class='tab-content'>

        <div class='active tab-pane' id='activity'>
        <div class='box-header with-border'>
        <h3 class='box-title'>Pendidikan</h3>
      </div><!-- /.box-header -->
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModal'>
        Tambah Data
    </button><br><br>
                        <table  class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th>No</th>
                                <th>Keterangan</th>
                                <th>aksi</th>		  
                        </tr></thead>
                <tbody>
                ";

                $no=0;
                $tebaru1=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='pendidikan' and id_pegawai='$_SESSION[id_pegawai]'");
                while ($x=mysqli_fetch_array($tebaru1)){	
                $no++;
                        echo"<tr>
                            <td>$no</td>
                                <td>$x[ket_riwayat]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModal$x[id_riwayat]'><i class='fa fa-pencil'></i>lihat</button>
                <a class='btn btn-info' href='hapus.php?aksi=hapusriwayat&id_riwayat=$x[id_riwayat]' onclick=\"return confirm ('Apakah yakin ingin menghapus $x[ket_riwayat] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
                </td>
                            </tr>
                            
                            <div class='modal fade' id='uiModal$x[id_riwayat]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        <h4 class='modal-title' id='H3'>Input Data </h4>
                                    </div>
                                    <div class='modal-body'>
                                    <form role='form' method='post' action='edit.php?aksi=proseseditriwayat&id_riwayat=$x[id_riwayat]'>
                                        <div class='form-group'>
                                        <label>Keterangan</label>
                                        <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'>$x[ket_riwayat] </textarea><br>
                                        <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        <button type='submit' class='btn btn-primary'>Save </button>
                                    </div>
                </form>
                                </div>
                            </div>
                        </div>
                </div>          
                            
                            ";
                }
                    echo"  </tbody>
                    </table>
                    <div class='modal fade' id='uiModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            <h4 class='modal-title' id='H3'>Input Data </h4>
        </div>
        <div class='modal-body'>
       <form role='form' method='post' action='input.php?aksi=inputriwayat'>
                                <div class='form-group'>
            <label>Keterangan</label>
            <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'></textarea><br>
            <input type='hidden' class='form-control'  value='pendidikan' name='jenis_riwayat'/><br>
            <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-primary'>Save </button>
                            </div>
        </form>
    </div>
</div>
</div>

        </div>   

        <div class='box-header with-border'>
        <h3 class='box-title'>Pekerjaan</h3>
      </div><!-- /.box-header -->
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalj'>
        Tambah Data
    </button><br><br>
                        <table  class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th>No</th>
                                <th>Keterangan</th>
                                <th>aksi</th>		  
                        </tr></thead>
                <tbody>
                ";

                $no=0;
                $tebaru2=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='pekerjaan' and id_pegawai='$_SESSION[id_pegawai]'");
                while ($j=mysqli_fetch_array($tebaru2)){	
                $no++;
                        echo"<tr>
                            <td>$no</td>
                                <td>$j[ket_riwayat]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModalj$j[id_riwayat]'><i class='fa fa-pencil'></i>lihat</button>
                <a class='btn btn-info' href='hapus.php?aksi=hapusriwayat&id_riwayat=$j[id_riwayat]' onclick=\"return confirm ('Apakah yakin ingin menghapus $j[ket_riwayat] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
                </td>
                            </tr>
                            
                            <div class='modal fade' id='uiModalj$j[id_riwayat]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        <h4 class='modal-title' id='H3'>Input Data </h4>
                                    </div>
                                    <div class='modal-body'>
                                    <form role='form' method='post' action='edit.php?aksi=proseseditriwayat&id_riwayat=$j[id_riwayat]'>
                                        <div class='form-group'>
                                        <label>Keterangan</label>
                                        <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'>$j[ket_riwayat] </textarea><br>
                                        <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        <button type='submit' class='btn btn-primary'>Save </button>
                                    </div>
                </form>
                                </div>
                            </div>
                        </div>
                </div>          
                            
                            ";
                }
                    echo"  </tbody>
                    </table>
                    <div class='modal fade' id='uiModalj' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            <h4 class='modal-title' id='H3'>Input Data </h4>
        </div>
        <div class='modal-body'>
       <form role='form' method='post' action='input.php?aksi=inputriwayat'>
                                <div class='form-group'>
            <label>Keterangan</label>
            <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'></textarea><br>
            <input type='hidden' class='form-control'  value='pekerjaan' name='jenis_riwayat'/><br>
            <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-primary'>Save </button>
                            </div>
        </form>
    </div>
</div>
</div>

        </div>   

        </div><!-- /.tab-pane -->

        <div class='tab-pane' id='timeline'>
        <div class='box-header with-border'>
        <h3 class='box-title'>Penghargaan</h3>
      </div><!-- /.box-header -->
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalpenghargaan'>
        Tambah Data
    </button><br><br>
                        <table  class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th>No</th>
                                <th>Keterangan</th>
                                <th>aksi</th>		  
                        </tr></thead>
                <tbody>
                ";

                $no=0;
                $sql=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='penghargaan' and id_pegawai='$_SESSION[id_pegawai]'");
                while ($s=mysqli_fetch_array($sql)){	
                $no++;
                        echo"<tr>
                            <td>$no</td>
                                <td>$s[ket_riwayat]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModalpenghargaan$s[id_riwayat]'><i class='fa fa-pencil'></i>lihat</button>
                <a class='btn btn-info' href='hapus.php?aksi=hapusriwayat&id_riwayat=$s[id_riwayat]' onclick=\"return confirm ('Apakah yakin ingin menghapus $x[ket_riwayat] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
                </td>
                            </tr>
                            
                            <div class='modal fade' id='uiModalpenghargaan$s[id_riwayat]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        <h4 class='modal-title' id='H3'>Input Data </h4>
                                    </div>
                                    <div class='modal-body'>
                                    <form role='form' method='post' action='edit.php?aksi=proseseditriwayat&id_riwayat=$s[id_riwayat]'>
                                        <div class='form-group'>
                                        <label>Keterangan</label>
                                        <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'>$s[ket_riwayat] </textarea><br>
                                        <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        <button type='submit' class='btn btn-primary'>Save </button>
                                    </div>
                </form>
                                </div>
                            </div>
                        </div>
                </div>          
                            
                            ";
                }
                    echo"  </tbody>
                    </table>
                    <div class='modal fade' id='uiModalpenghargaan' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            <h4 class='modal-title' id='H3'>Input Data </h4>
        </div>
        <div class='modal-body'>
       <form role='form' method='post' action='input.php?aksi=inputriwayat'>
                                <div class='form-group'>
            <label>Keterangan</label>
            <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'></textarea><br>
            <input type='hidden' class='form-control'  value='penghargaan' name='jenis_riwayat'/><br>
            <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-primary'>Save </button>
                            </div>
        </form>
    </div>
</div>
</div>

        </div> 
        </div><!-- /.tab-pane -->

        <div class='tab-pane' id='settings'>
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalupload'><i class='fa fa-cloud-upload'></i>Tambah Data</button>
        <table id='example1' class='table table-bordered table-striped'>
        <thead>
            <tr>
                <th>#</th>
                <th>nama</th>
                <th>keterangan</th>		  
            </tr>
        </thead>
";

$no=0;
$tql=mysqli_query($koneksi," SELECT * FROM dokumen WHERE id_pegawai=$_SESSION[id_pegawai]");
while ($q=mysqli_fetch_array($tql)){	
$no++;
        echo"<tbody>
            <tr>
                <td>$no</td>
    <td><a href='../foto/dokumen/$q[file_dokumen]' target='_blank'>$q[ket_dokumen]</a></td>
<td><a class='btn btn-info' href='hapus.php?aksi=hapusbuktidokumen&id_dokumen=$q[id_dokumen]&id_pegawai=$_SESSION[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $q[ket_dokumen] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a></td>
            </tr>
        </tbody>
        
                                 
        ";
}
    echo"</table>
    <div class='modal fade' id='uiModalupload' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
    <h4 class='modal-title' id='H3'>Data upload $t[nama_pegawai]</h4>
            </div>
            <div class='modal-body'>
            <form id='upload_form'>
                    <div class='form-group mb-5'>
                    <label>keterangan</label><br/>
                    <input type='text' name='keterangan'   id='keterangan' class='form-control'>
                    <input type='hidden' name='id_pegawai'   id='id_pegawai' value='$_SESSION[id_pegawai]' class='form-control'>
                </div>
                <div class='form-group mb-5'>
                    <label>Pilih File</label><br/>
                    <input type='file' name='file' id='file' class='form-control'>
                </div>
                
                <div class='form-group mb-5'>
                    <input type='button' id='upload' value='Upload File' class='btn btn-success'>
                </div>
            
                <progress id='progressBar' value='0' max='100' style='width:100%; display: none;'></progress>
                <h3 id='status'></h3>
                <p id='loaded_n_total'></p>
            </form>
            <div class='modal-footer'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          
          </div>
            </div>
        </div>
    </div>
</div>
        </div><!-- /.tab-pane -->
        <div class='tab-pane' id='keluarga'>
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalkeluarga'><i class='fa fa-cloud-upload'></i>Tambah Data</button>
        <table id='example1' class='table table-bordered table-striped'>
        <thead>
            <tr>
                <th>#</th>
                <th>nama</th>
                <th>Hubungan</th>		
                <th>hp</th>  
                <th>aksi</th>  
            </tr>
        </thead>
";

$no=0;
$keluarga=mysqli_query($koneksi," SELECT * FROM keluarga WHERE id_pegawai=$_SESSION[id_pegawai]");
while ($k=mysqli_fetch_array($keluarga)){	
$no++;
        echo"<tbody>
            <tr>
                <td>$no</td>
                <td>$k[nama_keluarga]</td>
                <td>$k[hubungan_keluarga]</td>
                <td>$k[no_hpkeluarga]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uieditkeluarga$k[id_keluarga]'><i class='fa fa fa-pencil'></i></button>
                <a class='btn btn-info' href='hapus.php?aksi=hapuskeluarga&id_keluarga=$k[id_keluarga]&id_pegawai=$_SESSION[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $k[nama_keluarga] ?')\" title='Hapus'><i class='fa fa-remove'></i></a>
                </td>
            </tr>
        </tbody>
        <div class='modal fade' id='uieditkeluarga$k[id_keluarga]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
    <h4 class='modal-title' id='H3'>Edit data $t[nama_pegawai]</h4>
            </div>
            <div class='modal-body'>
                <form role='form' method='post' action='edit.php?aksi=proseseditkeluarga&id_keluarga=$k[id_keluarga]'>
                                    <div class='form-group'>
                <label>Nama Keluarga</label>
                <input type='text' class='form-control' value='$k[nama_keluarga]' name='nama_keluarga'/><br>
                <label>Hubungan Keluarga</label>
                <input type='text' class='form-control'  value='$k[hubungan_keluarga]' name='hubungan_keluarga'/><br>
                <label>Kontak Darurat/HP</label>
                <input type='text' class='form-control'  value='$k[no_hpkeluarga]' name='no_hpkeluarga'/><br>
                <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                <button type='submit' class='btn btn-primary'>Save </button>
                </div>
            </form>
            <div class='modal-footer'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          
          </div>
            </div>
        </div>
    </div>
                                 
        ";
}
    echo"</table>
    <div class='modal fade' id='uiModalkeluarga' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
    <h4 class='modal-title' id='H3'>Tambah Data $t[nama_pegawai]</h4>
            </div>
            <div class='modal-body'>
                <form role='form' method='post' action='input.php?aksi=inputkeluarga'>
                                    <div class='form-group'>
                <label>Nama Keluarga</label>
                <input type='text' class='form-control' name='nama_keluarga'/><br>
                <label>Hubungan Keluarga</label>
                <input type='text' class='form-control'  name='hubungan_keluarga'/><br>
                <label>Kontak Darurat/HP</label>
                <input type='text' class='form-control'  name='no_hpkeluarga'/><br>
                <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                <button type='submit' class='btn btn-primary'>Save </button>
                </div>
            </form>
            <div class='modal-footer'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          
          </div>
            </div>
        </div>
    </div>
</div>
        </div><!-- /.tab-pane -->

      </div><!-- /.tab-content -->

    </div><!-- /.nav-tabs-custom -->
  </div><!-- /.col -->
</div><!-- /.row -->

</section><!-- /.content -->


";
}
elseif($_GET['aksi']=='ikon'){
include "../ikon.php";
}

elseif($_GET['aksi']=='pegawai'){
    echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI 
                            </div>
                            <div class='panel-body'>	
                                   <div class='table-responsive'>		
         <table id='example1' class='table table-bordered table-striped'>
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>aksi</th>			  
                                          </tr></thead>
                        <tbody>
                        ";
                
    $no=0;
    $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE id_pegawai=$_SESSION[id_pegawai]");
    while ($t=mysqli_fetch_array($tebaru)){	
    $no++;
                                        echo"<tr>
                                            <td>$no</td>
                                            <td>$t[nama_pegawai]</td>
                                            <td><a class='btn btn-info' href='index.php?aksi=detailpegawai&id_pegawai=$t[id_pegawai]'>$t[kode_pegawai]</a></td>
                                <td><button class='btn btn-info' data-toggle='modal' data-target='#ui$t[id_pegawai]'><i class='fa fa-pencil'></i>edit</button>
                                                   </td>
                                            </tr>
                                            <div class='modal fade' id='ui$t[id_pegawai]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                        <h4 class='modal-title' id='H3'>Input Data </h4>
                                                    </div>
                                                    <div class='modal-body'>
                                                       <form role='form' method='post' enctype='multipart/form-data' action='edit.php?aksi=proseseditpegawai&gb=$t[gambar]&id_pegawai=$t[id_pegawai]'>
                                                        <div class='form-group'>
                                                        <div class='form-group'>
                                                <label>NIP pegawai</label>
                                                <input type='text' class='form-control' value='$t[kode_pegawai]' name='kode_pegawai'/><br>
                                                <label>nama</label>
                                                <input type='text' class='form-control' value='$t[nama_pegawai]' name='nama_pegawai'/><br>
                                                <label>Nik</label>
                                                <input type='text' class='form-control' value='$t[nik]' name='nik'/><br>
                                                <label>Nomor Hp</label>
                                                <input type='text' class='form-control' value='$t[no_hp]'  name='no_hp'/><br>
                                                <label>Email</label>
                                                <input type='text' class='form-control' value='$t[email]' name='email'/><br>
                                                <label>Tempat Lahir pegawai</label>
                                                <input type='text' class='form-control' value='$t[tempat_lahir]' name='tempat_lahir'/><br>
                                                <label>Mulai Kerja</label>
                                                <input type='date' class='form-control' value='$t[mulai_kerja]' name='mulai_kerja'/><br>
                                                <label>Tanggal Lahir pegawai</label>
                                                <input type='date' class='form-control' value='$t[tgl_lahir]' name='tgl_lahir'/><br>
                                                <label>Jenis Kelamin</label>
                                                <select class='form-control select2' style='width: 100%;' name=jenis_kelamin>
                                                <option value='$t[jenis_kelamin]' selected>$t[jenis_kelamin]</option>
                                                <option value='Laki-Laki'>Laki-Laki</option>
                                                <option value='Perempuan'>Perempuan</option>
                                                </select><br></br>
                                                <label>Status Pegawai</label>
                                                <select class='form-control select2' style='width: 100%;' name=status_pegawai>
                                                    <option value='$t[status_pegawai]' selected>$t[status_pegawai]</option>
                                                    <option value='TETAP'>TETAP</option>
                                                    <option value='NO TETAP'>NO TETAP</option>
                                                </select><br><br>
                                                <label>Jenis Pegawai</label>
                                                <select class='form-control select2' style='width: 100%;' name=jenis_pegawai>
                                                    <option value='$t[jenis_pegawai]' selected>$t[jenis_pegawai]</option>
                                                    <option value='Dosen'>Dosen</option>
                                                    <option value='Kariawan'>Kariawan</option>
                                                </select><br><br>
                                                <label>Jabatan Pegawai</label>
                                                <select class='form-control select2' style='width: 100%;' name='jabatan_pegawai'>
                                                    <option value='$t[jabatan_pegawai]' selected>$t[jabatan_pegawai]</option>
                                                    <option value='Rektor'>Rektor</option>
                                                    <option value='Wakil Rektor'>Wakil Rektor</option>
                                                    <option value='Dekan'>Dekan</option>
                                                    <option value='Ketua Program Studi'>Ketua Program Studi</option>
                                                    <option value='Koordinator Akademik'>Koordinator Akademik</option>
                                                    <option value='Sekretaris Institut'>Sekretaris Institut</option>
                                                    <option value='Bendahara'>Bendahara</option>
                                                    <option value='Manajer SDM'>Manajer SDM</option>
                                                    <option value='Kepala Bagian Administrasi'>Kepala Bagian Administrasi</option>
                                                    <option value='Kepala Bagian IT'>Kepala Bagian IT</option>
                                                    <option value='Kepala Bagian Keamanan'>Kepala Bagian Keamanan</option>
                                                    <option value='Profesor'>Profesor</option>
                                                    <option value='Lektor Kepala'>Lektor Kepala</option>
                                                    <option value='Lektor'>Lektor</option>
                                                    <option value='Asisten Dosen'>Asisten Dosen</option>
                                                    <option value='Kepala Bagian Kemahasiswaan'>Kepala Bagian Kemahasiswaan</option>
                                                    <option value='Kepala Bagian Bimbingan dan Konseling'>Kepala Bagian Bimbingan dan Konseling</option>
                                                    <option value='Manajer Karir dan Alumni'>Manajer Karir dan Alumni</option>
                                                    <option value='Petugas Administrasi'>Petugas Administrasi</option>
                                                    <option value='Teknisi Laboratorium'>Teknisi Laboratorium</option>
                                                    <option value='Pustakawan'>Pustakawan</option>
                                                    <option value='Kepala Pusat Penelitian'>Kepala Pusat Penelitian</option>
                                                    <option value='Koordinator Proyek Penelitian'>Koordinator Proyek Penelitian</option>
                                                    <option value='Kepala Bagian Internasional'>Kepala Bagian Internasional</option>
                                                    <option value='Kepala Bagian Kewirausahaan'>Kepala Bagian Kewirausahaan</option>
                                                </select><br><br>

                                                <label>Alamat Lengkap</label>
                                                <textarea id='text-ckeditor' class='form-control' name='alamat'>$t[alamat]</textarea><br>
                                    <img  src='../foto/pegawai/$t[gambar]' alt='Preview Gambar' style='max-width: 200px; max-height: 200px;'></br>
                                    <label>Gambar</label>
                                    <input type='file'  class='form-control' name='gambar'/><br>
                                    
                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                        <button type='submit' class='btn btn-primary'>Save </button>
                                                    </div>
                                </form>
                                                </div>
                                            </div>
                                        </div>
                                </div>                   
                                            
                                            ";
    }
                                      echo"  </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>		
        
          ";			
    

    }
       
/////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='detailpegawai'){
    $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE id_pegawai=$_SESSION[id_pegawai] ");
    $t=mysqli_fetch_array($tebaru);
    $tanggal_awal = $t['mulai_kerja'];
// Tanggal akhir (asumsi tanggal saat ini)
$tanggal_akhir = date("Y-m-d");

// Mengonversi tanggal menjadi timestamp
$timestamp_awal = strtotime($tanggal_awal);
$timestamp_akhir = strtotime($tanggal_akhir);

// Menghitung selisih waktu dalam detik
$selisih_detik = $timestamp_akhir - $timestamp_awal;

// Mengonversi selisih waktu dari detik ke tahun
$lama_kerja_tahun = $selisih_detik / (60 * 60 * 24 * 365.25);
echo" 
<section class='content'>
<div class='row'>
  <div class='col-md-3'>

    <!-- Profile Image -->
    <div class='box box-primary'>
      <div class='box-body box-profile'>
        <img class='profile-user-img img-responsive img-circle' src='../foto/pegawai/$t[gambar]' alt='User profile picture'>
        <h3 class='profile-username text-center'>$t[nama_pegawai]</h3>
        <p class='text-muted text-center'>$t[jabatan_pegawai]</p>

        <ul class='list-group list-group-unbordered'>
          <li class='list-group-item'>
            <b>Mulai Kerja</b> <a class='pull-right'>$t[mulai_kerja]</a>
          </li>
          <li class='list-group-item'>
            <b>Jenis Kelamin</b> <a class='pull-right'>$t[jenis_kelamin]</a>
          </li>
          <li class='list-group-item'>
            <b>Status Pegawai</b> <a class='pull-right'>$t[status_pegawai]</a>
          </li>
        </ul>

        ";
        // Melakukan kueri SQL untuk memeriksa apakah pegawai tersebut sudah absen hari ini
        $id_pegawai = $_SESSION['id_pegawai'];
      // Melakukan kueri SQL untuk memeriksa apakah pegawai tersebut sudah absen pulang hari ini
      $sqlxx = mysqli_query($koneksi, "SELECT * FROM presensi_pulang WHERE id_pegawai=$id_pegawai AND status_absensi_pulang='pulang' AND tanggal_absensi_pulang=CURDATE()");
      $txx = mysqli_fetch_array($sqlxx);
      // Melakukan kueri SQL untuk memeriksa apakah pegawai tersebut sudah absen datang hari ini
      $sqltx = mysqli_query($koneksi, "SELECT * FROM presensi_datang WHERE id_pegawai=$id_pegawai AND status_absensi_datang='datang' AND tanggal_absensi_datang=CURDATE()");
      $tpx = mysqli_fetch_array($sqltx);
      if ($tpx) {
          if ($txx) {
              echo "<a href='#' class='btn btn-success btn-block'><b>Sudah Absen</b></a>";
          } else {
              echo "<a href='absenpulang.php' class='btn btn-primary btn-block'><b>ABSEN PULANG</b></a>";
          }
      } else {
      echo "<a href='absendatang.php' class='btn btn-primary btn-block'><b>ABSEN</b></a>";
      } 
      
            echo"
      </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- About Me Box -->
    <div class='box box-primary'>
      <div class='box-header with-border'>
        <h3 class='box-title'>About Me</h3>
      </div><!-- /.box-header -->
      <div class='box-body'>
        <strong><i class='fa fa-map-marker margin-r-5'></i>  alamat</strong>
        <p class='text-muted'>
        $t[alamat]
        </p>

        <hr>
        <strong><i class='fa fa-pencil margin-r-5'></i> Data</strong>
        <p>
          <span class='label label-danger'> $t[email]</span>
          <span class='label label-success'> $t[kode_pegawai]</span>
          <span class='label label-info'>$t[jenis_pegawai]</span>
          <span class='label label-warning'>"; echo "Lama kerja: " . number_format($lama_kerja_tahun, 2) . " tahun"; echo"</span>
        </p>

        <hr>

        <strong><i class='fa fa-file-text-o margin-r-5'></i> Penghargaan</strong>";
        $no=0;
         $sqllite=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='penghargaan' and id_pegawai='$_SESSION[id_pegawai]'");
        while ($sx=mysqli_fetch_array($sqllite)){	
            $no++;   
       echo" <p> $no . $sx[ket_riwayat]</p>";
        }
      echo"
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
  <div class='col-md-9'>
    <div class='nav-tabs-custom'>
      <ul class='nav nav-tabs'>
        <li class='active'><a href='#activity' data-toggle='tab'>Riwayat</a></li>
        <li><a href='#timeline' data-toggle='tab'>Penghargaan</a></li>
        <li><a href='#settings' data-toggle='tab'>Dokumen</a></li>
        <li><a href='#keluarga' data-toggle='tab'>Keluarga</a></li>
      </ul>
      <div class='tab-content'>

        <div class='active tab-pane' id='activity'>
        <div class='box-header with-border'>
        <h3 class='box-title'>Pendidikan</h3>
      </div><!-- /.box-header -->
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModal'>
        Tambah Data
    </button><br><br>
                        <table  class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th>No</th>
                                <th>Keterangan</th>
                                <th>aksi</th>		  
                        </tr></thead>
                <tbody>
                ";

                $no=0;
                $tebaru1=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='pendidikan' and id_pegawai='$_SESSION[id_pegawai]'");
                while ($x=mysqli_fetch_array($tebaru1)){	
                $no++;
                        echo"<tr>
                            <td>$no</td>
                                <td>$x[ket_riwayat]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModal$x[id_riwayat]'><i class='fa fa-pencil'></i>lihat</button>
                <a class='btn btn-info' href='hapus.php?aksi=hapusriwayat&id_riwayat=$x[id_riwayat]' onclick=\"return confirm ('Apakah yakin ingin menghapus $x[ket_riwayat] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
                </td>
                            </tr>
                            
                            <div class='modal fade' id='uiModal$x[id_riwayat]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        <h4 class='modal-title' id='H3'>Input Data </h4>
                                    </div>
                                    <div class='modal-body'>
                                    <form role='form' method='post' action='edit.php?aksi=proseseditriwayat&id_riwayat=$x[id_riwayat]'>
                                        <div class='form-group'>
                                        <label>Keterangan</label>
                                        <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'>$x[ket_riwayat] </textarea><br>
                                        <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        <button type='submit' class='btn btn-primary'>Save </button>
                                    </div>
                </form>
                                </div>
                            </div>
                        </div>
                </div>          
                            
                            ";
                }
                    echo"  </tbody>
                    </table>
                    <div class='modal fade' id='uiModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            <h4 class='modal-title' id='H3'>Input Data </h4>
        </div>
        <div class='modal-body'>
       <form role='form' method='post' action='input.php?aksi=inputriwayat'>
                                <div class='form-group'>
            <label>Keterangan</label>
            <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'></textarea><br>
            <input type='hidden' class='form-control'  value='pendidikan' name='jenis_riwayat'/><br>
            <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-primary'>Save </button>
                            </div>
        </form>
    </div>
</div>
</div>

        </div>   

        <div class='box-header with-border'>
        <h3 class='box-title'>Pekerjaan</h3>
      </div><!-- /.box-header -->
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalj'>
        Tambah Data
    </button><br><br>
                        <table  class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th>No</th>
                                <th>Keterangan</th>
                                <th>aksi</th>		  
                        </tr></thead>
                <tbody>
                ";

                $no=0;
                $tebaru2=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='pekerjaan' and id_pegawai='$_SESSION[id_pegawai]'");
                while ($j=mysqli_fetch_array($tebaru2)){	
                $no++;
                        echo"<tr>
                            <td>$no</td>
                                <td>$j[ket_riwayat]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModalj$j[id_riwayat]'><i class='fa fa-pencil'></i>lihat</button>
                <a class='btn btn-info' href='hapus.php?aksi=hapusriwayat&id_riwayat=$j[id_riwayat]' onclick=\"return confirm ('Apakah yakin ingin menghapus $j[ket_riwayat] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
                </td>
                            </tr>
                            
                            <div class='modal fade' id='uiModalj$j[id_riwayat]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        <h4 class='modal-title' id='H3'>Input Data </h4>
                                    </div>
                                    <div class='modal-body'>
                                    <form role='form' method='post' action='edit.php?aksi=proseseditriwayat&id_riwayat=$j[id_riwayat]'>
                                        <div class='form-group'>
                                        <label>Keterangan</label>
                                        <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'>$j[ket_riwayat] </textarea><br>
                                        <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        <button type='submit' class='btn btn-primary'>Save </button>
                                    </div>
                </form>
                                </div>
                            </div>
                        </div>
                </div>          
                            
                            ";
                }
                    echo"  </tbody>
                    </table>
                    <div class='modal fade' id='uiModalj' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            <h4 class='modal-title' id='H3'>Input Data </h4>
        </div>
        <div class='modal-body'>
       <form role='form' method='post' action='input.php?aksi=inputriwayat'>
                                <div class='form-group'>
            <label>Keterangan</label>
            <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'></textarea><br>
            <input type='hidden' class='form-control'  value='pekerjaan' name='jenis_riwayat'/><br>
            <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-primary'>Save </button>
                            </div>
        </form>
    </div>
</div>
</div>

        </div>   

        </div><!-- /.tab-pane -->

        <div class='tab-pane' id='timeline'>
        <div class='box-header with-border'>
        <h3 class='box-title'>Penghargaan</h3>
      </div><!-- /.box-header -->
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalpenghargaan'>
        Tambah Data
    </button><br><br>
                        <table  class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th>No</th>
                                <th>Keterangan</th>
                                <th>aksi</th>		  
                        </tr></thead>
                <tbody>
                ";

                $no=0;
                $sql=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='penghargaan' and id_pegawai='$_SESSION[id_pegawai]'");
                while ($s=mysqli_fetch_array($sql)){	
                $no++;
                        echo"<tr>
                            <td>$no</td>
                                <td>$s[ket_riwayat]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModalpenghargaan$s[id_riwayat]'><i class='fa fa-pencil'></i>lihat</button>
                <a class='btn btn-info' href='hapus.php?aksi=hapusriwayat&id_riwayat=$s[id_riwayat]' onclick=\"return confirm ('Apakah yakin ingin menghapus $x[ket_riwayat] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
                </td>
                            </tr>
                            
                            <div class='modal fade' id='uiModalpenghargaan$s[id_riwayat]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        <h4 class='modal-title' id='H3'>Input Data </h4>
                                    </div>
                                    <div class='modal-body'>
                                    <form role='form' method='post' action='edit.php?aksi=proseseditriwayat&id_riwayat=$s[id_riwayat]'>
                                        <div class='form-group'>
                                        <label>Keterangan</label>
                                        <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'>$s[ket_riwayat] </textarea><br>
                                        <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        <button type='submit' class='btn btn-primary'>Save </button>
                                    </div>
                </form>
                                </div>
                            </div>
                        </div>
                </div>          
                            
                            ";
                }
                    echo"  </tbody>
                    </table>
                    <div class='modal fade' id='uiModalpenghargaan' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            <h4 class='modal-title' id='H3'>Input Data </h4>
        </div>
        <div class='modal-body'>
       <form role='form' method='post' action='input.php?aksi=inputriwayat'>
                                <div class='form-group'>
            <label>Keterangan</label>
            <textarea id='text-ckeditor' class='form-control' name='ket_riwayat'></textarea><br>
            <input type='hidden' class='form-control'  value='penghargaan' name='jenis_riwayat'/><br>
            <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-primary'>Save </button>
                            </div>
        </form>
    </div>
</div>
</div>

        </div> 
        </div><!-- /.tab-pane -->

        <div class='tab-pane' id='settings'>
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalupload'><i class='fa fa-cloud-upload'></i>Tambah Data</button>
        <table id='example1' class='table table-bordered table-striped'>
        <thead>
            <tr>
                <th>#</th>
                <th>nama</th>
                <th>keterangan</th>		  
            </tr>
        </thead>
";

$no=0;
$tql=mysqli_query($koneksi," SELECT * FROM dokumen WHERE id_pegawai=$_SESSION[id_pegawai]");
while ($q=mysqli_fetch_array($tql)){	
$no++;
        echo"<tbody>
            <tr>
                <td>$no</td>
                <td><a href='../foto/dokumen/$q[file_dokumen]' target='_blank'>$q[ket_dokumen]</a></td>
                <td><a class='btn btn-info' href='hapus.php?aksi=hapusbuktidokumen&id_dokumen=$q[id_dokumen]&id_pegawai=$_SESSION[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $q[ket_dokumen] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a></td>
                            </tr>
        </tbody>
        
                                 
        ";
}
    echo"</table>
    <div class='modal fade' id='uiModalupload' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
    <h4 class='modal-title' id='H3'>Data upload $t[nama_pegawai]</h4>
            </div>
            <div class='modal-body'>
            <form id='upload_form'>
                    <div class='form-group mb-5'>
                    <label>keterangan</label><br/>
                    <input type='text' name='keterangan'   id='keterangan' class='form-control'>
                    <input type='hidden' name='id_pegawai'   id='id_pegawai' value='$_SESSION[id_pegawai]' class='form-control'>
                </div>
                <div class='form-group mb-5'>
                    <label>Pilih File</label><br/>
                    <input type='file' name='file' id='file' class='form-control'>
                </div>
                
                <div class='form-group mb-5'>
                    <input type='button' id='upload' value='Upload File' class='btn btn-success'>
                </div>
            
                <progress id='progressBar' value='0' max='100' style='width:100%; display: none;'></progress>
                <h3 id='status'></h3>
                <p id='loaded_n_total'></p>
            </form>
            <div class='modal-footer'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          
          </div>
            </div>
        </div>
    </div>
</div>
        </div><!-- /.tab-pane -->
        <div class='tab-pane' id='keluarga'>
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalkeluarga'><i class='fa fa-cloud-upload'></i>Tambah Data</button>
        <table id='example1' class='table table-bordered table-striped'>
        <thead>
            <tr>
                <th>#</th>
                <th>nama</th>
                <th>Hubungan</th>		
                <th>hp</th>  
                <th>aksi</th>  
            </tr>
        </thead>
";

$no=0;
$keluarga=mysqli_query($koneksi," SELECT * FROM keluarga WHERE id_pegawai=$_SESSION[id_pegawai]");
while ($k=mysqli_fetch_array($keluarga)){	
$no++;
        echo"<tbody>
            <tr>
                <td>$no</td>
                <td>$k[nama_keluarga]</td>
                <td>$k[hubungan_keluarga]</td>
                <td>$k[no_hpkeluarga]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uieditkeluarga$k[id_keluarga]'><i class='fa fa fa-pencil'></i></button>
                <a class='btn btn-info' href='hapus.php?aksi=hapuskeluarga&id_keluarga=$k[id_keluarga]&id_pegawai=$_SESSION[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $k[nama_keluarga] ?')\" title='Hapus'><i class='fa fa-remove'></i></a>
                </td>
            </tr>
        </tbody>
        <div class='modal fade' id='uieditkeluarga$k[id_keluarga]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
    <h4 class='modal-title' id='H3'>Edit data $t[nama_pegawai]</h4>
            </div>
            <div class='modal-body'>
                <form role='form' method='post' action='edit.php?aksi=proseseditkeluarga&id_keluarga=$k[id_keluarga]'>
                                    <div class='form-group'>
                <label>Nama Keluarga</label>
                <input type='text' class='form-control' value='$k[nama_keluarga]' name='nama_keluarga'/><br>
                <label>Hubungan Keluarga</label>
                <input type='text' class='form-control'  value='$k[hubungan_keluarga]' name='hubungan_keluarga'/><br>
                <label>Kontak Darurat/HP</label>
                <input type='text' class='form-control'  value='$k[no_hpkeluarga]' name='no_hpkeluarga'/><br>
                <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                <button type='submit' class='btn btn-primary'>Save </button>
                </div>
            </form>
            <div class='modal-footer'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          
          </div>
            </div>
        </div>
    </div>
                                 
        ";
}
    echo"</table>
    <div class='modal fade' id='uiModalkeluarga' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
    <h4 class='modal-title' id='H3'>Tambah Data $t[nama_pegawai]</h4>
            </div>
            <div class='modal-body'>
                <form role='form' method='post' action='input.php?aksi=inputkeluarga'>
                                    <div class='form-group'>
                <label>Nama Keluarga</label>
                <input type='text' class='form-control' name='nama_keluarga'/><br>
                <label>Hubungan Keluarga</label>
                <input type='text' class='form-control'  name='hubungan_keluarga'/><br>
                <label>Kontak Darurat/HP</label>
                <input type='text' class='form-control'  name='no_hpkeluarga'/><br>
                <input type='hidden' class='form-control'  value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>

                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                <button type='submit' class='btn btn-primary'>Save </button>
                </div>
            </form>
            <div class='modal-footer'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          
          </div>
            </div>
        </div>
    </div>
</div>
        </div><!-- /.tab-pane -->

      </div><!-- /.tab-content -->

    </div><!-- /.nav-tabs-custom -->
  </div><!-- /.col -->
</div><!-- /.row -->

</section><!-- /.content -->


";
}
elseif($_GET['aksi']=='kerja'){
    echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI 
                            </div>
                            
                            <div class='panel-body'>
                            <button class='btn btn-info' data-toggle='modal' data-target='#uiModal'>
                                    Tambah Data
                                </button><br><br>	
                                   <div class='table-responsive'>		
         <table id='example1' class='table table-bordered table-striped'>
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>aksi</th>			  
                                          </tr></thead>
                        <tbody>
                        ";
                
    $no=0;
    $tebaru=mysqli_query($koneksi," SELECT * FROM uraiankerja WHERE id_pegawai=$_SESSION[id_pegawai] order by id_uraiankerja desc");
    while ($t=mysqli_fetch_array($tebaru)){	
    $no++;
                                        echo"<tr>
                                            <td>$no</td>
                                            <td>$_SESSION[nama_pegawai]</td>
                                            <td>$t[ket_uraiankerja]</td>
                                            <td><button class='btn btn-info btn-sm' data-toggle='modal' data-target='#ui$t[id_uraiankerja]'><i class='fa fa-pencil'></i></button>
                                            <a class='btn btn-info btn-sm' href='hapus.php?aksi=hapuskerja&id_uraiankerja=$t[id_uraiankerja]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[ket_uraiankerja] ?')\" title='Hapus'><i class='fa fa-remove'></i></a>
                                            </td>
                                            </tr>
                                            <div class='modal fade' id='ui$t[id_uraiankerja]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                        <h4 class='modal-title' id='H3'>Input Data </h4>
                                                    </div>
                                                    <div class='modal-body'>
                                                       <form role='form' method='post' enctype='multipart/form-data' action='edit.php?aksi=proseseditkerja&gb=$t[foto_uraiankerja]&id_uraiankerja=$t[id_uraiankerja]'>
                                                        <div class='form-group'>
                                                <input type='hidden' class='form-control' value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>
                                                <label>Uraian Kerja Lengkap</label>
                                                <textarea id='text-ckeditor' class='form-control' name='ket_uraiankerja'>$t[ket_uraiankerja]</textarea><br>
                                    <img  src='../foto/kerja/$t[foto_uraiankerja]' alt='Preview Gambar' style='max-width: 200px; max-height: 200px;'></br>
                                    <label>Gambar</label>
                                    <input type='file'  class='form-control' name='gambar'/><br>
                                    
                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                        <button type='submit' class='btn btn-primary'>Save </button>
                                                    </div>
                                </form>
                                                </div>
                                            </div>
                                        </div>
                                </div>                   
                                            
                                            ";
    }
                                      echo"  </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>		
        
          ";
          ////////////////input admin			
    
    echo"			
    <div class='col-lg-12'>
                            <div class='modal fade' id='uiModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                <h4 class='modal-title' id='H3'>Input Data </h4>
                                            </div>
                                            <div class='modal-body'>
                                               <form role='form' method='post' enctype='multipart/form-data' action='input.php?aksi=inputkerja'>
                                                <div class='form-group'>
                                                <input type='hidden' class='form-control'value='$_SESSION[id_pegawai]'  name='id_pegawai'/><br>                                               
                                                <label>Uraian Kerja Lengkap</label>
                                                <textarea id='text-ckeditor' class='form-control' name='ket_uraiankerja'></textarea><br>
                                                <label>foto</label>
                                                <input type='file'  class='form-control' name='gambar'/><br>
                            
                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                <button type='submit' class='btn btn-primary'>Save </button>
                                            </div>
                        </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </div>			
    "; 			
    }
elseif($_GET['aksi']=='cuti'){
    echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI 
                            </div>
                            
                            <div class='panel-body'>
                            <button class='btn btn-info' data-toggle='modal' data-target='#uiModal'>
                                    Tambah Data
                                </button><br><br>	
                                   <div class='table-responsive'>		
         <table id='example1' class='table table-bordered table-striped'>
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>lama cuti</th>
                                            <th>aksi</th>			  
                                          </tr></thead>
                        <tbody>
                        ";
                
    $no=0;
    $tebaru=mysqli_query($koneksi," SELECT * FROM cuti_pegawai WHERE id_pegawai=$_SESSION[id_pegawai] order by id_cuti desc");
    while ($t=mysqli_fetch_array($tebaru)){	
    // Tanggal awal dan akhir cuti
$tgl_input = date('Y-m-d', strtotime($t['tgl_input']));
$tanggalAwal = $t['tgl_awal'];
$tanggalAkhir = $t['tgl_akhir'];
// Membuat objek DateTime dari tanggal awal dan akhir
$dateAwal = new DateTime($tanggalAwal);
$dateAkhir = new DateTime($tanggalAkhir);
// Menghitung selisih antara tanggal awal dan akhir
$interval = $dateAwal->diff($dateAkhir);
// Menambahkan 1 hari karena perhitungan termasuk hari awal dan akhir
$lamaCuti = $interval->days + 1;
// Menampilkan hasil 
    $no++;
                                        echo "<tr>
                                            <td>$no</td>
                                            <td>$_SESSION[nama_pegawai]</td>
                                            <td>$t[ket_cuti]</td>
                                            <td>$lamaCuti hari</td>
                                            <td>";
                                            if (date('Y-m-d') == $tgl_input) {
                                                echo "<button class='btn btn-info btn-sm' data-toggle='modal' data-target='#ui$t[id_cuti]'><i class='fa fa-pencil'></i></button>";
                                            } else {
                                                echo "<button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#uibatal$t[id_cuti]'><i class='fa fa-ban'></i></button>";
                                            }
                                            echo "</td>
                                            </tr>
                                            <div class='modal fade' id='ui$t[id_cuti]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                            <h4 class='modal-title' id='H3'>Input Data</h4>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <form role='form' method='post' enctype='multipart/form-data' action='edit.php?aksi=proseseditcuti&id_cuti=$t[id_cuti]'>
                                                                <div class='form-group'>
                                                                    <input type='hidden' class='form-control' value='$_SESSION[id_pegawai]' name='id_pegawai'/>
                                                                    <label>Perkiraan Lama Cuti</label>
                                                                    <input type='text' class='form-control' value='$t[lama_cuti]' name='lama_cuti'/>
                                                                    <label>Tanggal Awal</label>
                                                                    <input type='date' class='form-control' value='$t[tgl_awal]' name='tgl_awal'/>
                                                                    <label>Tanggal Akhir</label>
                                                                    <input type='date' class='form-control' value='$t[tgl_akhir]' name='tgl_akhir'/>
                                                                    <label>Keterangan Cuti</label>
                                                                    <textarea class='form-control' name='ket_cuti'>$t[ket_cuti]</textarea>
                                                                </div>
                                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                                <button type='submit' class='btn btn-primary'>Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                   
                                            <div class='modal fade' id='uibatal$t[id_cuti]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                            <h4 class='modal-title' id='H3'>Input Data</h4>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <form role='form' method='post' enctype='multipart/form-data' action='edit.php?aksi=proseseditbatalcuti&id_cuti=$t[id_cuti]'>
                                                                <div class='form-group'>
                                                                    <input type='hidden' class='form-control' value='$_SESSION[id_pegawai]' name='id_pegawai'/>
                                                                    <label>Keterangan Batal</label>
                                                                    <textarea class='form-control' name='ket_batal'>$t[ket_batal]</textarea>
                                                                </div>
                                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                                <button type='submit' class='btn btn-primary'>Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                   
                                            ";
    }
                                      echo"  </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>		
        
          ";
          ////////////////input admin			
    
    echo"			
    <div class='col-lg-12'>
                            <div class='modal fade' id='uiModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                <h4 class='modal-title' id='H3'>Input Data </h4>
                                            </div>
                                            <div class='modal-body'>
                                               <form role='form' method='post' enctype='multipart/form-data' action='input.php?aksi=inputcuti'>
                                                <div class='form-group'>
                                                <input type='hidden' class='form-control' value='$_SESSION[id_pegawai]' name='id_pegawai'/><br>
                                                <label>Perkiraan Lama Cuti</label>
                                                <input type='text' class='form-control' name='lama_cuti'/><br>
                                                <label>Tanggal Awal</label>
                                                <input type='date' class='form-control' name='tgl_awal'/><br>
                                                <label>Tanggal Akhir</label>
                                                <input type='date' class='form-control' name='tgl_akhir'/><br>
                                                <label>Keterangan Cuti</label>
                                                <textarea class='form-control' name='ket_cuti'></textarea><br>                        
                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                <button type='submit' class='btn btn-primary'>Save</button>
                                            </div>
                        </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </div>			
    "; 			
}
    elseif($_GET['aksi']=='rekappresensi'){
        echo"
        <div class='row'>
        <div class='col-lg-12'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Rekap Presensi
                </div>
                <div class='panel-body'>	
                       <div class='table-responsive'>		
                       <table class='table table-bordered' id='dataTable'>
                            <thead>
                                <tr>
                                    <th>nama</th>
                                    <th>Bulan/Tahun</th>
                                    <th>Total Presensi</th>
                                    <th>aksi</th>		  
                                </tr>
                            </thead>
            ";
            $tanggal_awal = date("Y-m-25"); // Tanggal 25 bulan ini
            $tanggal_akhir = date("Y-m-25", strtotime("+1 month")); // Tanggal 25 bulan berikutnya

            $id_pegawai_session = $_SESSION['id_pegawai']; // Mengambil ID pegawai dari session
            // Query SQL untuk membuat rekap presensi pegawai yang sedang login dari tanggal 25 bulan ini hingga tanggal 25 bulan berikutnya
            $query = "SELECT pg.id_pegawai, pg.nama_pegawai, DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m-%d') AS tanggal,
                             COUNT(pd.id_presensi_datang) as total_presensi
                      FROM pegawai pg
                      LEFT JOIN presensi_datang pd ON pg.id_pegawai = pd.id_pegawai
                      WHERE pg.id_pegawai = '$id_pegawai_session' AND pd.tanggal_absensi_datang >= '$tanggal_awal' AND pd.tanggal_absensi_datang < '$tanggal_akhir'
                      GROUP BY pg.id_pegawai, DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m-%d')";
            // Jalankan query
            $result = $koneksi->query($query);
            while ($t = $result->fetch_assoc()) {
                $sql=mysqli_query($koneksi," SELECT * FROM presensi_datang WHERE id_pegawai=$t[id_pegawai] ");
                $tx=mysqli_fetch_array($sql);   
                            echo"<tbody>
                                <tr>
                                    <td>$t[nama_pegawai]</td>
                                    <td>$t[bulan_tahun]</td>
                                    <td>$t[total_presensi]</td>
                                    <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModal$t[id_pegawai]'>AKSI</button></td>
                                </tr>
                            </tbody>
                            <!-- Modal edit-->
                            
                            <div class='modal fade' id='uiModal$t[id_pegawai]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                            
                                            </div>
                                                    <div class='box-body'>
                                                    <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class='card'>
                                                            <div class='card-body'>
                                                                <h5 class='card-title'>Nama Pegawai</h5>
                                                                <p class='card-text'>$t[nama_pegawai]</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-6'>
                                                    <div class='card'>
                                                        <div class='card-body'>
                                                            <h5 class='card-title'>Status</h5>
                                                            <p class='card-text'>$tx[status_hadir]</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class='col-md-6'>
                                                        <div class='card'>
                                                            <div class='card-body'>
                                                                <h5 class='card-title'>Jam Presensi</h5>
                                                                <p class='card-text'>$tx[jam_absensi_datang]</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-12'>
                                                        <div class='card'>
                                                            <div class='card-body'>
                                                                <h5 class='card-title'>Gambar</h5>
                                                                <p class='card-text'><img src='uploads/$tx[gambar_datang]' alt='Gambar Modal' class='img-fluid'></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-12'>
                                                        <div class='card'>
                                                            <div class='card-body'>
                                                            <a href='detaillokasi.php?id_presensi_datang=$tx[id_presensi_datang]' class='btn btn-info' >MAP</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                
                                                    </div>
                                        </div>
                                    </div>
                            </div>                    
                            
                            ";
    }
                        echo"</table>
                    </div>
                </div>
            </div>
        </div>
       </div>";			
    }
?>