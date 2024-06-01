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

// Ambil semua data pegawai
$query_pegawai = "SELECT * FROM pegawai";
$result_pegawai = $conn->query($query_pegawai);

if ($result_pegawai->num_rows > 0) {
    while ($pegawai = $result_pegawai->fetch_assoc()) {
        $id_pegawai = $pegawai['id_pegawai'];

        // Iterasi setiap hari dari lima bulan lalu sampai hari ini
        $period = new DatePeriod($five_months_ago, $interval, $today);

        foreach ($period as $date) {
            $formatted_date = $date->format('Y-m-d');
            $day_of_week = $date->format('N'); // 1 (Senin) - 7 (Minggu)

            // Cek apakah hari ini adalah hari Minggu atau hari libur nasional
            if ($day_of_week == 7 || in_array($formatted_date, $holidays)) {
                continue;
            }

            // Tentukan jam datang dan pulang
            $random_datang = rand(0, 1); // Nilai 0 atau 1 (untuk menentukan jam datang)
            $random_pulang = rand(0, 1); // Nilai 0 atau 1 (untuk menentukan jam pulang)

            $jam_absensi_datang = $random_datang ? '08:00:00' : '08:15:00'; // Contoh jam datang (tepat atau tidak)
            $jam_absensi_pulang = $random_pulang ? '15:00:00' : '16:45:00'; // Contoh jam pulang (tepat atau tidak)

            // Simulasi data absensi datang
            $gambar_datang = ''; // Kosongkan atau berikan path gambar
            $status_absensi_datang = $random_datang ? 'Hadir' : 'Terlambat'; // Status hadir datang
            $status_absensi = 'Datang';
            $status_hadir = $status_absensi_datang == 'Hadir' ? 'Hadir' : 'Tidak Hadir';
            $latitude = '0.0000'; // Contoh latitude
            $longitude = '0.0000'; // Contoh longitude

            // Query insert presensi datang
            $sql_datang = "
            INSERT INTO presensi_datang 
            (gambar_datang, tanggal_absensi_datang, jam_absensi_datang, id_pegawai, status_absensi_datang, status_absensi, status_hadir, latitude, longitude) 
            VALUES 
            ('$gambar_datang', '$formatted_date', '$jam_absensi_datang', $id_pegawai, '$status_absensi_datang', '$status_absensi', '$status_hadir', '$latitude', '$longitude')
            ";

            if ($conn->query($sql_datang) === TRUE) {
                echo "Data absensi datang untuk pegawai dengan id $id_pegawai pada tanggal $formatted_date berhasil ditambahkan.<br>";
            } else {
                echo "Error: " . $sql_datang . "<br>" . $conn->error . "<br>";
            }

            // Simulasi data absensi pulang
            $gambar_pulang = ''; // Kosongkan atau berikan path gambar
            $status_absensi_pulang = $random_pulang ? 'Pulang Tepat' : 'Pulang Cepat'; // Status hadir pulang
            
            // Query insert presensi pulang
            $sql_pulang = "
            INSERT INTO presensi_pulang 
            (gambar_pulang, tanggal_absensi_pulang, jam_absensi_pulang, id_pegawai, status_absensi_pulang, latitude, longitude) 
            VALUES 
            ('$gambar_pulang', '$formatted_date', '$jam_absensi_pulang', $id_pegawai, '$status_absensi_pulang', '$latitude', '$longitude')
            ";

            if ($conn->query($sql_pulang) === TRUE) {
                echo "Data absensi pulang untuk pegawai dengan id $id_pegawai pada tanggal $formatted_date berhasil ditambahkan.<br>";
            } else {
                echo "Error: " . $sql_pulang . "<br>" . $conn->error . "<br>";
            }
        }
    }
} else {
    echo "Tidak ada data pegawai.";
}

$conn->close();
?>
