<?php
  include '../koneksi.php';
  include '../config/initsoap.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "administrator_logedin"){
    header("location:../login.php?alert=belum_login");
  }
///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='getpegawai'){
	$filter = "";
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
	foreach ($dataArray as $d) {
			$nama_dosen = $d->nama_dosen;
			$tempat_lahir = $d->tempat_lahir;
			$tanggal_lahir = date('Y-m-d', strtotime($d->tanggal_lahir));
			$nidn = $d->nidn;
			$nik = $d-> nik;
			$nama_jenis_sdm = $d-> nama_jenis_sdm;
			$email = $d-> email;
			$handphone= $d->handphone;
			$jalan= $d->jalan;
			$rt= $d->rt;
			$rw= $d->rw;
			$ds_kel= $d->ds_kel;
			$kode_pos= $d->kode_pos;
			$nama_wilayah= $d->nama_wilayah;
			$password = md5($d->nidn);
			if ($d->jenis_kelamin === "P") { 
				$kode = "Perempuan";
		   } elseif ($d->jenis_kelamin === "L") {
			    $kode = "Laki-laki";
		   } 
		   $sql_check = "SELECT COUNT(*) as count FROM pegawai WHERE kode_pegawai = '$nidn' AND nama_pegawai = '$nama_dosen' AND status_pegawai = 'TETAP' AND 
		   nik = '$nik' AND no_hp = '$handphone' AND tempat_lahir = '$tempat_lahir' AND tgl_lahir = '$tanggal_lahir' AND jenis_kelamin = '$kode' AND 
		   alamat = '$jalan,$rt,$rw,$ds_kel,$kode_pos,$nama_wilayah' AND email = '$email' AND password = '$password' AND no_hp = '$handphone' AND jenis_pegawai = '$nama_jenis_sdm'";
		   $result_check = $koneksi->query($sql_check);
		   
		   if ($result_check === false) {
			   echo "Error in SQL query: " . $koneksi->error;
			   die();
		   }
		   
		   $row_check = $result_check->fetch_assoc();
		   
		   if ($row_check['count'] == 0) {
			   // Data belum ada dalam database, lakukan INSERT
			   $sql = "INSERT INTO pegawai (kode_pegawai,nama_pegawai,status_pegawai,nik,tempat_lahir,tgl_lahir,jenis_kelamin,alamat,email,password,no_hp,jenis_pegawai,gambar,mulai_kerja) 
					   VALUES ('$nidn', '$nama_dosen', 'TETAP','$nik','$tempat_lahir','$tanggal_lahir','$kode','$jalan,$rt,$rw,$ds_kel,$kode_pos,$nama_wilayah','$email','$password','$handphone','$nama_jenis_sdm','pegawai.png','2012-02-01')";
			   if ($koneksi->query($sql) === TRUE) {
				   echo '
				   <div class="alert alert-success" role="alert">
				   Data berhasil disimpan ke dalam basis data.
				   </div>
				   <script>
					   setTimeout(function() {
						   window.location.href = "index.php?aksi=pegawai";
					   }, 3000); // Delay 3 detik sebelum mengalihkan
				   </script>';
			   } else {
				   echo "Error: " . $sql . "<br>" . $koneksi->error;
			   }
		   } else {
			   echo '
			   <div class="alert alert-danger" role="alert">
			   Data sudah ada dalam basis data, input gagal.
			   </div>';
		   }
		   
		}
	} 
elseif($_GET['aksi']=='getmatkul'){
	$filter = "";
	$order = '';
	$limit = '';
	$offset = '';
	$data_aray = [
	  'act' => 'GetDetailMataKuliah',
	  'token' => $_token,
	  'filter' => $filter, 
	  'order' => $order, 
	  'limit' => $limit, 
	  'offset' => $offset
	];
	$datajson = json_decode($_ws->execute($data_aray));
	$dataArray = $datajson->data;
	foreach ($dataArray as $d) {
			$id_matkul = $d->id_matkul;
			$kode_mata_kuliah = $d->kode_mata_kuliah;
			$nama_mata_kuliah = $d->nama_mata_kuliah;
			$id_prodi = $d->id_prodi;
			$nama_program_studi = $d-> nama_program_studi;
			$id_jenis_mata_kuliah = $d-> id_jenis_mata_kuliah;
			$id_kelompok_mata_kuliah = $d-> id_kelompok_mata_kuliah;
			$sks_mata_kuliah= $d->sks_mata_kuliah;
			$sks_tatap_muka= $d->sks_tatap_muka;
			$sks_praktek= $d->sks_praktek;
			$sks_praktek_lapangan= $d->sks_praktek_lapangan;
			$sks_simulasi= $d->sks_simulasi;
			$metode_kuliah= $d->metode_kuliah;
			$ada_sap= $d->ada_sap;
			$ada_silabus= $d->ada_silabus;
			$ada_bahan_ajar= $d->ada_bahan_ajar;
			$ada_acara_praktek= $d->ada_acara_praktek;
			$ada_diktat= $d->ada_diktat;
			$tanggal_mulai_efektif= $d->tanggal_mulai_efektif;
			$tanggal_selesai_efektif= $d->tanggal_selesai_efektif;
			if ($d->id_prodi === "be5768fc-b53c-40c2-9593-b8ecae11437f") { 
				$kode = "57201";
		   } elseif ($d->id_prodi === "9bd9cb24-db6e-467f-98d9-36e3c8668251") {
			    $kode = "57401";
		   } 
		   $sql_check = "SELECT COUNT(*) as count FROM matakuliah WHERE id_matkul = '$id_matkul' AND kode_mata_kuliah = '$kode_mata_kuliah' 
		   AND id_prodi = '$id_prodi' AND id_jenis_mata_kuliah = '$id_jenis_mata_kuliah' AND id_kelompok_mata_kuliah = '$id_kelompok_mata_kuliah'
		   AND sks_mata_kuliah = '$sks_mata_kuliah' AND sks_tatap_muka = '$sks_tatap_muka' AND sks_praktek = '$sks_praktek'
		   AND sks_praktek_lapangan = '$sks_praktek_lapangan' AND sks_simulasi = '$sks_simulasi' AND metode_kuliah = '$metode_kuliah'
		   AND ada_sap = '$ada_sap' AND ada_silabus = '$ada_silabus' AND ada_bahan_ajar = '$ada_bahan_ajar' AND ada_diktat = '$ada_diktat'
		   AND ada_acara_praktek = '$ada_acara_praktek' AND tanggal_mulai_efektif = '$tanggal_mulai_efektif' AND tanggal_selesai_efektif = '$tanggal_selesai_efektif'";
		   $result_check = $koneksi->query($sql_check);
		   
		   if ($result_check === false) {
			   echo "Error in SQL query: " . $koneksi->error;
			   die();
		   }
		   
		   $row_check = $result_check->fetch_assoc();
		   
		   if ($row_check['count'] == 0) {
			   // Data belum ada dalam database, lakukan INSERT
			   $sql = "INSERT INTO matakuliah (id_matkul,kode_mata_kuliah,nama_mata_kuliah,id_prodi,kode_jur,nama_program_studi,
			                                   id_jenis_mata_kuliah,id_kelompok_mata_kuliah,sks_mata_kuliah,sks_tatap_muka,
											   sks_praktek_lapangan,sks_simulasi,metode_kuliah,ada_sap,
											   ada_silabus,ada_bahan_ajar,ada_acara_praktek,ada_diktat,tanggal_mulai_efektif,tanggal_selesai_efektif) 
					   VALUES ('$id_matkul', '$kode_mata_kuliah', '$nama_mata_kuliah', '$id_prodi','$kode','$nama_program_studi',
					           '$id_jenis_mata_kuliah','$id_kelompok_mata_kuliah','$sks_mata_kuliah','$sks_tatap_muka',
							   '$sks_praktek_lapangan','$sks_simulasi','$metode_kuliah','$ada_sap',
							   '$ada_silabus','$ada_bahan_ajar','$ada_acara_praktek','$ada_diktat','$tanggal_mulai_efektif','$tanggal_selesai_efektif')";
		   
			   if ($koneksi->query($sql) === TRUE) {
				   echo '
				   <div class="alert alert-success" role="alert">
				   Data berhasil disimpan ke dalam basis data.
				   </div>
				   <script>
					   setTimeout(function() {
						   window.location.href = "index.php?aksi=matakuliahdb";
					   }, 3000); // Delay 3 detik sebelum mengalihkan
				   </script>';
			   } else {
				   echo "Error: " . $sql . "<br>" . $koneksi->error;
			   }
		   } else {
			   echo '
			   <div class="alert alert-danger" role="alert">
			   Data sudah ada dalam basis data, input gagal.
			   </div>';
		   }
		   
		}
	} 
elseif($_GET['aksi']=='getkurma'){
	$id_k=$_GET['id_kurikulum'];
	$keterangan=$_GET['keterangan'];
	$filter ="id_kurikulum='$keterangan'";
	$order = '';
	$limit = '';
	$offset = '';
	$data_aray = [
	  'act' => 'GetMatkulKurikulum',
	  'token' => $_token,
	  'filter' => $filter, 
	  'order' => $order, 
	  'limit' => $limit, 
	  'offset' => $offset
	];
	$datajson = json_decode($_ws->execute($data_aray));
	$dataArray = $datajson->data;
	foreach ($dataArray as $d) {
		$fil= "id_matkul='$d->id_matkul'";
		$ord = '';
		$lim = '';
		$off = '';
		$data_ar = [
		  'act' => 'GetDetailMataKuliah',
		  'token' => $_token,
		  'filter' => $fil, 
		  'order' => $ord, 
		  'limit' => $lim, 
		  'offset' => $off
		];
		$datajs = json_decode($_ws->execute($data_ar));
		$dataAr = $datajs->data;
		foreach ($dataAr as $x);

			$id_matkul = $d->id_matkul;
			$id_kurikulum = $d->id_kurikulum;
			$kode_mata_kuliah = $d->kode_mata_kuliah;
			$nama_mata_kuliah = $d-> nama_mata_kuliah;
			$sks_tatap_muka = $d-> sks_tatap_muka;
			$sks_praktek = $d-> sks_praktek;
			$sks_praktek_lapangan = $d-> sks_praktek_lapangan;
			$sks_simulasi = $d-> sks_simulasi;
			$id_semester = $d-> id_semester;
			$id_prodi = $d-> id_prodi;
			$jnis = $x->id_kelompok_mata_kuliah;
			if ($d->id_prodi === "be5768fc-b53c-40c2-9593-b8ecae11437f") { 
				$kode = "57201";
		   } elseif ($d->id_prodi === "9bd9cb24-db6e-467f-98d9-36e3c8668251") {
			    $kode = "57401";
		   } 
		   $sql_check = "SELECT COUNT(*) as count FROM mat_kurikulum WHERE kode_mk = '$kode_mata_kuliah' AND jns_mk = '$jnis' AND  sks_prak = '$sks_praktek' AND  
		   sks_prak_lap = '$sks_praktek_lapangan' AND sks_tm = '$sks_tatap_muka' AND sks_sim = '$sks_simulasi' AND semester = '$id_semester' AND id_kurikulum = '$id_k'";
		   $result_check = $koneksi->query($sql_check);
		   
		   if ($result_check === false) {
			   echo "Error in SQL query: " . $koneksi->error;
			   die();
		   }
		   
		   $row_check = $result_check->fetch_assoc();
		   
		   if ($row_check['count'] == 0) {
			   // Data belum ada dalam database, lakukan INSERT
			   $sql = "INSERT INTO mat_kurikulum (id_kurikulum,kode_mk,nama_mk,jns_mk,sks_tm,sks_prak,sks_prak_lap,sks_sim,semester,kode_jurusan,status_error,keterangan,id_kur) 
					   VALUES ('$id_k', '$kode_mata_kuliah', '$nama_mata_kuliah','$jnis','$sks_tatap_muka','$sks_praktek','$sks_praktek_lapangan','$sks_simulasi','$id_semester','$kode','1','$id_matkul','$id_kurikulum')";
		   
			   if ($koneksi->query($sql) === TRUE) {
				echo "
				<div class='alert alert-success' role='alert'>
				Data berhasil disimpan ke dalam basis data.
				</div>
				<script>
					setTimeout(function() {
						window.location.href = 'index.php?aksi=detailkurikulumdb&id_kurikulum=$id_k&keterangan=$keterangan';
					}, 3000); // Delay 3 detik sebelum mengalihkan
				</script>";
			   } else {
				   echo "Error: " . $sql . "<br>" . $koneksi->error;
			   }
		   } else {
			   echo '
			   <div class="alert alert-danger" role="alert">
			   Data sudah ada dalam basis data, input gagal.
			   </div>';
		   }
		   
		}
	} 

?>

