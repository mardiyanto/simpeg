<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_simpeg";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_pegawai = 7; // Ganti dengan id_pegawai yang diinginkan

// Ambil data pegawai berdasarkan id_pegawai
$query_pegawai = "SELECT * FROM pegawai WHERE id_pegawai = $id_pegawai";
$result_pegawai = $conn->query($query_pegawai);

if ($result_pegawai->num_rows > 0) {
    $pegawai = $result_pegawai->fetch_assoc();
} else {
    die("Pegawai dengan id_pegawai $id_pegawai tidak ditemukan.");
}

// Daftar hari libur nasional Indonesia (contoh data statis, sesuaikan dengan daftar sebenarnya)
$holidays = [
    '2024-01-01', // Tahun Baru Masehi
    '2024-03-11', // Hari Raya Nyepi
    '2024-03-29', // Wafat Isa Almasih
    '2024-05-01', // Hari Buruh
    '2024-05-09', // Kenaikan Isa Almasih
    '2024-05-25', // Hari Raya Idul Fitri
    '2024-05-26', // Hari Raya Idul Fitri
    '2024-06-01', // Hari Lahir Pancasila
    // Tambahkan hari libur lainnya sesuai kebutuhan
];

$today = new DateTime();
$five_months_ago = clone $today;
$five_months_ago->sub(new DateInterval('P5M'));
$interval = new DateInterval('P1D');

// Iterasi setiap hari dari lima bulan lalu sampai hari ini
$period = new DatePeriod($five_months_ago, $interval, $today);

foreach ($period as $date) {
    $formatted_date = $date->format('Y-m-d');
    $day_of_week = $date->format('N'); // 1 (Senin) - 7 (Minggu)

    // Cek apakah hari ini adalah hari Minggu atau hari libur nasional
    if ($day_of_week == 7 || in_array($formatted_date, $holidays)) {
        continue;
    }

    // Simulasi data absensi datang
    $gambar_datang = ''; // Kosongkan atau berikan path gambar
    $tanggal_absensi_datang = $formatted_date;
    $jam_absensi_datang = '08:00:00'; // Contoh jam datang
    $status_absensi_datang = 'Hadir';
    $status_absensi = 'Datang';
    $status_hadir = 'Hadir';
    $latitude = '0.0000'; // Contoh latitude
    $longitude = '0.0000'; // Contoh longitude

    // Query insert presensi datang
    $sql_datang = "
    INSERT INTO presensi_datang 
    (gambar_datang, tanggal_absensi_datang, jam_absensi_datang, id_pegawai, status_absensi_datang, status_absensi, status_hadir, latitude, longitude) 
    VALUES 
    ('$gambar_datang', '$tanggal_absensi_datang', '$jam_absensi_datang', $id_pegawai, '$status_absensi_datang', '$status_absensi', '$status_hadir', '$latitude', '$longitude')
    ";

    if ($conn->query($sql_datang) === TRUE) {
        echo "Data absensi datang untuk tanggal $formatted_date berhasil ditambahkan.<br>";
    } else {
        echo "Error: " . $sql_datang . "<br>" . $conn->error . "<br>";
    }

    // Simulasi data absensi pulang
    $gambar_pulang = ''; // Kosongkan atau berikan path gambar
    $tanggal_absensi_pulang = $formatted_date;
    $jam_absensi_pulang = '17:00:00'; // Contoh jam pulang
    $status_absensi_pulang = 'Hadir';
    
    // Query insert presensi pulang
    $sql_pulang = "
    INSERT INTO presensi_pulang 
    (gambar_pulang, tanggal_absensi_pulang, jam_absensi_pulang, id_pegawai, status_absensi_pulang, latitude, longitude) 
    VALUES 
    ('$gambar_pulang', '$tanggal_absensi_pulang', '$jam_absensi_pulang', $id_pegawai, '$status_absensi_pulang', '$latitude', '$longitude')
    ";

    if ($conn->query($sql_pulang) === TRUE) {
        echo "Data absensi pulang untuk tanggal $formatted_date berhasil ditambahkan.<br>";
    } else {
        echo "Error: " . $sql_pulang . "<br>" . $conn->error . "<br>";
    }
}

$conn->close();
?>
