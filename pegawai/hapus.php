<?php
  include '../koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "pegawai"){
    header("location:../login.php?alert=belum_login");
  }
///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='hapusartikel'){
  mysqli_query($koneksi,"DELETE FROM berita WHERE id_berita='$_GET[id_b]'");
  $b=$_GET['gbr'];
  $pathFile="../foto/data/$b";	   
  unlink($pathFile);
  echo "<script>window.location=('index.php?aksi=informasi')</script>";
}
elseif($_GET['aksi']=='hapushalaman'){
  mysqli_query($koneksi,"DELETE FROM berita WHERE id_berita='$_GET[id_b]'");
  $b=$_GET['gbr'];
  $pathFile="../foto/data/$b";	   
  unlink($pathFile);
  echo "<script>window.location=('index.php?aksi=halaman')</script>";
}
///////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='hapusgaleri'){
  mysqli_query($koneksi,"DELETE FROM galeri WHERE id_galeri='$_GET[id_g]'");
  $b=$_GET['gbr'];
  $pathFile="../foto/galleri/$b";	   
  unlink($pathFile);
echo "<script>window.location=('index.php?aksi=galeri')</script>";
}
elseif($_GET['aksi']=='hapusalumni'){
  mysqli_query($koneksi,"DELETE FROM alumni WHERE id_alumni='$_GET[id_alumni]'");
  $b=$_GET['gbr'];
  $pathFile="../foto/alumni/$b";	   
  unlink($pathFile);
echo "<script>window.location=('index.php?aksi=alumni')</script>";
}
elseif($_GET['aksi']=='hapuspegawai'){
  mysqli_query($koneksi,"DELETE FROM pegawai WHERE id_pegawai='$_GET[id_pegawai]'");
  $b=$_GET['gbr'];
  $pathFile="../foto/pegawai/$b";	   
  unlink($pathFile);
echo "<script>window.location=('index.php?aksi=pegawai')</script>";
}
elseif ($_GET['aksi'] == 'hapusbuktidokumen') {
  $id_uploaddokumen_hapus = $_GET['id_dokumen'];
  $id_pegawai = $_GET['id_pegawai'];  
  // Ambil informasi file terkait
  $query_select = "SELECT file_dokumen FROM dokumen WHERE id_dokumen = '$id_uploaddokumen_hapus'";
  $result_select = mysqli_query($koneksi, $query_select);

  if ($result_select) {
      $row = mysqli_fetch_assoc($result_select);
      $nama_file_hapus = $row['file_dokumen'];
      $path_file_hapus = "../foto/dokumen/" . $nama_file_hapus;

      // Hapus file dari direktori
      if (unlink($path_file_hapus)) {
          // Hapus data dari tabel database
          $query_delete = "DELETE FROM dokumen WHERE id_dokumen = '$id_uploaddokumen_hapus'";
          $result_delete = mysqli_query($koneksi, $query_delete);

          if ($result_delete) {
              echo "<script>window.alert('Berhasil hapus'); window.location=('index.php?aksi=detailpegawai&id_pegawai=$_SESSION[id_pegawai]')</script>";
          } else {
              echo "<script>window.alert('Gagal menghapus data dari database'); window.location=('index.php?aksi=detailpegawai&id_pegawai=$_SESSION[id_pegawai]')</script>";
          }
      } else {
          echo "<script>window.alert('Gagal menghapus file tidak terdapat di database'); window.location=('index.php?aksi=detailpegawai&id_pegawai=$_SESSION[id_pegawai]')</script>";
      }
  } else {
      echo "<script>window.alert('Gagal mengambil informasi file'); window.location=('index.php?aksi=detailpegawai&id_pegawai=$_SESSION[id_pegawai]')</script>";
  }

}
elseif($_GET['aksi']=='hapuskeluarga'){
  mysqli_query($koneksi,"DELETE FROM keluarga  WHERE id_keluarga='$_GET[id_keluarga]'");
  echo "<script>window.alert('Berhasil hapus'); window.location=('index.php?aksi=detailpegawai&id_pegawai=$_SESSION[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='hapusriwayat'){
  mysqli_query($koneksi,"DELETE FROM riwayat WHERE id_riwayat='$_GET[id_riwayat]'");
  echo "<script>window.alert('Berhasil hapus'); window.location=('index.php?aksi=detailpegawai&id_pegawai=$_SESSION[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='hapuskerja'){
$data = mysqli_query($koneksi, "select * from uraiankerja where id_uraiankerja='$_GET[id_uraiankerja]'");
$d = mysqli_fetch_assoc($data);
$foto = $d['foto_uraiankerja'];
unlink("../foto/kerja/$foto");
mysqli_query($koneksi, "delete from uraiankerja where id_uraiankerja='$_GET[id_uraiankerja]'");
echo "<script>window.location=('index.php?aksi=kerja')</script>";
}
elseif($_GET['aksi']=='hapusberkas'){
    $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE  id_pegawai=$_GET[id_pegawai]");
    $t=mysqli_fetch_array($tebaru);
    $data = mysqli_query($koneksi, "select * from file where file_id='$_GET[file_id]'");
    $d = mysqli_fetch_assoc($data);
    $file = $d['file_name'];
    unlink("upload/$file");
    mysqli_query($koneksi, "delete from file where file_id='$_GET[file_id]'");
    echo "<script>window.location=('index.php?aksi=listuploadfile&id_pegawai=$t[id_pegawai]')</script>";
}
?>