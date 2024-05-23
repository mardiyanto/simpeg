<?php
include 'koneksi.php';
// menangkap data yang dikirim dari form
$kode_pegawai = $_POST['kode_pegawai'];
$password = md5($_POST['password']);
	$log = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE kode_pegawai='$kode_pegawai' AND password='$password'");
	$cek = mysqli_num_rows($log);

	if($cek > 0){
		session_start();
		$d = mysqli_fetch_assoc($log);
		$_SESSION['id_pegawai'] = $d['id_pegawai'];
		$_SESSION['nama_pegawai'] = $d['nama_pegawai'];
		$_SESSION['jenis_pegawai'] = $d['jenis_pegawai'];
		$_SESSION['status'] = "pegawai";
		header("location:pegawai/index.php?aksi=home");
	}else{
		header("location:index.php?alert=gagal");
	}
?>