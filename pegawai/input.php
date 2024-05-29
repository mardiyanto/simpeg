<?php
  include '../koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "pegawai"){
    header("location:../login.php?alert=belum_login");
  }
  $date=date ('d/m/Y');
$time=date ('h:i A');
if($_GET['aksi']=='inputriwayat'){
	mysqli_query($koneksi,"insert into riwayat (id_pegawai,ket_riwayat,jenis_riwayat) values ('$_POST[id_pegawai]','$_POST[ket_riwayat]','$_POST[jenis_riwayat]')");  
echo "<script>window.location=('index.php?aksi=detailpegawai&id_pegawai=$_POST[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='inputkeluarga'){
	mysqli_query($koneksi,"insert into keluarga (id_pegawai,nama_keluarga,hubungan_keluarga,no_hpkeluarga) values ('$_POST[id_pegawai]','$_POST[nama_keluarga]','$_POST[hubungan_keluarga]','$_POST[no_hpkeluarga]')");  
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
elseif($_GET['aksi']=='inputkerja'){
	$password = md5($_POST['kode_pegawai']);
	if (empty($_POST[ket_uraiankerja])){
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
	   $target_path = "../foto/kerja/" . $tanggal . ".jpg";

	   // Pastikan direktori tujuan ada
	   if (!file_exists(dirname($target_path))) {
	       mkdir(dirname($target_path), 0777, true);
	   }

	   // Gunakan fungsi copy() untuk memindahkan file
	   if (copy($file, $target_path)) {
	       $id_pegawai = mysqli_real_escape_string($koneksi, $_POST['id_pegawai']);
	       $ket_uraiankerja = mysqli_real_escape_string($koneksi, $_POST['ket_uraiankerja']);
	       $query = "INSERT INTO uraiankerja (id_pegawai, ket_uraiankerja, foto_uraiankerja) VALUES ('$id_pegawai', '$ket_uraiankerja', '$tanggal.jpg')";
	       $result = mysqli_query($koneksi, $query);

	       if ($result) {
	           echo "<script>window.location=('index.php?aksi=kerja')</script>";
	       } else {
	           echo "Terjadi kesalahan dalam menyimpan data: " . mysqli_error($koneksi);
	       }
	   } else {
	       echo "Gagal mengunggah file.";
	   }
		  }
		 } 
}
elseif($_GET['aksi']=='inputcuti'){
    $id_pegawai = mysqli_real_escape_string($koneksi, $_POST['id_pegawai']);
    $lama_cuti = mysqli_real_escape_string($koneksi, $_POST['lama_cuti']);
    $tgl_awal = mysqli_real_escape_string($koneksi, $_POST['tgl_awal']);
    $tgl_akhir = mysqli_real_escape_string($koneksi, $_POST['tgl_akhir']);
    $ket_cuti = mysqli_real_escape_string($koneksi, $_POST['ket_cuti']);

    // Validasi input
    if (empty($id_pegawai) || empty($lama_cuti) || empty($tgl_awal) || empty($tgl_akhir) || empty($ket_cuti)) {
        echo "<script>alert('Semua field harus diisi.'); window.location=('javascript:history.go(-1)');</script>";
    } else {
        $query = "INSERT INTO cuti_pegawai (id_pegawai, lama_cuti, tgl_awal, tgl_akhir, ket_cuti, status_cuti) 
        VALUES ('$id_pegawai', '$lama_cuti', '$tgl_awal', '$tgl_akhir', '$ket_cuti', 'pengajuan')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>window.location=('index.php?aksi=cuti')</script>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
    
    echo "<script>window.location=('index.php?aksi=cuti')</script>";
}
?>
