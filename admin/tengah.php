<?php
date_default_timezone_set('Asia/Jakarta');
///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='home'){
include "grafik.php";
echo"
 <div class='row'>
                   <div class='col-lg-12'>
			<div class='panel panel-default'>
                            <div class='panel-heading'>
                           Sambutan
                            </div>
                            <div class='panel-body'>                         
				<p>Selamat Datang Di halaman Admin, Silahkan Pilih menu untuk pengaturan data yang di butuhkan guna mendapatkan hasil yang maksimal sesuai keinginan.</p>
                            </div>
			</div>
                   </div>
</div>";

echo"<div class='row'>
                    <div class='col-xs-12'>
              <div class='panel panel-primary'>
			    <div class='box-header'>
				   <h3 class='box-title'>INFORMASI</h3>
                </div>
                <div class='box-header'>
				</div>
     <div class='box-body'>
     <a href='index.php?aksi=informasi' class='btn btn-app'>
                    <span class='badge bg-yellow'>3</span>
                    <i class='fa fa-arrows-h fa-5x'></i> Informasi
                  </a>
                  <a href='index.php?aksi=galeri' class='btn btn-app'>
                  <span class='badge bg-yellow'>3</span>
                  <i class='fa fa-arrows-h fa-5x'></i> Galeri
                </a>
                <a href='index.php?aksi=halaman' class='btn btn-app'>
                <span class='badge bg-yellow'>3</span>
                <i class='fa fa-arrows-h fa-5x'></i> Halaman
              </a>    
              <a href='index.php?aksi=kritik' class='btn btn-app'>
              <span class='badge bg-yellow'>3</span>
              <i class='fa fa-arrows-h fa-5x'></i> Kritik
            </a>
            </div>
			</div>
 </div>
			</div>
";
}
elseif($_GET['aksi']=='ikon'){
include "../ikon.php";
}
elseif($_GET['aksi']=='profil'){
echo"			
	<div class='row'>
	 <div class='col-xs-12'>
              <div class='panel panel-primary'>
			    <div class='box-header'>
				   <h3 class='box-title'>INFORMASI PROFIL</h3>
                </div>
                <div class='box-header'>
				</div>
                             <div class='box-body'>
		<div class='table-responsive'>		
	 <table id='example1' class='table table-bordered table-striped'>
	 <thead> 
	 <tr>
                                            <th>No</th>
                                            <th>Profil</th>
                                        </tr>
                                    </thead>
				   <tbody> ";
				$no=0;   
				$tebaru=mysqli_query($koneksi," SELECT * FROM profil WHERE id_profil ='1'");
while ($t=mysqli_fetch_array($tebaru)){
                $isi_berita = strip_tags($t['isi']); 
                $isi = substr($isi_berita,0,70); 
                $isi = substr($isi_berita,0,strrpos($isi," ")); 
$no++;    
                                    echo"
                                        <tr>
                                            <td>$no</td>
                                            <td><div class='btn-group'>
                      <button type='button' class='btn btn-info'>$t[nama]</button>
                      <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                        <span class='caret'></span>
                        <span class='sr-only'>Toggle Dropdown</span>
                      </button>
                      <ul class='dropdown-menu' role='menu'>
                        <li><a href='index.php?aksi=editprofil&id_p=$t[id_profil]'>edit</a></li>
						<li><a href='index.php?aksi=viewprofil&id_p=$t[id_profil]'>view</a></li>
                        </ul>
                    </div></td>
                                       </tr>                                      
                                    ";
}
                                echo"</tbody></table>
                            </div>
                        </div>
                    </div>
                </div>
               </div>	
	";
}



/////////////////////////////////////////////////////////////////////////////////////////////////

elseif($_GET['aksi']=='editprofil'){
$tebaru=mysqli_query($koneksi," SELECT * FROM profil WHERE id_profil=$_GET[id_p] ");
$t=mysqli_fetch_array($tebaru);
echo"
<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>EDIT PROFIL
                        </div>
                        <div class='panel-body'>
<form id='form1'  method='post' enctype='multipart/form-data' action='master/profil.php?act=editpro&id_p=$_GET[id_p]'>
       <div class='form-grup'>
        <label>Nama Aplikasi</label>
        <input type='text' class='form-control' value='$t[nama_app]' name='nama_app'/><br>
        <label>Nama</label>
        <input type='text' class='form-control' value='$t[nama]' name='jd'/><br>
		<label>Alias</label>
        <input type='text' class='form-control' value='$t[alias]' name='alias'/><br>
		<label>Tahun</label>
        <input type='text' class='form-control' value='$t[tahun]' name='tahun'/><br>
		<label>Alamat</label>
        <input type='text' class='form-control' value='$t[alamat]' name='alamat'/><br>
        <label>Gambar Begroud Aplikasi</label>
        <input type='file' class='smallInput'  name='gambar'/><br>
		<label>Isi</label>
        <textarea id='text-ckeditor' class='form-control' name='isi'>$t[isi]</textarea></br>
		<script>CKEDITOR.replace('text-ckeditor');</script>
    	<div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                            <button type='submit' class='btn btn-primary'>Save </button>
                                        </div> </div>
    </form></div> </div></div> </div>
";
}



elseif($_GET['aksi']=='viewprofil'){
$tebaru=mysqli_query($koneksi," SELECT * FROM profil WHERE id_profil=$_GET[id_p] ");
$t=mysqli_fetch_array($tebaru);
echo"<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>$t[nama]
                        </div>
                        <div class='panel-body'>
<a href='javascript:history.go(-1)' class='btn btn-info'> Kembali</a></div>
";
echo"$t[isi] </div></div></div></div></div>";
}



elseif($_GET['aksi']=='admin'){
echo"<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>INFORMASI 
                        </div>
                        <div class='panel-body'>	
			<button class='btn btn-info' data-toggle='modal' data-target='#uiModal'>
                                Tambah Data Admin
                            </button>
                           	<div class='table-responsive'>		
	 <table id='example1' class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th>nama</th>
                                            <th>User</th>		  
                                        </tr>
                                    </thead>
				    ";
			
$no=0;
$tebaru=mysqli_query($koneksi," SELECT * FROM user ");
while ($t=mysqli_fetch_array($tebaru)){	
$no++;
                                    echo"<tbody>
                                        <tr>
                                            <td>$t[user_nama]</td>
							<td><div class='btn-group'>
                      <button type='button' class='btn btn-info'>$t[user_username]</button>
                      <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                        <span class='caret'></span>
                        <span class='sr-only'>Toggle Dropdown</span>
                      </button>
                      <ul class='dropdown-menu' role='menu'>
                        <li><a href='index.php?aksi=editadmin&user_id=$t[user_id]' title='Edit'><i class='fa fa-pencil'></i>edit</a></li>
						<li><a href='hapus.php?aksi=hapusadmin&user_id=$t[user_id]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[user_username] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</li>
                        </ul>
                    </div></td>
                                        </tr>
                                    </tbody>";
}
                                echo"</table>
                            </div>
                        </div>
                    </div>
                </div>
               </div>";			

////////////////input admin			

echo"			
<div class='col-lg-12'>
                        <div class='modal fade' id='uiModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                            <h4 class='modal-title' id='H3'>Input</h4>
                                        </div>
                                                  <div class='box-body'>
            <form action='input.php?aksi=inputadmin' method='post' enctype='multipart/form-data'>
              <div class='form-group'>
                <label>Nama</label>
                <input type='text' class='form-control' name='nama' required='required' placeholder='Masukkan Nama ..'>
              </div>
              <div class='form-group'>
                <label>Username</label>
                <input type='text' class='form-control' name='username' required='required' placeholder='Masukkan Username ..'>
              </div>
              <div class='form-group'>
                <label>Password</label>
                <input type='password' class='form-control' name='password' required='required' min='5' placeholder='Masukkan Password ..'>
              </div>
              <div class='form-group'>
                <label>Foto</label>
                <input type='file' name='foto'>
              </div>
              <div class='form-group'>
                <input type='submit' class='btn btn-sm btn-primary' value='Simpan'>
              </div>
            </form>
          </div>
									
                                </div>
                            </div>
                    </div>
		    </div>			
"; 
}



/////////////////////////////////////////////////////////////////////////////////////////////////

elseif($_GET['aksi']=='editadmin'){
$tebaru=mysqli_query($koneksi," SELECT * FROM user WHERE user_id=$_GET[user_id]");
$t=mysqli_fetch_array($tebaru);
echo"
<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>EDIT  $t[user_nama] $t[user_id]
                        </div>
                        <div class='panel-body'>
<form id='form1'  method='post' action='edit.php?aksi=proseseditadmin&user_id=$t[user_id]'  enctype='multipart/form-data'>
    	<label>Nama Lengkap</label>
        <input type='text' class='form-control'  name='nama' value='$t[user_nama]'/>
	<label>User Name</label>
        <input type='text' class='form-control'  name='username' value='$t[user_username]'/>     
	<label>Password</label>
        <input type='text' class='form-control'  name='password'/> </br>
		 <label>Foto</label>
                  <input type='file' name='foto'></br>
	 <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          <button type='submit' class='btn btn-primary'>Save </button>
    </form>  
</div> </div></div></div>
";
}

elseif($_GET['aksi']=='pegawai'){
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
                                            <th>NIP</th>
                                            <th>aksi</th>			  
                                          </tr></thead>
                        <tbody>
                        ";
                
    $no=0;
    $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai ");
    while ($t=mysqli_fetch_array($tebaru)){	
    $no++;
                                        echo"<tr>
                                            <td>$no</td>
                                            <td>$t[nama_pegawai]</td>
                                            <td><a class='btn btn-info' href='index.php?aksi=detailpegawai&id_pegawai=$t[id_pegawai]'>$t[kode_pegawai]</a></td>
                                <td><button class='btn btn-info' data-toggle='modal' data-target='#ui$t[id_pegawai]'><i class='fa fa-pencil'></i>edit</button>
                                   <a class='btn btn-info' href='hapus.php?aksi=hapuspegawai&id_pegawai=$t[id_pegawai]&gbr=$t[gambar]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[nama] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
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
                                                    <option value='NON TETAP'>NON TETAP</option>
                                                </select><br><br>
                                                <label>Jenis Pegawai</label>
                                                <select class='form-control select2' style='width: 100%;' name=jenis_pegawai>
                                                    <option value='$t[jenis_pegawai]' selected>$t[jenis_pegawai]</option>
                                                    <option value='Dosen'>Dosen</option>
                                                    <option value='Tenaga Pendidik'>Tenaga Pendidik</option>
                                                    <option value='Dosen dan Tenaga Pendidik'>Dosen dan Tenaga Pendidik</option>
                                                </select><br><br>
                                                <label>Jabatan Pegawai</label>
                                                <select class='form-control select2' style='width: 100%;' name='jabatan_pegawai'>
                                                    <option value='$t[jabatan_pegawai]' selected>$t[jabatan_pegawai]</option>
                                                    <option value='Rektor'>Rektor</option>
                                                    <option value='Wakil Rektor 1'>Wakil Rektor 1</option>
                                                    <option value='Wakil Rektor 2'>Wakil Rektor 2</option>
                                                    <option value='Wakil Rektor 3'>Wakil Rektor 3</option>
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
                                               <form role='form' method='post' enctype='multipart/form-data' action='input.php?aksi=inputpegawai'>
                                                <div class='form-group'>
                                                <label>NIP pegawai</label>
                                                <input type='text' class='form-control' name='kode_pegawai'/><br>
                                                <label>nama</label>
                                                <input type='text' class='form-control' name='nama_pegawai'/><br>
                                                <label>Nik</label>
                                                <input type='text' class='form-control' name='nik'/><br>
                                                <label>Nomor Hp</label>
                                                <input type='text' class='form-control' name='no_hp'/><br>
                                                <label>Email</label>
                                                <input type='text' class='form-control' name='email'/><br>
                                                <label>Mulai Kerja</label>
                                                <input type='date' class='form-control' name='mulai_kerja'/><br>
                                                <label>Tempat Lahir pegawai</label>
                                                <input type='text' class='form-control' name='tempat_lahir'/><br>
                                                <label>Tanggal Lahir pegawai</label>
                                                <input type='date' class='form-control' name='tgl_lahir'/><br>
                                                <label>Jenis Kelamin</label>
                                                <select class='form-control select2' style='width: 100%;' name=jenis_kelamin>
                                                <option value='' selected>--Pilih Jenis Kelamin--</option>
                                                <option value='Laki-Laki'>Laki-Laki</option>
                                                <option value='Perempuan'>Perempuan</option>
                                                </select><br></br>
                                                <label>Status Pegawai</label>
                                                <select class='form-control select2' style='width: 100%;' name=status_pegawai>
                                                    <option value='' selected>--Pilih Status Pegawai</option>
                                                    <option value='TETAP'>TETAP</option>
                                                    <option value='NO TETAP'>NO TETAP</option>
                                                </select><br><br>
                                                <label>Jenis Pegawai</label>
                                                <select class='form-control select2' style='width: 100%;' name=jenis_pegawai>
                                                    <option value='' selected>--Pilih Jenis Pegawai</option>
                                                    <option value='Dosen'>Dosen</option>
                                                    <option value='Tenaga Pendidik'>Tenaga Pendidik</option>
                                                    <option value='Dosen dan Tenaga Pendidik'>Dosen dan Tenaga Pendidik</option>
                                                </select><br><br>
                                                <label>Jabatan Pegawai</label>
                                                <select class='form-control select2' style='width: 100%;' name='jabatan_pegawai'>
                                                    <option value='' selected>--Pilih Jabatan Pegawai--</option>
                                                    <option value='Rektor'>Rektor</option>
                                                    <option value='Wakil Rektor 1'>Wakil Rektor 1</option>
                                                    <option value='Wakil Rektor 2'>Wakil Rektor 2</option>
                                                    <option value='Wakil Rektor 3'>Wakil Rektor 3</option>
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
                                                <textarea id='text-ckeditor' class='form-control' name='alamat'></textarea><br>
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
       
/////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='detailpegawai'){
    $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE id_pegawai=$_GET[id_pegawai] ");
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

        <a href='#' class='btn btn-primary btn-block'><b>Follow</b></a>
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
         $sqllite=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='penghargaan' and id_pegawai='$_GET[id_pegawai]'");
        while ($sx=mysqli_fetch_array($sqllite)){	
            $no++;   
       echo" <p> $no . $sx[ket_riwayat]</p>";
        }
      echo"</div><!-- /.box-body -->
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
                $tebaru1=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='pendidikan' and id_pegawai='$_GET[id_pegawai]'");
                while ($x=mysqli_fetch_array($tebaru1)){	
                $no++;
                        echo"<tr>
                            <td>$no</td>
                                <td>$x[ket_riwayat]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModal$x[id_riwayat]'><i class='fa fa-pencil'></i>lihat</button>
                <a class='btn btn-info' href='hapus.php?aksi=hapusriwayat&id_riwayat=$x[id_riwayat]&id_pegawai=$_GET[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $x[ket_riwayat] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
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
                                        <input type='hidden' class='form-control'  value='$_GET[id_pegawai]' name='id_pegawai'/><br>
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
            <input type='hidden' class='form-control'  value='$_GET[id_pegawai]' name='id_pegawai'/><br>

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
                $tebaru2=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='pekerjaan' and id_pegawai='$_GET[id_pegawai]'");
                while ($j=mysqli_fetch_array($tebaru2)){	
                $no++;
                        echo"<tr>
                            <td>$no</td>
                                <td>$j[ket_riwayat]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModalj$j[id_riwayat]'><i class='fa fa-pencil'></i>lihat</button>
                <a class='btn btn-info' href='hapus.php?aksi=hapusriwayat&id_riwayat=$j[id_riwayat]&id_pegawai=$_GET[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $j[ket_riwayat] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
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
                                        <input type='hidden' class='form-control'  value='$_GET[id_pegawai]' name='id_pegawai'/><br>
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
            <input type='hidden' class='form-control'  value='$_GET[id_pegawai]' name='id_pegawai'/><br>

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
                $sql=mysqli_query($koneksi," SELECT * FROM riwayat WHERE jenis_riwayat='penghargaan' and id_pegawai='$_GET[id_pegawai]'");
                while ($s=mysqli_fetch_array($sql)){	
                $no++;
                        echo"<tr>
                            <td>$no</td>
                                <td>$s[ket_riwayat]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModalpenghargaan$s[id_riwayat]'><i class='fa fa-pencil'></i>lihat</button>
                <a class='btn btn-info' href='hapus.php?aksi=hapusriwayat&id_riwayat=$s[id_riwayat]&id_pegawai=$_GET[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $s[ket_riwayat] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
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
                                        <input type='hidden' class='form-control'  value='$_GET[id_pegawai]' name='id_pegawai'/><br>
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
            <input type='hidden' class='form-control'  value='$_GET[id_pegawai]' name='id_pegawai'/><br>

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
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalupload'><i class='fa fa-cloud-upload'></i>Tambah Data</button><br><br>
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
$tql=mysqli_query($koneksi," SELECT * FROM dokumen WHERE id_pegawai=$_GET[id_pegawai]");
while ($q=mysqli_fetch_array($tql)){	
$no++;
        echo"<tbody>
            <tr>
                <td>$no</td>
                <td><a href='../foto/dokumen/$q[file_dokumen]' target='_blank'>$q[ket_dokumen]</a></td>
<td><a class='btn btn-info' href='hapus.php?aksi=hapusbuktidokumen&id_dokumen=$q[id_dokumen]&id_pegawai=$_GET[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $q[ket_dokumen] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a></td>
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
                    <input type='hidden' name='id_pegawai'   id='id_pegawai' value='$_GET[id_pegawai]' class='form-control'>
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
        <button class='btn btn-info' data-toggle='modal' data-target='#uiModalkeluarga'><i class='fa fa-plus'></i>Tambah Data</button><br><br>
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
$keluarga=mysqli_query($koneksi," SELECT * FROM keluarga WHERE id_pegawai=$_GET[id_pegawai]");
while ($k=mysqli_fetch_array($keluarga)){	
$no++;
        echo"<tbody>
            <tr>
                <td>$no</td>
                <td>$k[nama_keluarga]</td>
                <td>$k[hubungan_keluarga]</td>
                <td>$k[no_hpkeluarga]</td>
                <td><button class='btn btn-info' data-toggle='modal' data-target='#uieditkeluarga$k[id_keluarga]'><i class='fa fa fa-pencil'></i></button>
                <a class='btn btn-info' href='hapus.php?aksi=hapuskeluarga&id_keluarga=$k[id_keluarga]&id_pegawai=$_GET[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $k[nama_keluarga] ?')\" title='Hapus'><i class='fa fa-remove'></i></a>
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
                <input type='hidden' class='form-control'  value='$_GET[id_pegawai]' name='id_pegawai'/><br>

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
                <input type='hidden' class='form-control'  value='$_GET[id_pegawai]' name='id_pegawai'/><br>

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
elseif($_GET['aksi']=='kritik'){
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
                                                <th>email</th>
                                                <th>aksi</th>		  
                                          </tr></thead>
                        <tbody>
                        ";
                
    $no=0;
    $tebaru=mysqli_query($koneksi," SELECT * FROM kritik ");
    while ($t=mysqli_fetch_array($tebaru)){	
    $no++;
                                        echo"<tr>
                                            <td>$no</td>
                                                <td>$t[nama]</td>
                                                <td>$t[email]</td>
                                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModal$t[id_kritik]'><i class='fa fa-pencil'></i>lihat</button>
                            <a href='hapus.php?aksi=hapuskritik&id_sub=$t[id_kritik]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[pesan] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</a>
                            </td>
                                            </tr>
                                            
                                            <div class='modal fade' id='uiModal$t[id_kritik]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                        <h4 class='modal-title' id='H3'>Input Data </h4>
                                                    </div>
                                                    <div class='modal-body'>
                                                       <form role='form' method='post' action='#'>
                                                        <div class='form-group'>
                                    <label>Nama</label>
                                    <input type='text' class='form-control' value='$t[nama]' name='nama'/><br>
                                    <label>email</label>
                                    <input type='text' class='form-control' value='$t[email]' name='email'/><br>
                                    <label>pesan</label>
                                   <p>$t[pesan]</p><br>
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
elseif($_GET['aksi']=='presensi'){
echo"<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>INFORMASI 
                        </div>
                        <div class='panel-body'>	
	 <a href='laporan.php?aksi=presensi' target='_blank' class='btn btn-info' ><i class='fa fa-print' ></i></span></a>  
      <a href='index.php?aksi=presensidatang' class='btn btn-info' >Absensi Datang</a> 
      <a href='index.php?aksi=presensipulang' class='btn btn-info' >Absensi Pulang</a><br><br>
                           	<div class='table-responsive'>		
	 <table id='example1' class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
										<th>No</th>
                                        <th>nama</th>
                                        <th>Tanggal Absensi</th>
                                        <th>Jam Datang</th>
                                        <th>Jam Pulang</th>
                                        <th>Status</th>
                                        <th>Jam Kerja Efektif</th>
                                        <th>aksi</th>			  
                                      </tr></thead>
                    <tbody>
				    ";
                    
                    $no=0;
                    $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai,presensi_datang WHERE presensi_datang.id_pegawai=pegawai.id_pegawai order by presensi_datang.id_presensi_datang  DESC");
                    while ($t=mysqli_fetch_array($tebaru)){	
                        $sql=mysqli_query($koneksi," SELECT * FROM presensi_pulang WHERE id_pegawai=$t[id_pegawai] ");
                        $tx=mysqli_fetch_array($sql);    
                    $no++;
                    // Waktu standar kedatangan (misalnya, 08:00)
                    $standardTime = "08:00";
                    // Waktu aktual kedatangan (misalnya, diambil dari input pengguna)
                    $actualTime = $t['jam_absensi_datang']; // Waktu kedatangan aktual dari database
                    // Konversi waktu ke format DateTime
                    $standardDateTime = new DateTime($standardTime);
                    $actualDateTime = new DateTime($actualTime);
                    // Waktu standar kepulangan (misalnya, 15:30)
                    $standardTimepulang = "15:30";
                    // Waktu kepulangan aktual dari database
                    $actualTimepulang = $tx['jam_absensi_pulang'];
                    // Konversi waktu ke format DateTime
                    $standardDateTimepulang = new DateTime($standardTimepulang);
                    $actualDateTimepulang = new DateTime($actualTimepulang);
                    // Menghitung total jam kerja efektif
                    $intervalKerja = $actualDateTime->diff($actualDateTimepulang);
                    $jamKerjaEfektif = $intervalKerja->format('%h jam %i menit');
                    echo"<tr>
                        <td>$no</td>
                        <td>$t[nama_pegawai]</td>
                        <td>$t[tanggal_absensi_datang]</td>
                        <td>$t[jam_absensi_datang] "; // Menampilkan status keterlambatan
                        if ($actualDateTime > $standardDateTime) {
                            $interval = $standardDateTime->diff($actualDateTime);
                                                       echo "<button class='btn btn-danger'>Terlambat " . $interval->format('%h jam %i menit') . ".</button>";
                        } else {
                            echo "<button class='btn btn-success'>Tepat waktu</button>";
                        }
                        echo "</td>
                        <td>$tx[jam_absensi_pulang] "; // Menampilkan status pulang cepat
                        if ($actualDateTimepulang < $standardDateTimepulang) {
                            $intervalpulang = $standardDateTimepulang->diff($actualDateTimepulang);
                            echo "<button class='btn btn-warning'>Pulang cepat " . $intervalpulang->format('%h jam %i menit') . ".</button>";
                        } else {
                            echo "<button class='btn btn-success'>Pulang tepat waktu</button>";
                        }
                        echo "</td>
                        <td>$t[status_hadir]</td>
                        <td>$jamKerjaEfektif</td> 
                                        <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModal$t[id_pegawai]'>AKSI</button></td>
                                        </tr>
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
                                                                <p class='card-text'>$t[status_hadir]</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class='col-md-6'>
                                                            <div class='card'>
                                                                <div class='card-body'>
                                                                    <h5 class='card-title'>Jam Presensi</h5>
                                                                    <p class='card-text'>$t[jam_absensi_datang]</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-12'>
                                                            <div class='card'>
                                                                <div class='card-body'>
                                                                    <h5 class='card-title'>Gambar</h5>
                                                                    <p class='card-text'><img src='../uploads/$t[gambar_datang]' alt='Gambar Modal' class='img-fluid'></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-12'>
                                                            <div class='card'>
                                                                <div class='card-body'>
                                                                <a href='detaillokasi.php?id_presensi_datang=$t[id_presensi_datang]' class='btn btn-info' >MAP</a>
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
elseif($_GET['aksi']=='presensidatang'){
    echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI 
                            </div>
                            <div class='panel-body'>	
                <a href='index.php?aksi=presensi' class='btn btn-info' >Total Absensi</a> <a href='index.php?aksi=presensipulang' class='btn btn-info' >Absensi Pulang</a><br><br>
                                   <div class='table-responsive'>		
                                   <table id='example1' class='table table-bordered table-striped'>
                                        <thead>
                                            <tr><th>#</th>
                                                <th>nama</th>
                                                <th>Tanggal Absensi</th>
                                                <th>Jam Datang</th>
                                                <th>aksi</th>		  
                                            </tr>
                                        </thead>
                        ";
                
    $no=0;
    $tebaru=mysqli_query($koneksi," SELECT * FROM presensi_datang,pegawai WHERE presensi_datang.id_pegawai=pegawai.id_pegawai order by presensi_datang.id_presensi_datang  DESC");
    while ($t=mysqli_fetch_array($tebaru)){	
    $no++;
                                        echo"<tbody>
                                            <tr>
                                            <td>$no</td>
                                                <td>$t[nama_pegawai]</td>
                                                <td>$t[tanggal_absensi_datang]</td>
                                                <td>$t[jam_absensi_datang]</td>
                                                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModal'>AKSI</button></td>
                                            </tr>
                                        </tbody>
                                        <!-- Modal edit-->
                                        <div class='modal fade' id='uiModal$t[id_pemilih]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                            <h4 class='modal-title' id='H3'>Edit Data $t[nama_pemilih]</h4>
                                                        </div>
                                                                <div class='box-body'>
                                                                    <form action='edit.php?aksi=proseseditpemilih&id_pemilih=$t[id_pemilih]' method='post' enctype='multipart/form-data'>
                                                                    <div class='form-group'>
                                                                        <label>Nama</label>
                                                                        <input type='text' class='form-control' name='nama_pemilih' value='$t[nama_pemilih]' required='required' placeholder='Masukkan Nama ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>nisn</label>
                                                                        <input type='text' class='form-control' name='nisn' value='$t[nisn]' required='required' placeholder='Masukkan nisn ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>No hp</label>
                                                                        <input type='text' class='form-control' name='no_hp' value='$t[no_hp]' required='required'  placeholder='Masukkan no hp..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Kelas</label>
                                                                        <input type='text' class='form-control' name='kelas' value='$t[kelas]' required='required' placeholder='Masukkan kelas..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <input type='submit' class='btn btn-sm btn-primary' value='Simpan'>
                                                                    </div>
                                                                    </form>
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
    
    ////////////////input data	
    
    echo"			<!-- Modal input-->
                            <div class='modal fade' id='uiModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                <h4 class='modal-title' id='H3'>Input Data</h4>
                                            </div>
                                                    <div class='box-body'>
                                                        <form action='input.php?aksi=inputpemilih' method='post' enctype='multipart/form-data'>
                                                        <div class='form-group'>
                                                                        <label>Nama</label>
                                                                        <input type='text' class='form-control' name='nama_pemilih' required='required' placeholder='Masukkan Nama ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>nisn</label>
                                                                        <input type='text' class='form-control' name='nisn' required='required' placeholder='Masukkan nisn ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>No hp</label>
                                                                        <input type='text' class='form-control' name='no_hp' required='required' placeholder='Masukkan nomor hp ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Kelas</label>
                                                                        <input type='text' class='form-control' name='kelas' required='required'  placeholder='Masukkan kelas..'>
                                                                    </div>
                                                        <div class='form-group'>
                                                            <input type='submit' class='btn btn-sm btn-primary' value='Simpan'>
                                                        </div>
                                                        </form>
                                                    </div>
                                        </div>
                                    </div>
                            </div>
        
    "; 
    }  
elseif($_GET['aksi']=='presensipulang'){
    echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI 
                            </div>
                            <div class='panel-body'>	
                <a href='index.php?aksi=presensi' class='btn btn-info' >Total Absensi</a> <a href='index.php?aksi=presensidatang' class='btn btn-info' >Absensi Datang</a><br><br>
                                   <div class='table-responsive'>		
                                   <table id='example1' class='table table-bordered table-striped'>
                                        <thead>
                                            <tr> <th>#</th>
                                                <th>nama</th>
                                                <th>Tanggal Absensi</th>
                                                <th>Jam Datang</th>
                                                <th>aksi</th>		  
                                            </tr>
                                        </thead>
                        ";
                
    $no=0;
    $tebaru=mysqli_query($koneksi," SELECT * FROM presensi_pulang,pegawai WHERE presensi_pulang.id_pegawai=pegawai.id_pegawai order by presensi_pulang.id_presensi_pulang  DESC");
    while ($t=mysqli_fetch_array($tebaru)){	
    $no++;
                                        echo"<tbody>
                                            <tr> <td>$no</td>
                                                <td>$t[nama_pegawai]</td>
                                                <td>$t[tanggal_absensi_pulang]</td>
                                                <td>$t[jam_absensi_pulang]</td>
                                                <td><button class='btn btn-info' data-toggle='modal' data-target='#uiModal'>AKSI</button></td>
                                            </tr>
                                        </tbody>
                                        <!-- Modal edit-->
                                        <div class='modal fade' id='uiModal$t[id_pegawai]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                            <h4 class='modal-title' id='H3'>Edit Data $t[nama_pegawai]</h4>
                                                        </div>
                                                                <div class='box-body'>
                                                                 <div class='form-group'>
                                                                        <label>Nama</label>
                                                                        <input type='text' class='form-control' name='nama_pemilih' value='$t[nama_pemilih]' required='required' placeholder='Masukkan Nama ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>nisn</label>
                                                                        <input type='text' class='form-control' name='nisn' value='$t[nisn]' required='required' placeholder='Masukkan nisn ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>No hp</label>
                                                                        <input type='text' class='form-control' name='no_hp' value='$t[no_hp]' required='required'  placeholder='Masukkan no hp..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Kelas</label>
                                                                        <input type='text' class='form-control' name='kelas' value='$t[kelas]' required='required' placeholder='Masukkan kelas..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <input type='submit' class='btn btn-sm btn-primary' value='Simpan'>
                                                                    </div>
                                                                    </form>
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
    
    ////////////////input data	
    
    echo"			<!-- Modal input-->
                            <div class='modal fade' id='uiModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                <h4 class='modal-title' id='H3'>Input Data</h4>
                                            </div>
                                                    <div class='box-body'>
                                                        <form action='input.php?aksi=inputpemilih' method='post' enctype='multipart/form-data'>
                                                        <div class='form-group'>
                                                                        <label>Nama</label>
                                                                        <input type='text' class='form-control' name='nama_pemilih' required='required' placeholder='Masukkan Nama ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>nisn</label>
                                                                        <input type='text' class='form-control' name='nisn' required='required' placeholder='Masukkan nisn ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>No hp</label>
                                                                        <input type='text' class='form-control' name='no_hp' required='required' placeholder='Masukkan nomor hp ..'>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>Kelas</label>
                                                                        <input type='text' class='form-control' name='kelas' required='required'  placeholder='Masukkan kelas..'>
                                                                    </div>
                                                        <div class='form-group'>
                                                            <input type='submit' class='btn btn-sm btn-primary' value='Simpan'>
                                                        </div>
                                                        </form>
                                                    </div>
                                        </div>
                                    </div>
                            </div>
        
    "; 
    }  
    elseif($_GET['aksi']=='rekappresensi'){
        echo"
        <div class='col-lg-12'>
        <div class='panel panel-default'>
            <div class='panel-heading'>Rekap Presensi Setiap Pegawai Bulan Ini
            </div>
            <div class='panel-body'>	
        <form id='form1'  method='post' action='index.php?aksi=detailrekap'>
        <div class='form-group'>
        <label>Tanggal Akhir</label>
        <input type='date' class='form-control'  name='tgl_awal'/>
        <label>Tanggal Akhir</label>
        <input type='date' class='form-control' name='tgl_akhir'/>
                <div class='modal-footer'>
                                                    <button type='submit' class='btn btn-primary'>Filter </button>
                                                </div> </div>
            </form>
        </div>
        </div>  
    </div>
        <div class='col-lg-12'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Rekap Presensi Setiap Pegawai Bulan Ini
                </div>
                <div class='panel-body'>	
                       <div class='table-responsive'>		
                       <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>nama</th>
                                    <th>Bulan/Tahun</th>
                                    <th>Total Presensi</th>
                                    <th>aksi</th>		  
                                </tr>
                            </thead>
            ";
            $bulan_tahun_sekarang = date("Y-m");
            // Query SQL untuk membuat rekap presensi setiap pegawai setiap bulan
            $query = "SELECT pg.id_pegawai, pg.nama_pegawai, DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m') AS bulan_tahun,
                             COUNT(pd.id_presensi_datang) as total_presensi
                      FROM pegawai pg
                      LEFT JOIN presensi_datang pd ON pg.id_pegawai = pd.id_pegawai
                      WHERE DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m') = '$bulan_tahun_sekarang'
                      GROUP BY pg.id_pegawai, DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m')";
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
                                                                <p class='card-text'><img src='../uploads/$tx[gambar_datang]' alt='Gambar Modal' class='img-fluid'></p>
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
       ";			
    }
    
    elseif($_GET['aksi']=='detailrekap'){
        $tgl_awal = date("d F Y", strtotime($_POST['tgl_awal']));
        $tgl_akhir = date("d F Y", strtotime($_POST['tgl_akhir'])); 
        // Gabungkan dalam satu string
        $periode = $tgl_awal . " - " . $tgl_akhir;
        echo"
    <div class='col-lg-12'>
    <div class='panel panel-default'>
        <div class='panel-heading'>Rekap Presensi Setiap Pegawai Bulan Ini
        </div>
        <div class='panel-body'>
        <form id='form1'  method='post' action='index.php?aksi=detailrekap'>
        <div class='form-group'>
        <label>Tanggal awal</label>
        <input type='date' class='form-control' value='$_POST[tgl_awal]' name='tgl_awal'/>
        <label>Tanggal Akhir</label>
        <input type='date' class='form-control' value='$_POST[tgl_akhir]' name='tgl_akhir'/>
                <div class='modal-footer'>
                                                    <button type='submit' class='btn btn-primary'>Filter </button>
                                                </div> </div>
            </form>
            </div>
            </div>  
        </div>
        <div class='col-lg-12'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Rekap Presensi Setiap Pegawai tanggal $periode
                </div>
                <div class='panel-body'>	
                       <div class='table-responsive'>		
                       <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>nama</th>
                                    <th>Bulan/Tahun</th>
                                    <th>Total Presensi</th>
                                    <th>aksi</th>		  
                                </tr>
                            </thead>
            ";
            $tgl_awal = "$_POST[tgl_awal]";
            $tgl_akhir = "$_POST[tgl_akhir]";
            
            // Query SQL untuk membuat rekap presensi setiap pegawai dalam rentang tanggal tertentu
            $query = "SELECT pg.id_pegawai, pg.nama_pegawai, DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m') AS bulan_tahun,
                             COUNT(pd.id_presensi_datang) as total_presensi
                      FROM pegawai pg
                      LEFT JOIN presensi_datang pd ON pg.id_pegawai = pd.id_pegawai
                      WHERE pd.tanggal_absensi_datang BETWEEN '$tgl_awal' AND '$tgl_akhir'
                      GROUP BY pg.id_pegawai, DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m')";
            
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
                                                                    <h5 class='card-title'>Jam Presensi</h5>
                                                                    <p class='card-text'>$tx[jam_absensi_datang]</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-12'>
                                                            <div class='card'>
                                                                <div class='card-body'>
                                                                    <h5 class='card-title'>Gambar</h5>
                                                                    <p class='card-text'><img src='../upload/$tx[gambar_datang]' alt='Gambar Modal' class='img-fluid'></p>
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
        </div>";			
    }     
elseif($_GET['aksi']=='cuti'){
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
                                            <th>Keterangan</th>
                                            <th>lama cuti</th>
                                            <th>status cuti</th>
                                            <th>aksi</th>			  
                                          </tr></thead>
                        <tbody>
                        ";
                
    $no=0;
    $tebaru=mysqli_query($koneksi,"SELECT cuti_pegawai.*, pegawai.nama_pegawai FROM cuti_pegawai JOIN pegawai ON cuti_pegawai.id_pegawai = pegawai.id_pegawai ORDER BY cuti_pegawai.id_cuti DESC");
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
                                            <td>$t[nama_pegawai]</td>
                                            <td>$t[ket_cuti]</td>
                                            <td>$lamaCuti hari</td>
                                            <td>$t[status_cuti]</td>
                                            <td><button class='btn btn-info btn-sm' data-toggle='modal' data-target='#ui$t[id_cuti]'><i class='fa fa-pencil'>EDIT</i></button>
                                            <a class='btn btn-success btn-sm' href='edit.php?aksi=proseseditacccuti&id_cuti=$t[id_cuti]'><i class='fa fa-check'></i>ACC</a>
                                            <a class='btn btn-danger btn-sm' href='edit.php?aksi=proseseditbatalcuti&id_cuti=$t[id_cuti]'><i class='fa fa-ban'></i>Tolak</a>
                                            
                                            </td>
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
                                                                    <input type='hidden' class='form-control' value='$t[id_pegawai]' name='id_pegawai'/>
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
}
elseif($_GET['aksi']=='kerja'){
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
                                            <th>Keterangan</th>
                                            <th>aksi</th>			  
                                          </tr></thead>
                        <tbody>
                        ";
                
    $no=0;
    $tebaru=mysqli_query($koneksi,"SELECT uraiankerja.*, pegawai.nama_pegawai FROM uraiankerja JOIN pegawai ON uraiankerja.id_pegawai = pegawai.id_pegawai ORDER BY uraiankerja.id_uraiankerja DESC");
    while ($t=mysqli_fetch_array($tebaru)){	
    $no++;
                                        echo"<tr>
                                            <td>$no</td>
                                            <td>$t[nama_pegawai]</td>
                                            <td>$t[ket_uraiankerja]</td>
                                            <td></td>
                                            </tr>
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
elseif($_GET['aksi']=='ulangtahun'){
    // Ambil data pegawai
$sql = "SELECT nama_pegawai, tgl_lahir FROM pegawai";
$result = $koneksi->query($sql);

echo "<div class='row'>
<div class='col-lg-12'>
<div class='panel panel-default'>
    <div class='panel-heading'>
        Pegawai yang Berulang Tahun Hari Ini
    </div>
    <div class='panel-body'>";

$jumlah_ulang_tahun = 0;

if ($result->num_rows > 0) {
    echo "<table id='example1' class='table table-striped table-bordered'>";
    echo "<thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Usia</th>
            </tr>
          </thead>
          <tbody>";

    $no = 1;
    $today = new DateTime();
    while ($row = $result->fetch_assoc()) {
        $nama = $row['nama_pegawai'];
        $tgl_lahir = $row['tgl_lahir'];
        
        // Hitung usia
        $birthDate = new DateTime($tgl_lahir);
        $usia = $birthDate->diff($today)->y;

        // Check if today is the birthday
        if ($birthDate->format('m-d') == $today->format('m-d')) {
            $jumlah_ulang_tahun++;
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$nama}</td>
                    <td>{$tgl_lahir}</td>
                    <td>{$usia} tahun</td>
                  </tr>";
            $no++;
        }
    }

    echo "</tbody></table>";
} else {
    echo "<p>Tidak ada data yang ditemukan.</p>";
}

echo "<p>Jumlah pegawai yang berulang tahun hari ini: {$jumlah_ulang_tahun}</p>";

echo "</div>
</div>
</div>
</div>";		
}
elseif($_GET['aksi']=='dosen'){
        echo"<div class='row'>
                        <div class='col-lg-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>INFORMASI 
                                </div>
                                <div class='panel-body'>	
                                <a class='btn btn-info' href='get.php?aksi=getpegawai'>download Data</a></br></br>
                                     <div class='table-responsive'>		
           <table id='example1' class='table table-bordered table-striped'>
                                            <thead>
                                                <tr> <th>No</th>
                                                    <th>NIDN</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>	
                                                    <th>Agama</th>	 
                                                    <th>id_dosen</th>	  
                                                    <th>status</th>	 
                                                </tr>
                                            </thead><tbody>
                    ";
            
        $no=0;
        $filter = "nama_status_aktif='Aktif'";
        $order = '';
        $limit = '';
        $offset = '';
        $data_aray = [
          'act' => 'GetListDosen',
          'token' => $_token,
          'filter' => $filter, 
          'order' => $order, 
          'limit' => $limit, 
          'offset' => $offset
        ];
        $datajson = json_decode($_ws->execute($data_aray));
        $dataArray = $datajson->data;
        foreach ($dataArray as $d) {
        $no++;
                                            echo"
                                                <tr><td>$no</td>
                                                <td> <a class='btn btn-info' href='index.php?aksi=detaildosen&id_d=$d->id_dosen'>$d->nidn</a></td> 
                                                    <td>$d->nama_dosen</td> 
                                                    <td>$d->jenis_kelamin</td> 
                                                    <td>$d->nama_agama</td>
                                                    <td>$d->id_dosen</td>
                                                    <td>$d->nama_status_aktif</td>	
                                                </tr>";
        }
                                        echo"
                                            </tbody></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                       </div>";	
     
}
elseif($_GET['aksi']=='detaildosen'){
          $id_dos=$_GET['id_d'];
          $filter = "id_dosen='$id_dos'";
          $order = '';
          $limit = '';
          $offset = '';
          $data_aray = [
            'act' => 'DetailBiodataDosen',
            'token' => $_token,
            'filter' => $filter, 
            'order' => $order, 
            'limit' => $limit, 
            'offset' => $offset
          ];
          $datajson = json_decode($_ws->execute($data_aray));
          $dataArray = $datajson->data;
          foreach ($dataArray as $d);
        echo"<div class='row'>
                        <div class='col-lg-12'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>INFORMASI 
                                </div>
                                <div class='panel-body'>	
                                <a class='btn btn-info' href='index.php?aksi=dosen'>Kembali</a></br></br>
                                     <div class='table-responsive'>
                                     <table class='table table-bordered table-striped'>
                                     <tr>
                                       <td>Nama Dosen</td>
                                       <td>$d->nama_dosen</td>
                                     </tr>
                                     <tr>
                                       <td>Tempat Lahir</td>
                                       <td>$d->tempat_lahir</td>
                                     </tr>
                                     <tr>
                                       <td>Tanggal Lahir</td>
                                       <td>$d->tanggal_lahir</td>
                                     </tr>
                                     <tr>
                                       <td>Jenis Kelamin</td>
                                       <td>$d->jenis_kelamin</td>
                                     </tr>
                                     <tr>
                                       <td>Agama</td>
                                       <td>$d->nama_agama</td>
                                     </tr>
                                     <tr>
                                       <td>Status Dosen</td>
                                       <td>$d->nama_status_aktif</td>
                                     </tr>
                                     <tr>
                                       <td>NIDN</td>
                                       <td>$d->nidn</td>
                                     </tr>
                                     <tr>
                                       <td>Nama Ibu</td>
                                       <td>$d->nama_ibu_kandung</td>
                                     </tr>
                                     <tr>
                                       <td>NIK</td>
                                       <td>$d->nik</td>
                                     </tr>
                                     <tr>
                                       <td>Jenis SDM</td>
                                       <td>$d->nama_jenis_sdm</td>
                                     </tr>
                                     <tr>
                                       <td>SK Pangkat</td>
                                       <td>$d->mulai_sk_pengangkatan</td>
                                     </tr>
                                     <tr>
                                       <td>Nama Lembaga</td>
                                       <td>$d->nama_lembaga_pengangkatan</td>
                                     </tr>
                                     <tr>
                                       <td>Pankat Golongan</td>
                                       <td>$d->nama_pangkat_golongan</td>
                                     </tr>
                                     <tr>
                                       <td>Sumber Gaji</td>
                                       <td>$d->nama_sumber_gaji</td>
                                     </tr>
                                     <tr>
                                       <td>HP</td>
                                       <td>$d->handphone</td>
                                     </tr>
                                     <tr>
                                       <td>Email</td>
                                       <td>$d->email</td>
                                     </tr>
                                     <tr>
                                     <td>Status Nikah</td>
                                     <td>$d->status_pernikahan</td>
                                     </tr>
                                      <tr>
                                       <td>Nama Istri</td>
                                       <td>$d->nama_suami_istri</td>
                                     </tr>
                                     <tr>
                                     <td>Pekerjaan Istri</td>
                                     <td>$d->nama_pekerjaan_suami_istri</td>
                                     </tr>
                              
                                   </table> 
                                     
      
          
                                    </div>
                                </div>
                            </div>
                        </div>
                       </div>";	
        
}
elseif($_GET['aksi']=='pegawai1'){
echo"<div class='row'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>INFORMASI 
                        </div>
                        <div class='panel-body'>	
			<button class='btn btn-info' data-toggle='modal' data-target='#uiModal'>
                                Tambah Data
                            </button> <a href='laporan.php?aksi=pegawai' target='_blank' class='btn btn-info' ><i class='fa fa-print' ></i></span></a><br><br>
                           	<div class='table-responsive'>		
	 <table id='example1' class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
										<th>No</th>
                                            <th>Nama pegawai</th>
                                            <th>Umur</th>
                                            <th>NIP</th>		  
                                      </tr></thead>
                    <tbody>
				    ";
			
$no=0;
$sqli = mysqli_query($koneksi,"SELECT id_pegawai, nama_pegawai, nik, tgl_lahir, (YEAR(CURDATE())-YEAR(tgl_lahir)) AS umur FROM pegawai");
while ($t=mysqli_fetch_array($sqli)){	
$no++;
                                    echo"<tr>
										<td>$no</td>
                                            <td>$t[nama_pegawai] </td>
                                            <td>$t[umur]</td>
							<td><div class='btn-group'>
                      <button type='button' class='btn btn-info'>$t[nik]</button>
                      <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                        <span class='caret'></span>
                        <span class='sr-only'>Toggle Dropdown</span>
                      </button>
                      <ul class='dropdown-menu' role='menu'>
                        <li><a href='index.php?aksi=editpegawai&id_pegawai=$t[id_pegawai]' title='Edit'><i class='fa fa-pencil'></i>Lihat</a></li>
						<li><a href='hapus.php?aksi=hapuspegawai&id_pegawai=$t[id_pegawai]' onclick=\"return confirm ('Apakah yakin ingin menghapus $t[nama_pegawai] ?')\" title='Hapus'><i class='fa fa-remove'></i>hapus</li>
                        </ul>
                    </div></td>
                                        </tr>";
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
                                           <form role='form' method='post' action='input.php?aksi=inputpegawai'>
                                            <div class='form-group'>
                                            <label>Nama pegawai</label>
						                    <input type='text' class='form-control' name='nama_pegawai'/><br>
						                    <label>NIP pegawai/Nik</label>
                                            <input type='text' class='form-control' name='nip'/><br>
                                            <label>Tanggal Lahir pegawai</label>
                                            <input type='date' class='form-control' name='tgl_lahir'/><br>
                                            <label>Status Pegawai</label>
                                            <select class='form-control select2' style='width: 100%;' name=status>
                                                <option value='' selected>--Pilih Status Pegawai</option>
                                                <option value='PNS'>PNS</option>
                                                <option value='P3K'>P3K</option>
                                                <option value='TKS'>TKS SK PUSKES</option>
                                                <option value='THLS'>THLS SK DINAS</option>
                                            </select><br><br>
											<label>Jenis Kelamin</label>
											<select class='form-control select2' style='width: 100%;' name=jenis_kelamin>
											<option value='' selected>--Pilih Jenis Kelamin--</option>
											<option value='Laki-Laki'>Laki-Laki</option>
											<option value='Perempuan'>Perempuan</option>
											</select><br></br>
											<label>Tingkat Pendidikan</label>
											<select class='form-control select2' style='width: 100%;' name=tingkat>
											<option value='' selected>--Pilih Tingkat Pendidikan--</option>"; 
											$sql=mysqli_query($koneksi,"SELECT * FROM pendidikan ORDER BY id_pen");
											while ($c=mysqli_fetch_array($sql))
											{
												echo "<option value=$c[id_pen]>$c[jenjang]</option>";
											}
										    echo "</select>
											<br><br>
											<label>Jurusan Pendidikan</label>
											<select class='form-control select2' style='width: 100%;' name=jurusan>
											<option value='' selected>--Pilih Jenis Jurusan--</option>"; 
											$sql=mysqli_query($koneksi,"SELECT * FROM profesi ORDER BY id_profesi");
											while ($c=mysqli_fetch_array($sql))
											{
												echo "<option value=$c[id_profesi]>$c[nama_profesi]</option>";
											}
										    echo "</select><br><br>
												  <label>Golongan PNS</label>
												   <select class='form-control select2' style='width: 100%;' name=gol>
													<option value='' selected>--Pilih Golongan Jika Pns--</option>"; 
													$sql=mysqli_query($koneksi,"SELECT * FROM golongan ORDER BY id_gol");
													while ($c=mysqli_fetch_array($sql))
													{
														echo "<option value=$c[id_gol]>$c[nama_gol]</option>";
													}
												echo "</select><br>
                                             </br>
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

?>