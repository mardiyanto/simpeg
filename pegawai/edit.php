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
	   $lokasi_file = $_FILES['gambar']['tmp_name'];
	   $nama_file = $_FILES['gambar']['name'];
	   $ekstensi_diperbolehkan = array('png','jpg','jpeg','gif');
	   $x = explode('.', $nama_file);
	   $ekstensi = strtolower(end($x));
	   $file_tmp = $_FILES['gambar']['tmp_name'];   
	   $nama_file_baru = uniqid() . '.' . $ekstensi;
	   if(!empty($lokasi_file)) {
	       if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
	           // Menghapus gambar lama
	           $gambar_lama = "../foto/pegawai/" . $_GET['gb'];
	           if(file_exists($gambar_lama)){
	               unlink($gambar_lama);
	           }
	           // Memindahkan file baru
	           move_uploaded_file($file_tmp, '../foto/pegawai/'.$nama_file_baru);
	           // Menetapkan nama file baru ke variabel untuk digunakan dalam query
	           $gambar = $nama_file_baru;
	       } else {
	           echo "<script>alert('Ekstensi file tidak diperbolehkan');</script>";
	           exit;
	       }
	   } else {
	       // Jika tidak ada file baru, gunakan nama file gambar lama
	       $gambar = $_GET['gb'];
	   }
	   // Query update dengan atau tanpa gambar baru
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
	   alamat = '$alamat',
	   gambar = '$gambar' WHERE id_pegawai='$_GET[id_pegawai]'");
	   echo "<script>window.location=('index.php?aksi=pegawai')</script>";
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
elseif($_GET['aksi']=='proseseditkerja'){
    $id_pegawai = $_POST['id_pegawai'];
    $ket_uraiankerja = $_POST['ket_uraiankerja']; 
    if (empty($_POST['ket_uraiankerja'])){
        echo "<script>window.alert('Data yang Anda isikan belum lengkap');
               window.location=('javascript:history.go(-1)')</script>";
    } else {
        $lokasi_file = $_FILES['gambar']['tmp_name'];
        $nama_file = $_FILES['gambar']['name'];
        $ekstensi_diperbolehkan = array('png','jpg','jpeg','gif');
        $x = explode('.', $nama_file);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];   
        $nama_file_baru = uniqid() . '.' . $ekstensi;

        if(!empty($lokasi_file)) {
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                // Menghapus gambar lama
                $gambar_lama = "../foto/kerja/" . $_GET['gb'];
                if(file_exists($gambar_lama)){
                    unlink($gambar_lama);
                }
                // Memindahkan file baru
                move_uploaded_file($file_tmp, '../foto/kerja/'.$nama_file_baru);
                // Menetapkan nama file baru ke variabel untuk digunakan dalam query
                $gambar = $nama_file_baru;
            } else {
                echo "<script>alert('Ekstensi file tidak diperbolehkan');</script>";
                exit;
            }
        } else {
            // Jika tidak ada file baru, gunakan nama file gambar lama
            $gambar = $_GET['gb'];
        }
        // Query update dengan atau tanpa gambar baru
        mysqli_query($koneksi,"UPDATE uraiankerja SET 
        ket_uraiankerja = '$ket_uraiankerja', 
        foto_uraiankerja = '$gambar' WHERE id_uraiankerja='$_GET[id_uraiankerja]'");
        echo "<script>window.location=('index.php?aksi=kerja')</script>";
    }
}
elseif($_GET['aksi']=='proseseditbatalcuti'){
	mysqli_query($koneksi,"UPDATE cuti_pegawai SET ket_batal='$_POST[ket_batal]', status_cuti='batal' WHERE id_cuti='$_GET[id_cuti]'");
echo "<script>window.location=('index.php?aksi=cuti')</script>";
}
elseif($_GET['aksi']=='proseseditcuti'){
	mysqli_query($koneksi,"UPDATE cuti_pegawai SET lama_cuti='$_POST[lama_cuti]', tgl_awal='$_POST[tgl_awal]', tgl_akhir='$_POST[tgl_akhir]', ket_cuti='$_POST[ket_cuti]', status_cuti='pengajuan' WHERE id_cuti='$_GET[id_cuti]'");
echo "<script>window.location=('index.php?aksi=cuti')</script>";
}
?>
