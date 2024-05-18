<?php
  include '../koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "administrator_logedin"){
    header("location:../login.php?alert=belum_login");
  }
  $date=date ('d/m/Y');
$time=date ('h:i A');
///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='inputartikel'){
	if (empty($_POST[jd]) || empty($_POST[isi])){
		echo "<script>window.alert('Data yang Anda isikan belum lengkap');
			   window.location=('javascript:history.go(-1)')</script>";
			}
	 else{
		   
	   $lokasi_file=$_FILES[gambar][tmp_name];
	   if(empty($lokasi_file)){
	   mysqli_query($koneksi,"insert into berita (judul,tanggal,isi,jenis) values ('$_POST[jd]','$date','$_POST[isi]','informasi')");
		  
	   echo "<script>window.location=('index.php?aksi=informasi')</script>";
	   }else{
	   $tanggal=date("dmYhis");
	   $file=$_FILES['gambar']['tmp_name'];
	   $file_name=$_FILES['gambar']['name'];
	   copy($file,"../foto/data/".$tanggal.".jpg");
	   mysqli_query($koneksi,"insert into berita (judul,tanggal,isi,gambar,jenis) values ('$_POST[jd]','$date','$_POST[isi]','$tanggal.jpg','informasi')");
		  
	   echo "<script>window.location=('index.php?aksi=informasi')</script>";
		  }
		 }
}
elseif($_GET['aksi']=='inputhalaman'){
	if (empty($_POST[jd]) || empty($_POST[isi])){
		echo "<script>window.alert('Data yang Anda isikan belum lengkap');
			   window.location=('javascript:history.go(-1)')</script>";
			}
	 else{
		   
	   $lokasi_file=$_FILES[gambar][tmp_name];
	   if(empty($lokasi_file)){
	   mysqli_query($koneksi,"insert into berita (judul,tanggal,isi,jenis) values ('$_POST[jd]','$date','$_POST[isi]','halaman')");
		  
	   echo "<script>window.location=('index.php?aksi=halaman')</script>";
	   }else{
	   $tanggal=date("dmYhis");
	   $file=$_FILES['gambar']['tmp_name'];
	   $file_name=$_FILES['gambar']['name'];
	   copy($file,"../foto/data/".$tanggal.".jpg");
	   mysqli_query($koneksi,"insert into berita (judul,tanggal,isi,gambar,jenis) values ('$_POST[jd]','$date','$_POST[isi]','$tanggal.jpg','halaman')");
		  
	   echo "<script>window.location=('index.php?aksi=halaman')</script>";
		  }
		 }
}
elseif($_GET['aksi']=='inputgaleri'){
	if (empty($_POST[jd]) || empty($_POST[isi])){
		echo "<script>window.alert('Data yang Anda isikan belum lengkap');
			   window.location=('javascript:history.go(-1)')</script>";
			}else{
			
	   $lokasi_file=$_FILES[gambar][tmp_name];
	   if(empty($lokasi_file)){
	   echo "<script>window.alert('File gambar masih kosong');
			   window.location=('javascript:history.go(-1)')</script>";
	   }else{
	   $tanggal=date("dmYhis");
	   $file=$_FILES['gambar']['tmp_name'];
	   $file_name=$_FILES['gambar']['name'];
	   copy($file,"../foto/galleri/".$tanggal.".jpg");
	   mysqli_query($koneksi,"insert into galeri (judul,keterangan,gambar) values ('$_POST[jd]','$_POST[isi]','$tanggal.jpg')");
		  
	   echo "<script>window.location=('index.php?aksi=galeri')</script>";
		  }
		 } 
}
elseif($_GET['aksi']=='inputalumni'){
	if (empty($_POST[nama]) || empty($_POST[pekerjaan])){
		echo "<script>window.alert('Data yang Anda isikan belum lengkap');
			   window.location=('javascript:history.go(-1)')</script>";
			}else{
			
	   $lokasi_file=$_FILES[gambar][tmp_name];
	   if(empty($lokasi_file)){
	   echo "<script>window.alert('File gambar masih kosong');
			   window.location=('javascript:history.go(-1)')</script>";
	   }else{
	   $tanggal=date("dmYhis");
	   $file=$_FILES['gambar']['tmp_name'];
	   $file_name=$_FILES['gambar']['name'];
	   copy($file,"../foto/alumni/".$tanggal.".jpg");
	   mysqli_query($koneksi,"insert into alumni (nama,pekerjaan,keterangan,gambar) values ('$_POST[nama]','$_POST[pekerjaan]','$_POST[keterangan]','$tanggal.jpg')");
		  
	   echo "<script>window.location=('index.php?aksi=alumni')</script>";
		  }
		 } 
}
elseif($_GET['aksi']=='inputpegawai'){
	$password = md5($_POST['kode_pegawai']);
	if (empty($_POST[kode_pegawai]) || empty($_POST[nama_pegawai])){
		echo "<script>window.alert('Data yang Anda isikan belum lengkap');
			   window.location=('javascript:history.go(-1)')</script>";
			}else{
			
	   $lokasi_file=$_FILES[gambar][tmp_name];
	   if(empty($lokasi_file)){
	   echo "<script>window.alert('File gambar masih kosong');
			   window.location=('javascript:history.go(-1)')</script>";
	   }else{
	   $tanggal=date("dmYhis");
	   $file=$_FILES['gambar']['tmp_name'];
	   $file_name=$_FILES['gambar']['name'];
	   copy($file,"../foto/pegawai/".$tanggal.".jpg");
	   mysqli_query($koneksi,"insert into pegawai (kode_pegawai,nama_pegawai,nik,no_hp, email,tempat_lahir,tgl_lahir,jenis_kelamin,status_pegawai,jabatan_pegawai,jenis_pegawai,mulai_kerja,alamat,password,gambar) 
	   values ('$_POST[kode_pegawai]','$_POST[nama_pegawai]','$_POST[nik]','$_POST[no_hp]','$_POST[email]','$_POST[tempat_lahir]','$_POST[tgl_lahir]','$_POST[jenis_kelamin]','$_POST[status_pegawai]','$_POST[jabatan_pegawai]','$_POST[jenis_pegawai]','$_POST[mulai_kerja]','$_POST[alamat]','$password','$tanggal.jpg')");
		  
	   echo "<script>window.location=('index.php?aksi=pegawai')</script>";
		  }
		 } 
}
///////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='inputriwayat'){
	mysqli_query($koneksi,"insert into riwayat (id_pegawai,ket_riwayat,jenis_riwayat) values ('$_POST[id_pegawai]','$_POST[ket_riwayat]','$_POST[jenis_riwayat]')");  
echo "<script>window.location=('index.php?aksi=detailpegawai&id_pegawai=$_POST[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='inputkeluarga'){
	mysqli_query($koneksi,"insert into keluarga (id_pegawai,nama_keluarga,hubungan_keluarga,hp_keluarga) values ('$_POST[id_pegawai]','$_POST[nama_keluarga]','$_POST[hubungan_keluarga]','$_POST[hp_keluarga]')");  
echo "<script>window.location=('index.php?aksi=detailpegawai&id_pegawai=$_POST[id_pegawai]')</script>";
}
elseif ($_GET['aksi'] == 'prosesuploaddokumen') {
	$fileName = $_FILES["file"]["name"]; // Nama File asli
	$fileTmp = $_FILES["file"]["tmp_name"]; // File di folder tmp PHP
	
	// Generate nama file unik dengan menambahkan timestamp
	$unikFileName = time() . '_' . $fileName;
	
	// Jika belum ada folder upload, maka buat folder upload
	$temp = "../foto/dokumen/";
	if (!file_exists($temp)) {
		mkdir($temp);
	}
	
	if (move_uploaded_file($fileTmp, $temp . $unikFileName)) {
		echo "$unikFileName berhasil diupload";
	
		if (!$koneksi) {
			die("Koneksi gagal: " . mysqli_connect_error());
		}
	
		$keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
		$id_pegawai = mysqli_real_escape_string($koneksi, $_POST['id_pegawai']);
	
		$query = "INSERT INTO dokumen (id_pegawai,file_dokumen, ket_dokumen) VALUES ('$id_pegawai','$unikFileName', '$keterangan')";
	
		$result = mysqli_query($koneksi, $query);
	
		if ($result) {
			echo " dan data berhasil disimpan ke database.";
		} else {
			echo " dan terjadi kesalahan dalam menyimpan data ke database: " . mysqli_error($koneksi);
		}
	
		mysqli_close($koneksi);
	} else {
		echo "Upload gagal";
	}
}
elseif($_GET['aksi']=='inputgolongan'){
	mysqli_query($koneksi,"insert into golongan (nama_gol) values ('$_POST[nama_gol]')");  
echo "<script>window.location=('index.php?aksi=golongan')</script>";
}
elseif($_GET['aksi']=='inputjabatan'){
	mysqli_query($koneksi,"insert into jabatan (nama_jabatan) values ('$_POST[nama_jabatan]')");  
echo "<script>window.location=('index.php?aksi=jabatan')</script>";
}
elseif($_GET['aksi']=='inputprofesi'){
	mysqli_query($koneksi,"insert into profesi (nama_profesi) values ('$_POST[nama_profesi]')");  
echo "<script>window.location=('index.php?aksi=profesi')</script>";
}
elseif($_GET['aksi']=='inputadmin'){
$nama  = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];

if($filename == ""){
	mysqli_query($koneksi, "insert into user values (NULL,'$nama','$username','$password','')");
	echo "<script>window.location=('index.php?aksi=admin')</script>";
}else{
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(!in_array($ext,$allowed) ) {
		echo "<script>alert('Gagal ');</script>";
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);
		$file_gambar = $rand.'_'.$filename;
		mysqli_query($koneksi, "insert into user values (NULL,'$nama','$username','$password','$file_gambar')");
		echo "<script>window.location=('index.php?aksi=admin')</script>";
	}
}
}

elseif($_GET['aksi']=='inputkeluarga'){
	mysqli_query($koneksi,"insert into keluarga (id_pegawai,nama_keluarga,jk_keluarga,tempatlahir_keluarga,tgllahir_keluarga,status_keluarga,pekejaan_keluarga,pendidikan_keluarga,penghasilan_keluarga,ket_keluarga,tunjang_status,tgl_mati,status_nikah,status_beasiswa,anak_angkat_status,status_sekolah,status_aktif) 
	values ('$_POST[id_pegawai]','$_POST[nama_keluarga]','$_POST[jk_keluarga]','$_POST[tempatlahir_keluarga]','$_POST[tgllahir_keluarga]','$_POST[status_keluarga]','$_POST[pekejaan_keluarga]','$_POST[pendidikan_keluarga]','$_POST[penghasilan_keluarga]','$_POST[ket_keluarga]','$_POST[tunjang_status]','$_POST[tgl_mati]','$_POST[status_nikah]','$_POST[status_beasiswa]','$_POST[anak_angkat_status]','$_POST[status_sekolah]','$_POST[status_aktif]')");  
	mysqli_query($koneksi,"UPDATE pegawai SET status_pg='ada' WHERE id_pegawai='$_POST[id_pegawai]'");
	echo "<script>window.location=('index.php?aksi=listtunjangan&id_pegawai=$_POST[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='inputtunjangan'){
	mysqli_query($koneksi,"insert into tunjangan (id_pegawai,t_status) 
	values ('$_GET[id_pegawai]','baru')");
	mysqli_query($koneksi,"UPDATE pegawai SET status_pg='kk ada' WHERE id_pegawai='$_GET[id_pegawai]'"); 
echo "<script>window.location=('index.php?aksi=tunjangan')</script>";
}
elseif($_GET['aksi']=='inputpangku'){
	mysqli_query($koneksi,"insert into pemangku (nama_pkjab) 
	values ('$_POST[nama_pkjab]')");
echo "<script>window.location=('index.php?aksi=pangku')</script>";
}
elseif($_GET['aksi']=='inputpangkujabatan'){
	mysqli_query($koneksi,"insert into pemangkujabatan (id_pegawai,id_pkjab,nomor_surat,tanggal_surat) 
	values ('$_POST[id_pegawai]','$_POST[id_pkjab]','$_POST[nomor_surat]','$_POST[tanggal_surat]')");
echo "<script>window.location=('index.php?aksi=pangkujabatan')</script>";
}
?>