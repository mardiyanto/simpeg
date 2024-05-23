<?php
  include '../koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "pegawai"){
    header("location:../login.php?alert=belum_login");
  }
  $date=date ('d/m/Y');
  $time=date ('h:i A');
///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='proseseditpegawai'){
$kode_pegawai = $_POST['kode_pegawai'];
$nama_pegawai = $_POST['nama_pegawai'];
$nik = $_POST['nik'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$tempat_lahir = $_POST['tempat_lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status_pegawai = $_POST['status_pegawai'];
$jabatan_pegawai = $_POST['jabatan_pegawai'];
$jenis_pegawai = $_POST['jenis_pegawai'];
$mulai_kerja = $_POST['mulai_kerja'];
$alamat = $_POST['alamat'];
$password = md5($_POST['password']); 
	if (empty($_POST[kode_pegawai]) || empty($_POST[nama_pegawai])){
		echo "<script>window.alert('Data yang Anda isikan belum lengkap');
			   window.location=('javascript:history.go(-1)')</script>";
			}else{
			
	   $lokasi_file=$_FILES[gambar][tmp_name];
	   if(empty($lokasi_file)){
	   mysqli_query($koneksi,"UPDATE pegawai SET 
	   nama_pegawai = '$nama_pegawai', 
	   nik = '$nik',
	   no_hp= '$no_hp',
	   email = '$email', 
	   tempat_lahir = '$tempat_lahir', 
	   tgl_lahir = '$tgl_lahir', 
	   jenis_kelamin = '$jenis_kelamin', 
	   status_pegawai = '$status_pegawai', 
	   jabatan_pegawai = '$jabatan_pegawai', 
	   jenis_pegawai = '$jenis_pegawai', 
	   mulai_kerja = '$mulai_kerja',
	   alamat = '$alamat'  WHERE id_pegawai='$_GET[id_pegawai]'");
	   echo "<script>window.location=('index.php?aksi=pegawai')</script>";
	   }else{
	   $a=$_GET['gb'];
	   $file=$_FILES['gambar']['tmp_name'];
	   $file_name=$_FILES['gambar']['name'];
	   copy($file,"../foto/pegawai/".$a);
	   mysqli_query($koneksi,"UPDATE pegawai SET 
	   nama_pegawai = '$nama_pegawai', 
	   nik = '$nik', 
	   no_hp= '$no_hp',
	   email = '$email', 
	   tempat_lahir = '$tempat_lahir', 
	   tgl_lahir = '$tgl_lahir', 
	   jenis_kelamin = '$jenis_kelamin', 
	   status_pegawai = '$status_pegawai', 
	   jabatan_pegawai = '$jabatan_pegawai', 
	   jenis_pegawai = '$jenis_pegawai',
	   mulai_kerja = '$mulai_kerja', 
	   alamat = '$alamat' WHERE id_pegawai='$_GET[id_pegawai]'");
		  
	   echo "<script>window.location=('index.php?aksi=pegawai')</script>";
		  }
		 } 
}
///////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='proseseditriwayat'){
	mysqli_query($koneksi,"UPDATE riwayat SET ket_riwayat='$_POST[ket_riwayat]' WHERE id_riwayat='$_GET[id_riwayat]'");
echo "<script>window.location=('index.php?aksi=detailpegawai&id_pegawai=$_SESSION[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='proseseditkeluarga'){
	mysqli_query($koneksi,"UPDATE keluarga SET nama_keluarga='$_POST[nama_keluarga]',hubungan_keluarga='$_POST[hubungan_keluarga]',no_hpkeluarga='$_POST[no_hpkeluarga]' WHERE id_keluarga='$_GET[id_keluarga]'");
echo "<script>window.location=('index.php?aksi=detailpegawai&id_pegawai=$_SESSION[id_pegawai]')</script>";
}

?>